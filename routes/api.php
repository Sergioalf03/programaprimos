<?php

use App\Http\Controllers\AutorController;
use App\Http\Controllers\InteraccionController;
use App\Http\Controllers\LibroController;
use Illuminate\Support\Facades\Route;

Route::get('/autor/list', [AutorController::class, 'getList']);
Route::get('/autor/{id}', [AutorController::class, 'getOne']);
Route::post('/autor/save', [AutorController::class, 'save']);
Route::put('/autor/{id}', [AutorController::class, 'update']);
Route::delete('/autor/{id}', [AutorController::class, 'delete']);

Route::get('/libro/list', [LibroController::class, 'getList']);
Route::get('/libro/{id}', [LibroController::class, 'getOne']);
Route::get('/libro/autor/{id}', [LibroController::class, 'getAuthor']);
Route::post('/libro/save', [LibroController::class, 'save']);
Route::put('/libro/{id}', [LibroController::class, 'update']);
Route::delete('/libro/{id}', [LibroController::class, 'delete']);

Route::get('/hola-mundo', [ InteraccionController::class, 'HolaMundo' ]);
Route::delete('/hola-con-nombre/{name}', [ InteraccionController::class, 'HolaMundoConNombre' ]);
Route::post('/hola-mundo', [ InteraccionController::class, 'MensajePersonalizado' ]);

Route::get('/suma-resta-parametros/{numero1}/{numero2}', [InteraccionController::class, 'sumaYRestaPorParametros']);
Route::get('/suma-resta-juan/{num1}/{num2}', [InteraccionController::class, 'sumayresta']);
Route::post('/suma-resta-body', [InteraccionController::class, 'sumaYRestaPorBody']);
Route::get('/edad/{edad}', [InteraccionController::class, 'mayorEdad']);
Route::get('/10/{numero}/{limite}', [InteraccionController::class, 'tabla10']);
Route::get('/tabla/{numero}', [InteraccionController::class, 'tablasdemultiplicar']);

Route::get('alumno', []);  // lista de alumnos
Route::post('alumno', []);  // guardar alumnos
Route::put('alumno/{id}', ['actualizar']);  // actualizar alumno
Route::delete('alumno/{id}', ['eliminar']);  // eliminar alumno
