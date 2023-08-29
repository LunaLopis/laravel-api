<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Tecnology;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTecnologyRequest;
use App\Http\Requests\UpdateTecnologyRequest;

class TecnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tecnologies = Tecnology::all();
        // path, non nome della rotta
        return view('admin.tecnologies.index', compact('tecnologies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tecnologies = Tecnology::all();
        return view('admin.tecnologies.create', compact('tecnologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTecnologyRequest $request)
    {
        $form_data = $request->validated();

        $tecnology = new Tecnology();
        $tecnology->name = $form_data['name'];
        $slug = $tecnology->generateSlug($form_data['name']);
        $form_data['slug'] = $slug;
        $tecnology->fill($form_data);
    
        $tecnology->save();
        
        return redirect()->route('admin.tecnologies.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tecnology  $tecnology
     * @return \Illuminate\Http\Response
     */
    public function show(Tecnology $tecnology)
    {
        return view('admin.tecnologies.show', compact('tecnology'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tecnology  $tecnology
     * @return \Illuminate\Http\Response
     */
    public function edit(Tecnology $tecnology)
    {
        $tecnologies = Tecnology::all();
        return view('admin.tecnologies.edit', compact('tecnologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tecnology  $tecnology
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tecnology $tecnology)
    {
        $form_data = $request->all();
        $form_data['slug'] = $tecnology->generateSlug($form_data['name']);
        $tecnology->update($form_data);
        return redirect()->route('admin.tecnologies.index', $tecnology->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tecnology  $tecnology
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tecnology $tecnology)
    {// Rimuovi le relazioni associate alla tecnologia dalla tabella post_tecnologies
    $tecnology->posts()->detach();

    // Ora puoi procedere con la cancellazione della tecnologia
    $tecnology->delete();

    $message = 'Cancellazione tecnologia completata';
    return redirect()->route('admin.tecnologies.index', ['message' => $message]);
    }
}
