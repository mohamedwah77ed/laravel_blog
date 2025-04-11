<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\post;
use App\Models\Hashtag;
use App\Models\User;



class DashboardController extends Controller
{
    public function index()//camlecasse
    {
        // select from * post
        $postsfromdb = post::all();// colecation object  return data from post cuolmn
        //dd($postsfromdb);

        return view('dashboard', ['posts' => $postsfromdb]);
    }
    
}
