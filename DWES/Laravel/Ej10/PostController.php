<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Usuario;
use Illuminate\Http\Request; // Cambiado de PostRequest a Request

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::orderBy('titulo', 'asc')->get();
        return response()->json($posts, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) // Cambiado de PostRequest a Request
    {
        // Validación manual
        $request->validate([
            'titulo' => 'required|min:5',
            'contenido' => 'required|min:50',
        ]);
        
        $post = new Post();
        $post->titulo = $request->input('titulo');
        $post->contenido = $request->input('contenido');
        
        // Asignamos un usuario cualquiera de la base de datos
        $usuario = Usuario::first();
        $post->usuario_id = $usuario->id;
        
        $post->save();
        
        return response()->json($post, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::findOrFail($id);
        return response()->json($post, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) // Cambiado de PostRequest a Request
    {
        // Validación manual
        $request->validate([
            'titulo' => 'required|min:5',
            'contenido' => 'required|min:50',
        ]);
        
        $post = Post::findOrFail($id);
        $post->titulo = $request->input('titulo');
        $post->contenido = $request->input('contenido');
        $post->save();
        
        return response()->json($post, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        
        return response()->json(null, 204);
    }
}
