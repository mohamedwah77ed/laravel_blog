<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Hashtag;
class CrudController extends Controller
{
    // إنشاء بوست جديد
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|min:3',
            'content' => 'required|min:5',
        ]);

        $post = Post::create([
            'title' => $data['title'],
            'content' => $data['content'],
            'user_id' => auth()->id(), // المستخدم من التوكن
        ]);

        // استخراج الهاشتاجات
        preg_match_all('/#(\w+)/', $data['content'], $matches);
        $hashtags = $matches[1];

        if ($hashtags) {
            $hashtagIds = [];
            foreach ($hashtags as $tag) {
                $hashtag = Hashtag::firstOrCreate(['name' => $tag]);
                $hashtagIds[] = $hashtag->id;
            }
            $post->hashtags()->sync($hashtagIds);
        }

        return response()->json([
            'message' => 'تم إنشاء البوست بنجاح',
            'post' => $post
        ], 201);
    }

    // جلب بوستات المستخدم
    public function index()
    {
        $posts = Post::where('user_id', auth()->id())->get();

        if ($posts->isEmpty()) {
            return response()->json([
                'message' => 'مافيش بوستات ليك حاليًا'
            ], 200);
        }

        return response()->json([
            'message' => 'بوستاتك',
            'posts' => $posts
        ], 200);
    }

    // جلب بوست معين
    public function show($id)
    {
        $post = Post::where('user_id', auth()->id())->find($id);

        if (!$post) {
            return response()->json([
                'message' => 'البوست مش موجود أو مش بتاعك'
            ], 404);
        }

        return response()->json([
            'message' => 'البوست',
            'post' => $post
        ], 200);
    }

    // تعديل بوست
    public function update(Request $request, $id)
    {
        $post = Post::where('user_id', auth()->id())->find($id);

        if (!$post) {
            return response()->json([
                'message' => 'البوست مش موجود أو مش بتاعك'
            ], 404);
        }

        $data = $request->validate([
            'title' => 'sometimes|min:3',
            'content' => 'sometimes|min:5',
        ]);

        $post->update($data);

        if (isset($data['content'])) {
            preg_match_all('/#(\w+)/', $data['content'], $matches);
            $hashtags = $matches[1];
            $hashtagIds = [];

            if ($hashtags) {
                foreach ($hashtags as $tag) {
                    $hashtag = Hashtag::firstOrCreate(['name' => $tag]);
                    $hashtagIds[] = $hashtag->id;
                }
                $post->hashtags()->sync($hashtagIds);
            } else {
                $post->hashtags()->detach();
            }
        }

        return response()->json([
            'message' => 'تم تعديل البوست بنجاح',
            'post' => $post
        ], 200);
    }

    // حذف بوست
    public function destroy($id)
    {
        $post = Post::where('user_id', auth()->id())->find($id);

        if (!$post) {
            return response()->json([
                'message' => 'البوست مش موجود أو مش بتاعك'
            ], 404);
        }

        $post->hashtags()->detach();
        $post->delete();

        return response()->json([
            'message' => 'تم حذف البوست بنجاح'
        ], 200);
    }
    public function search(Request $request)
{
    $query = $request->input('query');

    $posts = Post::where('user_id', auth()->id())
                 ->where(function ($q) use ($query) {
                     $q->where('title', 'LIKE', "%$query%")
                       ->orWhere('content', 'LIKE', "%$query%");
                 })
                 ->get();

    if ($posts->isEmpty()) {
        return response()->json([
            'message' => 'مافيش بوستات متطابقة للبحث ده'
        ], 200);
    }

    return response()->json([
        'message' => 'نتايج البحث',
        'posts' => $posts
    ], 200);
}
public function storeComment(Request $request, $postId)
{
    $data = $request->validate([
        'comment' => 'required|string',
    ]);

    $post = Post::where('user_id', auth()->id())->find($postId);

    if (!$post) {
        return response()->json([
            'message' => 'البوست مش موجود أو مش بتاعك'
        ], 404);
    }

    $comment = $post->comments()->create([
        'comment' => $data['comment'],
        'user_id' => auth()->id(),
    ]);

    return response()->json([
        'message' => 'تم إضافة التعليق بنجاح',
        'comment' => $comment
    ], 201);
}

}