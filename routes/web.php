<?php

use App\Http\Controllers\CertificadoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PpcController;
use App\Http\Controllers\SubmissaoController;
use App\Http\Controllers\TipoAtividadeController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth/login');
})->name('raiz');

Route::middleware(['auth'])->group(function() {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('submissao', App\Http\Controllers\SubmissaoController::class);
    Route::post('/criarSubmissao', [SubmissaoController::class, 'store'])->name('criarSubmissao');
    Route::delete('/excluirSubmissao/{submissao_id}', [SubmissaoController::class, 'destroy'])->name('excluirSubmissao');
    Route::get('/editarSubmissao/{submissao_id}', [SubmissaoController::class, 'edit'])->name('editarSubmissao');
    Route::get('/verSubmissao/{submissao_id}', [SubmissaoController::class, 'show'])->name('verSubmissao');
    Route::get('/verSubmissoes/{avaliador_id}', [SubmissaoController::class, 'submissoesAvaliadas'])->name('verSubmissoes');
    Route::get('/verSubmissoesAluno/{aluno_id}', [SubmissaoController::class, 'submissoesEnviadas'])->name('verSubmissoesAluno');
    Route::post('/rejeitarSubmissao/{submissao_id}', [SubmissaoController::class, 'rejeitar'])->name('rejeitarSubmissao');
    Route::get('/aprovarSubmissao/{submissao_id}', [SubmissaoController::class, 'aprovarForm'])->name('aprovarSubmissaoForm');
    Route::post('/aprovarSubmissao/{submissao_id}', [SubmissaoController::class, 'aprovar'])->name('aprovarSubmissao');

    Route::resource('certificado', App\Http\Controllers\CertificadoController::class);
    Route::get('/anexarCertificado/{submissao_id}', [CertificadoController::class, 'create'])->name('anexarCertificado');
    Route::post('/criarCertificado/{submissao_id}', [CertificadoController::class, 'store'])->name('criarCertificado');
    Route::get('/editarCertificado/{certificado_id}', [CertificadoController::class, 'edit'])->name('editarCertificado');
    Route::put('/atualizarCertificado/{certificado_id}', [CertificadoController::class, 'update'])->name('atualizarCertificado');
    Route::delete('/excluirCertificado/{certificado_id}', [CertificadoController::class, 'destroy'])->name('excluirCertificado');

// Rotas do Admin

    Route::get('/criarPpc', function () {
        return view('ppc/criarPpc');
    })->name('ppc');

    Route::resource('ppcs', App\Http\Controllers\PpcController::class);
    Route::post('/ppc', [PpcController::class, 'store'])->name('criarPpc');
    Route::delete('/excluirPpc/{ppc_id}', [PpcController::class, 'destroy'])->name('excluirPpc');
    Route::get('/editarPpc/{ppc_id}', [PpcController::class, 'edit'])->name('editarPpc');
    Route::put('/atualizarPpc/{ppc_id}', [PpcController::class, 'update'])->name('atualizarPpc');
    Route::post('/duplicarPpc/{ppc_id}', [PpcController::class, 'duplicar'])->name('duplicarPpc');

    Route::resource('tipo_atividade', App\Http\Controllers\TipoAtividadeController::class);
    Route::get('/criarAtividade/{ppc_id}', [TipoAtividadeController::class, 'create'])->name('criarAtividade');
    Route::get('/editarAtividade/{atividade_id}', [TipoAtividadeController::class, 'edit'])->name('editarAtividade');
    Route::put('/atualizarAtividade/{atividade_id}', [TipoAtividadeController::class, 'update'])->name('atualizarAtividade');
    Route::delete('/excluirAtividade/{atividade_id}', [TipoAtividadeController::class, 'destroy'])->name('excluirAtividade');

});
