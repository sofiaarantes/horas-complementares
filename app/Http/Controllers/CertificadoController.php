<?php

namespace App\Http\Controllers;

use App\Models\Certificado;
use App\Models\Ppc;
use App\Models\TipoAtividade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CertificadoController extends Controller
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
    public function create($submissao_id)
    {
        $user = Auth::user();
        $ano_ingresso = $user->ano_ingresso;

        // Busca o PPC do ano de ingresso do usuário
        $ppc = Ppc::where('ano', $ano_ingresso)->first();

        // Busca as atividades desse PPC (ou array vazio se não achar PPC)
        $atividades = $ppc ? TipoAtividade::where('ppc_id', $ppc->id)->get() : collect();

        return view('certificado/criarCertificado', compact('submissao_id', 'atividades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,pdf|max:4096',
            'titulo' => 'required|string|max:255',
            'total_horas' => 'required|numeric|min:0',
            'tipo_atividade_id' => 'required|exists:tipo_atividades,id', 
            'submissao_id' => 'required|exists:submissao,id', 
        ]);

        // Salva o arquivo da imagem do certificado na pasta storage/app/public/certificados
        $imgPath = $request->file('img')->store('certificados', 'public');

        Certificado::create([
            'img' => $imgPath,
            'titulo' => $request->titulo,
            'total_horas' => $request->total_horas,
            'tipo_atividade_id' => $request->tipo_atividade_id,
            'submissao_id' => $request->submissao_id,
        ]);

        return redirect()->route('editarSubmissao', ['submissao_id' => $request->submissao_id])->with('success', 'Certificado cadastrado com sucesso!');
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
    public function edit($certificado_id)
    {
        // Busca os dados do certificado escolhido
        $certificado = \App\Models\Certificado::findOrFail($certificado_id);
        // Salva o id da Submissao pro usário voltar pra tela de EditarSubmissao
        $submissao_id = $certificado->submissao_id; 

        // Busca as atividades para editar tipo_atividade_id
        $user = Auth::user();
        $ano_ingresso = $user->ano_ingresso;
        // Busca o PPC do ano de ingresso do usuário
        $ppc = Ppc::where('ano', $ano_ingresso)->first();
        // Busca as atividades desse PPC (ou array vazio se não achar PPC)
        $atividades = $ppc ? TipoAtividade::where('ppc_id', $ppc->id)->get() : collect();

        return view('certificado/editarCertificado', compact('certificado', 'submissao_id', 'atividades'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $certificado_id)
    {
        $request->validate([
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,pdf|max:4096',
            'titulo' => 'required|string|max:255',
            'total_horas' => 'required|numeric|min:0',
            'tipo_atividade_id' => 'required|exists:tipo_atividades,id', 
            'submissao_id' => 'required|exists:submissao,id', 
        ]);

        $certificado = \App\Models\Certificado::findOrFail($certificado_id);

        $data = [
            'titulo' => $request->titulo,
            'total_horas' => $request->total_horas,
            'tipo_atividade_id' => $request->tipo_atividade_id,
            'submissao_id' => $request->submissao_id,
        ];

        // Só atualiza a imagem se houver upload novo
        if ($request->hasFile('img')) {
            $imgPath = $request->file('img')->store('certificados', 'public');
            $data['img'] = $imgPath;
        }

        $certificado->update($data);

        return redirect()->route('editarSubmissao', ['submissao_id' => $request->submissao_id])
            ->with('success', 'Certificado atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($certificado_id)
    {
        $certificado = Certificado::findOrFail($certificado_id);
        $submissao_id = $certificado->submissao_id;
        $certificado->delete();

        return redirect()->route('editarSubmissao', $submissao_id)
            ->with('success', 'Certificado excluído com sucesso!');
    }
}
