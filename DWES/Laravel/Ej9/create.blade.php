@extends('plantilla')

@section('titulo', 'Crear nuevo post')

@section('contenido')
    <h1>Crear nuevo post</h1>
    
    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        
        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" class="form-control @error('titulo') is-invalid @enderror" id="titulo" name="titulo" value="{{ old('titulo') }}" required>
            @if ($errors->has('titulo'))
                <div class="invalid-feedback">
                    {{ $errors->first('titulo') }}
                </div>
            @endif
        </div>
        
        <div class="mb-3">
            <label for="contenido" class="form-label">Contenido</label>
            <textarea class="form-control @error('contenido') is-invalid @enderror" id="contenido" name="contenido" rows="5" required>{{ old('contenido') }}</textarea>
            @if ($errors->has('contenido'))
                <div class="invalid-feedback">
                    {{ $errors->first('contenido') }}
                </div>
            @endif
        </div>
        
        <input type="hidden" name="usuario_id" value="{{ App\Models\Usuario::first()->id }}">
        
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('posts.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection
