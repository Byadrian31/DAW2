@extends('plantilla')

@section('titulo', 'Editar post')

@section('contenido')
    <h1>Editar post</h1>
    
    <form action="{{ route('posts.update', $post->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" class="form-control @error('titulo') is-invalid @enderror" id="titulo" name="titulo" value="{{ old('titulo', $post->titulo) }}" required>
            @if ($errors->has('titulo'))
                <div class="invalid-feedback">
                    {{ $errors->first('titulo') }}
                </div>
            @endif
        </div>
        
        <div class="mb-3">
            <label for="contenido" class="form-label">Contenido</label>
            <textarea class="form-control @error('contenido') is-invalid @enderror" id="contenido" name="contenido" rows="5" required>{{ old('contenido', $post->contenido) }}</textarea>
            @if ($errors->has('contenido'))
                <div class="invalid-feedback">
                    {{ $errors->first('contenido') }}
                </div>
            @endif
        </div>
        
        <input type="hidden" name="usuario_id" value="{{ $post->usuario_id }}">
        
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection
