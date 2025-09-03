<?php

namespace App\Http\Controllers;

use App\Models\TipoAtividade;
use Illuminate\Http\Request;

class TipoAtividadeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($atividade_id)
    {
        return view('tipo_atividade/editarAtividade', compact('atividade_id'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($ppc_id)
    {
        return view('tipo_atividade/criarAtividade', compact('ppc_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'atividade' => 'required|string|max:255',
            'limite_horas' => 'required|string|max:255',
            'ppc_id' => 'required|exists:ppcs,id', 
        ]);

        TipoAtividade::create([
            'atividade' => $request->atividade,
            'limite_horas' => $request->limite_horas,
            'ppc_id' => $request->ppc_id, 
        ]);

        return redirect()->route('editarPpc', ['ppc_id' => $request->ppc_id])->with('success', 'Atividade cadastrada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($atividade_id)
    {
        $atividade = \App\Models\TipoAtividade::findOrFail($atividade_id);
        $ppc_id = $atividade->ppc_id; 
        return view('tipo_atividade/editarAtividade', compact('atividade', 'ppc_id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $atividade_id)
    {
        $request->validate([
            'atividade' => 'required|string|max:255',
            'limite_horas' => 'required|string|max:255',
            'ppc_id' => 'required|exists:ppcs,id',
        ]);

        $atividade = \App\Models\TipoAtividade::findOrFail($atividade_id);
        $atividade->update([
            'atividade' => $request->atividade,
            'limite_horas' => $request->limite_horas,
            'ppc_id' => $request->ppc_id,
        ]);

        return redirect()->route('editarPpc', $request->ppc_id)
            ->with('success', 'Atividade atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($atividade_id)
    {
        $atividade = TipoAtividade::findOrFail($atividade_id);
        $ppc_id = $atividade->ppc_id;
        $atividade->delete();

        return redirect()->route('editarPpc', $ppc_id)
            ->with('success', 'Atividade excluída com sucesso!');
    }
}
