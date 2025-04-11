<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\post;
use App\Models\Hashtag;
use App\Models\User;


class UserPostController extends Controller
{
    public function show()
{
    $posts = Post::where('user_id', auth()->id())->get();
    return view('user.posts', compact('posts'));
}

   
    public function show_post(post $post)
    {
        $comments = $post->comments()->with('user')->get();
        //$comments = $post->comments()->latest()->take(5)->get)   
        
        return view('user.show_post', compact('post', 'comments'));
        
        //compact('post', 'comments')
        //['post' => $post, 'comments' => $comments]
        
        }

public function create()
{
    $users = User::all();
    return view('user.create');

}

public function store(Request $request)
{
    $request->validate([
        'title' => ['required', 'min:3'],
        'content' => ['required', 'min:5'],
    ]);

    $post = Post::create([
        'title' => $request->input('title'),
        'content' => $request->input('content'),
        'user_id' => auth()->id(), 
    ]);

    preg_match_all('/#(\w+)/u', $request->input('content'), $matches);
    $hashtags = $matches[1];

    if (!empty($hashtags)) {
        $hashtagIds = [];

        foreach ($hashtags as $tagName) {
            $tagName = trim($tagName);
            if (!empty($tagName)) {
                $hashtag = Hashtag::firstOrCreate(['name' => $tagName]);
                $hashtagIds[] = $hashtag->id;
            }
        }

        $post->hashtags()->sync($hashtagIds);
    }

    return to_route('dashboard');
}

public function edit(Post $post)
{
    return view('user.edit_post', compact('post'));
}

    public function update($id)
    {
        $request = request();
       // dd($request->all());
       // $data = $request->all();
        $title = request()->title;
        $content = request()->content;
       // $author = request()->author;
        //dd($title, $content, $author);

        //return $data;

         //2- update the submitted data in database
            //select or find the post
            //update the post data
        $singlePostFromDB = Post::find($id);
        $singlePostFromDB->update([
            'title' => $title,
            'content' => $content,
           // 'author' => $postCreator,
        ]);
        preg_match_all('/#(\w+)/u', $request->input('content'), $matches);
        $hashtags = $matches[1]; 

        if (!empty($hashtags)) {
            $hashtagIds = [];

            foreach ($hashtags as $tagName) {
                $tagName = trim($tagName);
                if (!empty($tagName)) {
                    $hashtag = Hashtag::firstOrCreate(['name' => $tagName]);
                    $hashtagIds[] = $hashtag->id;
                }
            }

            $post->hashtags()->sync($hashtagIds);
        }
        return to_route('myposts.show', $id);

    }
    public function destroy($id)
    {
        $post = Post::find($id);
       // dd($post);
        $post->delete();
        return to_route('myposts.show');

    }


}
