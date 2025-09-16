<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServicoController;
use App\Http\Controllers\ClienteController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/servico', [ServicoController::class, 'index'])->name('servico.index');
Route::get('/servico/create', [ServicoController::class, 'create'])->name('servico.create');
Route::post('/servico', [ServicoController::class, 'store'])->name('servico.store');
Route::get('/servico/edit/{id}', [ServicoController::class, 'edit'])->name('servico.edit');
Route::put('/servico/update/{id}', [ServicoController::class, 'update'])->name('servico.update');
Route::post('/servico/search', [ServicoController::class, 'search'])->name('servico.search');
Route::delete('/servico/{id}', [ServicoController::class, 'destroy'])->name('servico.destroy');

Route::get('/cliente', [ClienteController::class, 'index'])->name('cliente.index');
Route::get('/cliente/create', [ClienteController::class, 'create'])->name('cliente.create');
Route::post('/cliente', [ClienteController::class, 'store'])->name('cliente.store');
Route::get('/cliente/edit/{id}', [ClienteController::class, 'edit'])->name('cliente.edit');
Route::put('/cliente/update/{id}', [ClienteController::class, 'update'])->name('cliente.update');
Route::post('/cliente/search', [ClienteController::class, 'search'])->name('cliente.search');
Route::delete('/cliente/{id}', [ClienteController::class, 'destroy'])->name('cliente.destroy');