<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rotas do Sistema de Registro de Carros
|--------------------------------------------------------------------------
*/

Route::get('/criar-admin-secreto', function () {
    User::updateOrCreate(
        ['email' => 'joao@teste.com'],
        [
            'name' => 'Joao',
            'password' => bcrypt('123456'),
        ]
    );

    return 'Admin criado com sucesso';
});

Route::get('/', function () {
    return redirect()->route('cars.index');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Carros
    Route::resource('cars', CarController::class);
    Route::patch('cars/{car}/toggle-payment', [CarController::class, 'togglePayment'])->name('cars.toggle-payment');

    // Eventos
    Route::resource('events', EventController::class);
    Route::post('events/{event}/cars', [EventController::class, 'addCar'])->name('events.cars.add');
    Route::patch('events/{event}/cars/{car}/toggle-payment', [EventController::class, 'toggleCarPayment'])->name('events.cars.toggle-payment');
    Route::delete('events/{event}/cars/{car}', [EventController::class, 'removeCar'])->name('events.cars.remove');
});

require __DIR__.'/auth.php';