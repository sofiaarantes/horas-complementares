<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AutenticarController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        // Autentica o usuário
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['error' => 'Credenciais inválidas'], 401);
        }

        $user = Auth::user();

        // Só permite alunos
        if ($user->tipo_usuario != 1) {
            return response()->json(['error' => 'Usuário não autorizado'], 403);
        }

        // Cria token de acesso
        $token = $user->createToken('app-token')->plainTextToken;

        // Retorna dados do usuário + token
        return response()->json([
            'user'  => [
                'id' => $user->id,
                'nome' => $user->nome,
                'email' => $user->email,
                'ano_ingresso' => $user->ano_ingresso,
            ],
            'token' => $token
        ]);
    }
}