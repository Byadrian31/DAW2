@extends('plantilla')

@section('titulo', 'Ficha post')

@section('contenido')
    <h1>{{ $post->titulo }}</h1>
    
    <div class="card mt-4">
        <div class="card-body">
            <p class="card-text">{{ $post->contenido }}</p>
            <p class="card-text">
                <small class="text-muted">
                    Creado: {{ $post->created_at->format('d/m/Y H:i') }}
                    @if($post->usuario)
                        por {{ $post->usuario->login }}
                    @endif
                </small>
            </p>
        </div>
    </div>
    
    <div class="mt-4">
        <a href="{{ route('posts.index') }}" class="btn btn-secondary">Volver al listado</a>
        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary">Editar</a>
        
        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
            @method('DELETE')
            @csrf
            <button type="submit" class="btn btn-danger">Borrar</button>
        </form>
    </div>
@endsection
