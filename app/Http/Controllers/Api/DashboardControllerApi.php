<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post; 

class DashboardControllerApi extends Controller
{
    public function index()
    {
        $posts = Post::all();

        
        return response()->json([
            'message' => 'Posts retrieved successfully',
            'posts' => $posts,
        ], 200);
    }
}