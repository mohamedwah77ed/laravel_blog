<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;


class CommentController extends Controller
{
    public function store(Request $request, $postId)
{
    // ✅ التحقق من صحة البيانات
    $request->validate([
        'comment' => ['required', 'string', 'min:3'],
    ]);

    // ✅ إنشاء التعليق
    Comment::create([
        'comment' => $request->input('comment'),
        'user_id' => auth()->id(), // المستخدم المسجل حاليًا
        'post_id' => $postId, // معرف البوست المستهدف
    ]);

    // ✅ إعادة التوجيه لصفحة البوست بعد إضافة التعليق
    return redirect()->route('posts.show', $postId)->with('success', 'تم إضافة التعليق بنجاح!');
}
public function update(Request $request, Comment $comment)
{
    // التأكد إن المستخدم هو صاحب التعليق أو لديه صلاحية التعديل
    if (auth()->id() !== $comment->user_id) {
        return back()->with('error', 'لا يمكنك تعديل هذا التعليق.');
    }

    // التحقق من صحة البيانات
    $request->validate([
        'comment' => ['required', 'min:3'],
    ]);

    // تحديث التعليق
    $comment->update([
        'comment' => $request->input('comment'),
    ]);

    return back()->with('success', 'تم تعديل التعليق بنجاح.');
}

public function destroy(Comment $comment)
{
    // التأكد إن المستخدم هو صاحب التعليق أو لديه صلاحية الحذف
    if (auth()->id() !== $comment->user_id) {
        return back()->with('error', 'لا يمكنك حذف هذا التعليق.');
    }

    // حذف التعليق
    $comment->delete();

    return back()->with('success', 'تم حذف التعليق بنجاح.');
}


}
