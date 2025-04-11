<?php

namespace App\Http\Controllers\Api;
use App\Models\post;
use App\Models\Hashtag;
use App\Models\User;
use App\Models\comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CrudControllerApi extends Controller
{
    public function show()
{
    
    $posts = Post::where('user_id', auth()->id())->get();

    return response()->json([
        'message' => $posts->count() ? 'your posts' : 'You have no posts yet',
        'posts' => $posts
    ], 200);
}

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|min:3',
            'content' => 'required|min:5',
        ]);

        $post = Post::create([
            'title' => $data['title'],
            'content' => $data['content'],
            'user_id' => auth()->id(), 
        ]);

        
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
            'message' => 'create post don',
            'post' => $post
        ], 201);
    }
    public function index($id)
{
    $post = Post::find($id);

    if (!$post) {
        return response()->json([
            'message' => 'post not found'
        ], 404);
    }

    return response()->json([
        'message' => 'result of search',
        'post' => $post
    ], 200);
}

    public function update(Request $request, $id)
    {
        $post = Post::where('user_id', auth()->id())->find($id);

        if (!$post) {
            return response()->json([
                'message' => 'post not found or not for you'
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
            'message' => 'don updat',
            'post' => $post
        ], 200);
    }
    public function destroy($id)
    {
        $post = Post::where('user_id', auth()->id())->find($id);
    
        if (!$post) {
            return response()->json([
                'message' => 'post not found'
            ], 404);
        }
    
        $post->delete();
    
        return response()->json([
            'message' => 'delet don'
        ], 200);
    }
    


    public function search(Request $request)
{
    $query = $request->input('query');

    $posts = Post::where('title', 'LIKE', "%$query%")
                 ->orWhere('content', 'LIKE', "%$query%")
                 ->get();

    if ($posts->isEmpty()) {
        return response()->json([
            'message' => ' There are no posts matching this search.'
        ], 200);
    }

    return response()->json([
        'message' => 'result',
        'query' => $query,
        'posts' => $posts
    ], 200);
}

public function storeComment(Request $request, $postId)
{
    $data = $request->validate([
        'comment' => 'required|string',
    ]);

    $post = Post::find($postId);

    if (!$post) {
        return response()->json([
            'message' => 'post not found'
        ], 404);
    }

    $comment = $post->comments()->create([
        'comment' => $data['comment'],
        'user_id' => auth()->id(),
    ]);

    return response()->json([
        'message' => 'add comment don',
        'comment' => $comment
    ], 201);
}
public function deleteComment($id)
{
    $comment = Comment::where('id', $id)->where('user_id', auth()->id())->first();

    if (!$comment) {
        return response()->json([
            'message' => 'You cannot delete a comment that is not yours'
        ], 404);
    }

    $comment->delete();

    return response()->json([
        'message' => 'delet comment don'
    ], 200);
}


}
