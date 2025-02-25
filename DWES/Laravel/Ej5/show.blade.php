@extends('plantilla')

@section('titulo', 'Ficha post')

@section('contenido')
    <h1>{{ $post->titulo }}</h1>
    
    <div class="card mt-4">
        <div class="card-body">
            <p class="card-text">{{ $post->contenido }}</p>
            <p class="card-text"><small class="text-muted">Creado: {{ $post->created_at->format('d/m/Y H:i') }}</small></p>
        </div>
    </div>
    
    <div class="mt-4">
        <a href="{{ route('posts.index') }}" class="btn btn-secondary">Volver al listado</a>
    </div>
@endsection
