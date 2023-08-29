@extends('layouts.admin')
@section('content')
<div class="container">
   <div class="row">
       <div class="col-12">
           <h1 class=""> {{ $post->title}}</h1>
       </div>
       <div>
           <p> {{$post->content}}</p>
       </div>
       <div>
            <img src="{{ asset('storage/' .$post->cover_image)}}" width="500px">
       </div>
       <div>
        {{-- <p> {{$post->type->name}}</p>  --}}
         @if($post->type)
               <p> {{$post->type->name}}</p>
           @else
               <p> nessuna categoria selezionata</p>
           @endif 
           @if($post->tecnologies->count() > 0)

           <p> Tecnologie associate:</p>
           <ul>
               @foreach($post->tecnologies as $tecnology)
                   <li>{{ $tecnology->name }}</li>
               @endforeach
           </ul>

           @else

               <p> Nessuna tecnologia selezionata</p>

           @endif
    </div>
   </div>

   <a href="{{route('admin.posts.edit', $post->id)}}" class="btn btn-sm btn-warning">
    <i class="fas fa-edit"></i>
</a>
{{-- la rotta dove entrare per cancellare l'id selezionato; destroy funztion, mentre delete è il metodo --}}
<form action="{{ route('admin.posts.destroy', $post->id) }}" class="d-inline-block" method="POST" onsubmit="return confirm('sei sicuro di voler eliminare questo post?')">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash" data-post-title='{{$post->title}}'></i></button>
</form>

</div>
@endsection