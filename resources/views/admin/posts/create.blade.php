@extends('layouts.admin')
@section('content')
<div class="container">
   <div class="row">
       <div class="col-12">
           <h1 class=""> aggiungi nuovo progetto</h1>
           <div>
               <a href="{{Route('admin.posts.index')}}" class="btn btn-sm btn-primary">tutti i progetti</a>
           </div>
       </div>
        
       <div class="col-12">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
          <form action="{{ route('admin.posts.store')}}" method="POST" enctype="multipart/form-data">
            {{-- per provenienza richieste --}}
            @csrf
            <div class="form-group mt-4">
               <label class="control-label">Titolo</label>
               <input type="text" name="title" id="title" placeholder="titolo"  class="form-control @error('title')is-invalid @enderror" value="{{old('title')}}"  >
               @error('title')
               <div class="text-danger"> {{$message}}</div>
               @enderror
            </div>

            <div class="form-group mt-4">
                <label class="control-label">contenuto</label>
                <textarea type="text" name="content" id="content" placeholder="contenuto" class="form-control @error('content') is-invalid @enderror"></textarea>
             </div>

             <div class="form-group mt-4">
                <label class="control-label">categoria</label>
                <select  name="type_id" id="type_id" class="form-control @error('type_id') is-invalid @enderror" placeholder="type_id" value="{{ old('type_id')}}">
                    <option value="">seleziona categoria</option>
                    @foreach($types as $type)
                       <option value="{{$type->id}}">{{$type->name}}</option>
                    @endforeach
                </select>
             </div> 
             @error('type_id')
             <div class="text-danger">{{ $message}}</div>
             @enderror

             <div class="form-group mt-4">
                <p>tecnologie</p>
                @foreach($tecnologies as $tecnology)
                    <div class="form-check">
                        <input type="checkbox" name="tecnologies[]" id="tecnology_{{ $tecnology->id }}" class="form-check-input" value="{{ $tecnology->id }}" {{ in_array($tecnology->id, old('tecnologies', [])) ? 'checked' : '' }}>
                        <label for="tecnology_{{ $tecnology->id }}" class="form-check-label">{{ $tecnology->name }}</label>
                    </div>
                @endforeach
                @error('tecnologies')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            

             @error('type_id')
             <div class="text-danger">{{ $message}}</div>
             @enderror

             <div class="form-group mt-4">
                <label class="control-label">immagine</label>
                <input type="file" name="cover_image" id="cover_image" class="form-control @error('cover_image') is-invalid @enderror" placeholder="cover_image" value="{{ old('content')}}">
             </div> 

             <div class="form-group mt-4">
                <button type="submit" class="btn btn-success">Salva</button>
             </div>
        </form>
       </div>
       
       

   </div>
</div>
@endsection