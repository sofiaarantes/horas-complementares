<?php

namespace App\Http\Controllers;

use App\Models\Submissao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubmissaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $submissao = Submissao::create([
            'data_submissao' => now(),
            'status' => 'pendente',
            'data_avaliacao' => null,
            'soma_horas' => 0,
            'aluno_id' => Auth::id(),
            'avaliador_id' => null,
        ]);

        return redirect()->route('editarSubmissao', $submissao->id)->with('success', 'Submissão cadastrada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show($submissao_id)
    {
        $submissao = Submissao::with('certificados')->findOrFail($submissao_id);
        // Busca todos os certificados vinculados a submissao informada por url
        $certificados = $submissao->certificados;

        return view('submissao/avaliarSubmissao', compact('certificados', 'submissao_id'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($submissao_id)
    {
        $submissao = Submissao::with('certificados')->findOrFail($submissao_id);
        $submissao->status = 'pendente';
        $submissao->updated_at = now();
        $submissao->save();

        // Busca todos os certificados vinculados a submissao informada por url
        $certificados = $submissao->certificados;

        return view('submissao/editarSubmissao', compact('certificados', 'submissao_id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($submissao_id)
    {
        $submissao = Submissao::findOrFail($submissao_id);
        $submissao->delete();

        return redirect()->route('dashboard')
            ->with('success', 'Submissão excluída com sucesso!');
    }

    public function rejeitar($submissao_id)
    {
        $submissao = Submissao::findOrFail($submissao_id);
        $submissao->status = 'rejeitado'; 
        $submissao->avaliador_id = Auth::id();
        $submissao->save();

        return redirect()->route('dashboard')->with('success', 'Submissão rejeitada!');
    }

    public function aprovarForm($submissao_id)
    {
        return view('submissao/aprovarSubmissao', compact('submissao_id'));
    }

    public function aprovar(Request $request, $submissao_id)
    {
        $request->validate([
            'soma_horas' => 'required|integer|min:0'
        ]);

        $submissao = Submissao::findOrFail($submissao_id);
        $submissao->status = 'aprovado';
        $submissao->soma_horas = $request->soma_horas;
        $submissao->avaliador_id = Auth::id();
        $submissao->data_avaliacao = now();
        $submissao->save();

        return redirect()->route('dashboard')->with('success', 'Submissão aprovada!');
    }

    public function submissoesAvaliadas($avaliador_id)
    {
        // Busca as submissões já avaliadas pelo id do avaliador enviado pela rota
        $submissoes = \App\Models\Submissao::with('certificados')
            ->where('avaliador_id', $avaliador_id)
            ->whereIn('status', ['aprovado', 'rejeitado'])
            ->get();

        return view('submissao/verSubmissoes', compact('submissoes'));
    }

    public function submissoesEnviadas($aluno_id)
    {
        // Busca as submissões do aluno enviado pela rota
        $submissoes = \App\Models\Submissao::with('certificados')
            ->where('aluno_id', $aluno_id)
            ->get();

        return view('submissao/verSubmissoesAluno', compact('submissoes'));
    }
}
