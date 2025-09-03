<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        if(Auth::user()->tipo_usuario == 1){
          $user = Auth::user();

          // Carrega as submissoes com o id do aluno logado
          $submissoes = \App\Models\Submissao::where('aluno_id', $user->id)->get();

          // Informações para o gráfico da Dashboard
          $totalHorasConcluidas = $submissoes->sum('soma_horas');
          $anoIngresso = $user->ano_ingresso;
          // Busca o ppc referente ao ano de ingresso do aluno
          $ppc = \App\Models\Ppc::where('ano', $anoIngresso)->first();
          $limiteHoras = $ppc ? $ppc->limite_horas : 0;

          return view('dashboardAluno', compact('submissoes', 'totalHorasConcluidas', 'limiteHoras'));
        }
        else if(Auth::user()->tipo_usuario == 2){
          // Manda todas as submissões existentes para a view
          $submissoes = \App\Models\Submissao::all();
          return view('dashboardAvaliador', compact('submissoes'));
        }
        else{
          // Carrega os PPCs
          $ppcs = \App\Models\Ppc::all();
          return view('dashboardAdmin', compact('ppcs'));
        }
    }
}
