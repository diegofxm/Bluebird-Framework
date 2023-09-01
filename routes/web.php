<?php

use Lib\Route;

use App\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index']);

Route::get('contact', function () {
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
});

//++++++++++++++++++++++++++++++++++++++++++++//

Route::dispatch();
