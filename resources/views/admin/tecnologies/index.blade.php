@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 mt-5">
            <h1>tecnologies</h1>
            <div>
                <a href="{{route('admin.tecnologies.create')}}"> aggiungi nuova tecnologia</a>
            </div>
        </div>
 
        <div class="col-12 mt-5">
            <table class="table table-stripped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>titolo</th>
                        <th>slug</th>
                        <th>strumenti</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tecnologies as $tecnology)
                        <tr>
                            <td>{{$tecnology->id}}</td>
                            <td>{{$tecnology->name}}</td>
                            <td>{{$tecnology->slug}}</td>
                            <td>
 
                                <a href="{{route('admin.tecnologies.show', $tecnology->id)}}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{route('admin.tecnologies.edit', $tecnology->id)}}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
{{-- la rotta dove entrare per cancellare l'id selezionato; destroy funztion, mentre delete è il metodo --}}
                                <form action="{{ route('admin.tecnologies.destroy', $tecnology->id) }}" class="d-inline-block" method="POST" onsubmit="return confirm('sei sicuro di voler eliminare questo tecnology?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash" data-tecnology-title='{{$tecnology->title}}'></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@include('admin.partials.modal_delete')
@endsection
