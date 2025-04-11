<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserProfileController extends Controller
{
    public function index()
    {
        $users = User::where('is_admin', false)->get(); // جلب اليوزرز العاديين بس
        return view('admin.users', compact('users'));
}
public function edit($id)
{
    $user = User::findOrFail($id);
    return view('admin.usersedit', compact('user'));
}

public function update(Request $request, $id)
{
    $user = User::findOrFail($id);
    $user->update($request->all());
    return redirect()->route('users.index')->with('success', 'تم تحديث البيانات بنجاح');
}

public function destroy($id)
{
    $user = User::findOrFail($id);
    $user->delete();
    return redirect()->route('users.index')->with('success', 'تم حذف المستخدم بنجاح');
}
}