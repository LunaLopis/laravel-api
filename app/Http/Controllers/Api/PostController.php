<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index(){
        // $posts= Post::all();
        $posts = Post::with('type', 'tecnologies')->paginate(3);
        return response()->json([
            'success' => true,
            'results' => $posts,
        ]);
    }
}
