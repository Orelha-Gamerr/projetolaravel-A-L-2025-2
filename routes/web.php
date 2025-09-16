<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServicoController;


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

/*
Route::get('/aluno', function () {
    return view('aluno.list');
});
*/