<?php

use App\Http\Controllers\AutoController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\ModeloController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//RUTA POR DEFECTO
/*
Route::get('/', function () {
    return view('welcome');
});
*/

// PASO 1
// ROUTE PARA PRESENTAR UNA VISTA UTILIZANDO EL MÉTODO GET
Route::get('/', function () {
    return View('welcome');
});

//Demo va a desplegar un JSON

// ROUTE PARA PRESENTAR UN TEXTO UTILIZANDO EL MÉTODO GET
Route::get('demo1', function () {
    return 'Hola Laravel';
});
// ROUTE PARA PRESENTAR UN JSON UTILIZANDO EL MÉTODO GET
Route::get('demo2', function () {
    return '{
    "Nombre":"Byron",
    "Apellido":"Loarte",
    "Ciudad":"Quito"
    }';
});


// PASO 2
// PROBLEMA DE LAS RUTAS SIN EL MÉTODO NAME

       //ingresamos a la ruta service
Route::get('servicio',function(){

    return'
        <a href="servicio">servicios</a>
        <br>
        <a href="servicio">servicios</a>
        <br>
        <a href="servicio">servicios</a>
        <br>
        <a href="servicio">servicios</a>
    ';
});


// PASO 3
// ROUTE PARA PRESENTAR UNA VISTA UTILIZANDO EL MÉTODO VIEW Y EL MÉTODO NAME
//Cambio de nombre de manera dinamica
Route::get('/', function () {
    return View('home');
})->name('home');

//PASO 4
// ROUTE PARA MANDAR DATOS A LA VISTA
Route::get('modelos',function()
{
    // ES VÁLIDO PERO SE DEBE RECORDAR QUE PARA TRAER DATOS O PROCESAR
    // PETICIONES DE LA BDD SE UTILIZA UN CONTROLADOR
    $autos =
    [
        "CHEVROLET"=>'TRACKER',
        "MAZDA"=>'323',
        "FORD"=>'RANGER',
        "KIA"=>'SPORTAGE',
        "GREAT WALL"=>'WINGLE'
    ];
    $nombre = "Byron";
    return view('modelos',compact('autos','nombre'));
    //si en esta parte me da error , seguramente es que no esta creada la vista
    //las variables van en los controladores
})->name('models');

// PASO 5
Route::get('/', function () {
    return View('home');
})->name('home');

//BAUTIZAR LAS RUTAS YA QUE ESTAS SERAN UTILIZADAS EN LAYOUT/NAVE.PHP
// ROUTE PARA PRESENTAR UNA VISTA UTILIZANDO EL MÉTODO VIEW Y EL MÉTODO NAME
Route::view('nosotros','nosotros')->name('about');

// ROUTE PARA PRESENTAR UNA VISTA UTILIZANDO EL MÉTODO VIEW Y EL MÉTODO NAME
Route::view('personal','personal')->name('personal');
/*
Route::get('modelos',function()
{
    $autos =
    [
        "CHEVROLET"=>'TRACKER',
        "MAZDA"=>'323',
        "FORD"=>'RANGER',
        "KIA"=>'SPORTAGE',
        "GREAT WALL"=>'WINGLE'
    ];
    $nombre = "Byron";
    return view('modelos',compact('autos','nombre'));
})->name('models');*/

Route::get('modelos',ModeloController::class)->name('models');

// PASAR PARAMETROS A LA ROUTE
/*Route::get('contactos/{name?}',function($name='Invitado')
{
    return view('contactos',compact('name'));
})->name('contact');*/

Route::get('contactos/{name?}',[ContactoController::class,'dataContact'])->name('contact'); //controlador propio de la funcion

Route::resource('autos',AutoController::class)->except('index','show');