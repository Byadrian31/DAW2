<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/posts', function () {
    return "Listado de posts";
})->name('post_listado');

Route::get('/posts/{id}', function ($id) {
    return "Ficha del post " . $id;
})->where('id', '[0-9]+')->name('post_ficha');
