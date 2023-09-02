<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index(){
        // $posts= Post::all();
            // Recupera una lista di post paginata con relazioni "type" e "tecnologies"
        $posts = Post::with('type', 'tecnologies')->paginate(3);
         // Restituisci una risposta JSON con i risultati della query
        return response()->json([
            'success' => true,
            'results' => $posts,
        ]);
    }


    public function show($slug){
        $post = Post::with('type', 'tecnologies')->where('slug', $slug)->first();
        if ($post) {
            return response()->json([
                'success' => true,
                'results' => $post,
            ]);
        }
        else{
            return response()->json([
                'success' => false,
                'results' => 'non trovato',
            ]); 
        }
    }
}
