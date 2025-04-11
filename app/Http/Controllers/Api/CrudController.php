<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Hashtag;

class CrudController extends Controller
{
    // Create a new post
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|min:3',
            'content' => 'required|min:5',
        ]);

        $post = Post::create([
            'title' => $data['title'],
            'content' => $data['content'],
            'user_id' => auth()->id(), // user from token
        ]);

        // Extract hashtags
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
            'message' => 'Post created successfully',
            'post' => $post
        ], 201);
    }

    // Get user's posts
    public function index()
    {
        $posts = Post::where('user_id', auth()->id())->get();

        if ($posts->isEmpty()) {
            return response()->json([
                'message' => 'You have no posts yet'
            ], 200);
        }

        return response()->json([
            'message' => 'Your posts',
            'posts' => $posts
        ], 200);
    }

    // Get a specific post
    public function show($id)
    {
        $post = Post::where('user_id', auth()->id())->find($id);

        if (!$post) {
            return response()->json([
                'message' => 'Post not found or not owned by you'
            ], 404);
        }

        return response()->json([
            'message' => 'Post details',
            'post' => $post
        ], 200);
    }

    // Update a post
    public function update(Request $request, $id)
    {
        $post = Post::where('user_id', auth()->id())->find($id);

        if (!$post) {
            return response()->json([
                'message' => 'Post not found or not owned by you'
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
            'message' => 'Post updated successfully',
            'post' => $post
        ], 200);
    }

    // Delete a post
    public function destroy($id)
    {
        $post = Post::where('user_id', auth()->id())->find($id);

        if (!$post) {
            return response()->json([
                'message' => 'Post not found or not owned by you'
            ], 404);
        }

        $post->hashtags()->detach();
        $post->delete();

        return response()->json([
            'message' => 'Post deleted successfully'
        ], 200);
    }

    // Search posts
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
                'message' => 'No posts matched the search query'
            ], 200);
        }

        return response()->json([
            'message' => 'Search results',
            'posts' => $posts
        ], 200);
    }

    // Add a comment to a post
    public function storeComment(Request $request, $postId)
    {
        $data = $request->validate([
            'comment' => 'required|string',
        ]);

        $post = Post::where('user_id', auth()->id())->find($postId);

        if (!$post) {
            return response()->json([
                'message' => 'Post not found or not owned by you'
            ], 404);
        }

        $comment = $post->comments()->create([
            'comment' => $data['comment'],
            'user_id' => auth()->id(),
        ]);

        return response()->json([
            'message' => 'Comment added successfully',
            'comment' => $comment
        ], 201);
    }
}
