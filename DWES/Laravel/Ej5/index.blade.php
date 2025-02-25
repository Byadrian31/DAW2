@extends('plantilla')

@section('titulo', 'Listado posts')

@section('contenido')
    <h1>Listado de posts</h1>
    
    @if(count($posts) > 0)
        <div class="list-group mt-4">
            @foreach($posts as $post)
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <h5>{{ $post->titulo }}</h5>
                    </div>
                    <div>
                        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary btn-sm">Ver</a>
                        
                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Borrar</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info mt-4">
            No hay posts para mostrar.
        </div>
    @endif
@endsection
