<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/test', [App\Http\Controllers\Test::class, 'test']);

Route::get('/', function () {
    return view('welcome');
});


Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/testmail', function () {
    $user = User::find(1); // Cambia el ID a la del usuario que quieres probar

    if ($user) {
        $user->sendEmailVerificationNotification(); // Enviar el correo de verificación
        return 'Correo de verificación enviado a ' . $user->email;
    } else {
        return 'Usuario no encontrado.';
    }
});