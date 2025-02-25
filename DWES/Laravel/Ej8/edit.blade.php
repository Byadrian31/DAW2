@extends('plantilla')

@section('titulo', 'Editar post')

@section('contenido')
    <h1>Editar post</h1>
    
    <form action="{{ route('posts.update', $post->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" class="form-control" id="titulo" name="titulo" value="{{ $post->titulo }}" required>
        </div>
        
        <div class="mb-3">
            <label for="contenido" class="form-label">Contenido</label>
            <textarea class="form-control" id="contenido" name="contenido" rows="5" required>{{ $post->contenido }}</textarea>
        </div>
        
        <input type="hidden" name="usuario_id" value="{{ $post->usuario_id }}">
        
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection
