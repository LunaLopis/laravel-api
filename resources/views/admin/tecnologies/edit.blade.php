@extends('layouts.admin')
@section('content')
<div class="container">
   <div class="row">
       <div class="col-12">
           <h1 class=""> modifica tecnologia</h1>
           <div>
               <a href="{{Route('admin.tecnologies.index')}}" class="btn btn-sm btn-primary">tutti i progetti</a>
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
          <form action="{{ route('admin.tecnologies.store')}}" method="POST">
            {{-- per provenienza richieste --}}
            @csrf
            <div class="form-group mt-4">
               <label class="control-label">Nome</label>
               <input type="text" name="name" id="name" placeholder="categoria"  class="form-control @error('name')is-invalid @enderror" value="{{old('name')}}"  >
               
            </div>

             <div class="form-group mt-4">
                <button type="submit" class="btn btn-success">Salva</button>
             </div>
        </form>
       </div>
       
       

   </div>
</div>
@endsection