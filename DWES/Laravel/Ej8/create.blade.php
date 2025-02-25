@extends('plantilla')

@section('titulo', 'Crear nuevo post')

@section('contenido')
    <h1>Crear nuevo post</h1>
    
    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        
        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" class="form-control" id="titulo" name="titulo" required>
        </div>
        
        <div class="mb-3">
            <label for="contenido" class="form-label">Contenido</label>
            <textarea class="form-control" id="contenido" name="contenido" rows="5" required></textarea>
        </div>
        
        <input type="hidden" name="usuario_id" value="{{ App\Models\Usuario::first()->id }}">
        
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('posts.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection
