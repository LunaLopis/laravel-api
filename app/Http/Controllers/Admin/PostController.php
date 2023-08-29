<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Models\Type;
use App\Models\Tecnology;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        // path, non nome della rotta
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        $tecnologies = Tecnology::all();
        return view('admin.posts.create', compact('types', 'tecnologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $form_data = $request->all();
        $post = new Post();
        if($request->hasFile('cover_image')){
            if($post->cover_image){
                Storage::delete($post->cover_image);
            }
            $path = Storage::put('post_image', $request->cover_image);
            $form_data['cover_image'] = $path;
        }
        
        $slug = $post->generateSlug($form_data['title']);
        // dd($slug);
        $form_data['slug'] = $slug;
        // per associare i dati del form agli attributi di post 
        $post->fill($form_data);
        // salvo e reindirizzo
         $post->save();
         $post->tecnologies()->attach($request->tecnologies);
         
        return redirect()->route('admin.posts.show', $post->id );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $types = Type::all();
        $tecnologies = Tecnology::all();
        
        return view('admin.posts.edit', compact('post', 'types', 'tecnologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $form_data = $request->all(); 
        if($request->hasFile('cover_image')){
            if($post->cover_image){
                Storage::delete($post->cover_image);
            }
            $path = Storage::put('post_image', $request->cover_image);
            $form_data['cover_image'] = $path;
        }
        // aggiorno slug, ma non serve save 
        $form_data['slug'] = $post->generateSlug($form_data['title']);
        $post->update($form_data);
        // sync per aggiornare eliminando i dati preced. selezionati
        $post->tecnologies()->sync($request->tecnologies);
        return redirect()->route('admin.posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->tecnologies()->detach();
        // copio per eliminare il file dal progetto
        if($post->cover_image){
            Storage::delete($post->cover_image);
        }
        $post->delete();
        $message = 'Cancellazione post completata';
        return redirect()->route('admin.posts.index', ['message' => $message]);
    }
}
