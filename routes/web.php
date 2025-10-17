<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServicoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CarroController;
use App\Http\Controllers\MecanicoController;
use App\Http\Controllers\RelatorioController;


Route::get('/', function () {
    return view('index');
});

Route::get('/servico', [ServicoController::class, 'index'])->name('servico.index');
Route::get('/servico/create', [ServicoController::class, 'create'])->name('servico.create');
Route::post('/servico', [ServicoController::class, 'store'])->name('servico.store');
Route::get('/servico/edit/{id}', [ServicoController::class, 'edit'])->name('servico.edit');
Route::put('/servico/update/{id}', [ServicoController::class, 'update'])->name('servico.update');
Route::post('/servico/search', [ServicoController::class, 'search'])->name('servico.search');
Route::delete('/servico/{id}', [ServicoController::class, 'destroy'])->name('servico.destroy');

Route::get('relatorio/servicos', [RelatorioController::class, 'index'])->name('relatorio.servicos');

Route::get('/mecanico', [MecanicoController::class, 'index'])->name('mecanico.index');
Route::get('/mecanico/create', [MecanicoController::class, 'create'])->name('mecanico.create');
Route::post('/mecanico', [MecanicoController::class, 'store'])->name('mecanico.store');
Route::get('/mecanico/edit/{id}', [MecanicoController::class, 'edit'])->name('mecanico.edit');
Route::put('/mecanico/update/{id}', [MecanicoController::class, 'update'])->name('mecanico.update');
Route::post('/mecanico/search', [MecanicoController::class, 'search'])->name('mecanico.search');
Route::delete('/mecanico/{id}', [MecanicoController::class, 'destroy'])->name('mecanico.destroy');

Route::get('/cliente', [ClienteController::class, 'index'])->name('cliente.index');
Route::get('/cliente/create', [ClienteController::class, 'create'])->name('cliente.create');
Route::post('/cliente', [ClienteController::class, 'store'])->name('cliente.store');
Route::get('/cliente/edit/{id}', [ClienteController::class, 'edit'])->name('cliente.edit');
Route::put('/cliente/update/{id}', [ClienteController::class, 'update'])->name('cliente.update');
Route::post('/cliente/search', [ClienteController::class, 'search'])->name('cliente.search');
Route::delete('/cliente/{id}', [ClienteController::class, 'destroy'])->name('cliente.destroy');

Route::get('/carro', [CarroController::class, 'index'])->name('carro.index');
Route::get('/carro/create', [CarroController::class, 'create'])->name('carro.create');
Route::post('/carro', [CarroController::class, 'store'])->name('carro.store');
Route::get('/carro/edit/{id}', [CarroController::class, 'edit'])->name('carro.edit');
Route::put('/carro/update/{id}', [CarroController::class, 'update'])->name('carro.update');
Route::post('/carro/search', [CarroController::class, 'search'])->name('carro.search');
Route::delete('/carro/{id}', [CarroController::class, 'destroy'])->name('carro.destroy');