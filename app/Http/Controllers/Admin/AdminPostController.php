<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\post;
use App\Models\Hashtag;
use App\Models\User;


class AdminPostController extends Controller
{
    public function index()
    {
        $posts = Post::all(); 
        return view('admin.index', ['posts' => $posts]); // تصحيح المتغير هنا
    }
    
    public function edit_post(Post $post)
{
    return view('admin.edit_post', compact('post'));
}

    public function update_post($id)
    {
        $request = request();
       // dd($request->all());
       // $data = $request->all();
        $title = request()->title;
        $content = request()->content;
      

         
        $singlePostFromDB = Post::find($id);
        $singlePostFromDB->update([
            'title' => $title,
            'content' => $content,
           
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
        return to_route('admin.dashboard');

    }

    public function destroy($id)
{
    $post = Post::findOrFail($id); 
    $post->delete();
    return to_route('admin.dashboard');
}


}
