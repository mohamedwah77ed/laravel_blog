<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\post;
use App\Models\Hashtag;
use App\Models\User;
use App\Models\comment;



class PostController extends Controller
{
    public function index()//camlecasse
    {
        // select from * post
        $postsfromdb = post::all();// colecation object  return data from post cuolmn
        //dd($postsfromdb);

        return view('geust.home', ['posts' => $postsfromdb]);
    }

    public function show(post $post)
    {
        $comments = $post->comments()->with('user')->latest()->take(5)->get();
         return view('geust.post', compact('post', 'comments'));//compact هي دالة في PHP تأخذ أسماء المتغيرات كسلاسل نصية ('post', 'comments') وتُرجع مصفوفة تحتوي على هذه المتغيرات وقيمها.
//select * from posts where id = $postId limit 1;
//$post = Post::findOrFail($id);
//singlePostFromDB = Post::find($id); //model  object single اسهل واحجه تستخدم فيهم //  $singlePostFromDB = Post::where('id', $postId)->first(); //model object elquent bluder  يعني لزم اكتب الكود كامل سيكول
//$singlePostFromDB = Post::findOrFail($postId); //model object
//$singlePostFromDB = Post::where('id', $postId)->first(); //model object
//$singlePostFromDB = Post::where('id', $postId)->get(); //collection object
//Post::where('title', 'php')->first() //select * from posts where title = 'php' limit 1; هجيب اول بوست عنونة بي اتش بي
//Post::where('title', 'php')->get() // all select * from posts where title = 'php'; هجيب كل البوستات عنونة بي اتش بي
//$comments = $post->comments()->latest()->take(5)->get(); ع
//compact('post', 'comments') يمرر بيانات المقال والتعليقات للعرض.
//['post' => $post, 'comments' => $comments]

}
public function search(Request $request)
{
    $query = $request->input('query');

    $posts = Post::where('title', 'LIKE', "%$query%")
                 ->orWhere('content', 'LIKE', "%$query%")
                 ->get();

    return view('search', compact('posts', 'query'));
}

}
