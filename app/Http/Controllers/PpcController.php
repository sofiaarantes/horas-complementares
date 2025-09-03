<?php

namespace App\Http\Controllers;

use App\Models\Ppc;
use Illuminate\Http\Request;

class PpcController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ppcs = PPC::all();
        return view('dashboard', compact('ppcs'));
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
        $request->validate([
            'ano' => 'required|integer',
            'limite_horas' => 'required|integer',
        ]);

        PPC::create([
            'ano' => $request->ano,
            'limite_horas' => $request->limite_horas,
        ]);

        return redirect()->route('dashboard')->with('success', 'PPC cadastrado com sucesso!');
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
    public function edit($ppc_id)
    {
        $ppc = \App\Models\Ppc::findOrFail($ppc_id);
        // Busca todas as atividades vinculadas ao PPC informado por url
        $atividades = \App\Models\TipoAtividade::where('ppc_id', $ppc_id)->get();

        return view('ppc/editarPpc', compact('ppc', 'atividades', 'ppc_id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $ppc_id)
    {
        $request->validate([
            'ano' => 'required|integer',
            'limite_horas' => 'required|integer',
        ]);

        $ppc = \App\Models\Ppc::findOrFail($ppc_id);
        $ppc->update([
            'ano' => $request->ano,
            'limite_horas' => $request->limite_horas,
        ]);

        return redirect()->route('editarPpc', $ppc_id)
            ->with('success', 'Atividade atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($ppc_id)
    {
        $ppc = Ppc::findOrFail($ppc_id);
        \App\Models\TipoAtividade::where('ppc_id', $ppc_id)->delete();
        $ppc->delete();

        return redirect()->route('dashboard')
            ->with('success', 'Ppc excluído com sucesso!');
    }

    public function duplicar($ppc_id)
    {
        //Busca o id do ppc "escolhido" na view
        $ppc = \App\Models\Ppc::findOrFail($ppc_id);

        $novo_ppc = $ppc->replicate();
        $novo_ppc->save();

        // Busca atividades vinculadas ao PPC original
        $atividades = \App\Models\TipoAtividade::where('ppc_id', $ppc_id)->get();

        // Duplica cada atividade para o novo PPC
        foreach ($atividades as $atividade) {
            $nova_atividade = $atividade->replicate();
            $nova_atividade->ppc_id = $novo_ppc->id;
            $nova_atividade->save();
        }

        return redirect()->route('dashboard')->with('success', 'PPC duplicado com sucesso!');
    }

}
