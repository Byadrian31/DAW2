<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Api\PostController as ApiPostController;

// Rutas web
Route::get('/', function () {
    return view('inicio');
})->name('inicio');

Route::resource('posts', PostController::class)->only([
    'index', 'show', 'create', 'store', 'edit', 'update', 'destroy'
]);

// Para las rutas API, usaremos un truco: obtener el controlador y llamar a sus métodos directamente
Route::prefix('api')->group(function() {
    // GET /api/posts
    Route::get('/posts', function() {
        $controller = new ApiPostController();
        return $controller->index();
    });
    
    // POST /api/posts
    Route::post('/posts', function(\Illuminate\Http\Request $request) {
        $controller = new ApiPostController();
        // Ignorar CSRF para esta ruta
        return $controller->store($request);
    })->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);
    
    // GET /api/posts/{id}
    Route::get('/posts/{id}', function($id) {
        $controller = new ApiPostController();
        return $controller->show($id);
    });
    
    // PUT /api/posts/{id}
    Route::put('/posts/{id}', function(\Illuminate\Http\Request $request, $id) {
        $controller = new ApiPostController();
        return $controller->update($request, $id);
    })->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);
    
    // DELETE /api/posts/{id}
    Route::delete('/posts/{id}', function($id) {
        $controller = new ApiPostController();
        return $controller->destroy($id);
    })->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);
});
