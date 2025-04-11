<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\post;
use App\Models\Hashtag;
use App\Models\User;


class UserController  extends Controller
{
    public function show(User $user)
    {
        $posts = $user->posts()->latest()->paginate(10); // جلب كل البوستات الخاصة بالمستخدم مع الترتيب بالأحدث
        return view('geust.userprofile', compact('user', 'posts'));
    }
    

}