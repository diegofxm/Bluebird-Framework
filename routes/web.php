<?php

use App\Controllers\ContactController;
use Lib\Route;

use App\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index']);

Route::get('contacts', [ContactController::class, 'index']);

Route::get('contacts/create', [ContactController::class, 'create']);

Route::post('contacts', [ContactController::class, 'store']);

Route::get('contacts/:id', [ContactController::class, 'show']);

Route::get('contacts/:id/edit', [ContactController::class, 'edit']);

Route::post('contacts/:id', [ContactController::class, 'update']);

Route::post('contacts/:id/delete', [ContactController::class, 'destroy']);


/*Route::get('contact', function () {
    return 'Hola desde la página de contacto';
});

Route::get('about', function () {
    return 'Hola desde la página de acerca de';
});

Route::get('/courses/prueba', function () {
    return 'hola desde el pagina de cursos de prueba';
});

Route::get('courses/:slug', function ($slug) {
    return 'El curso actual es: ' . $slug;
});*/

//++++++++++++++++++++++++++++++++++++++++++++//

Route::dispatch();
