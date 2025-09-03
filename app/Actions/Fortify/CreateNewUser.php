<?php

namespace App\Actions\Fortify;

use App\Models\Aluno;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Illuminate\Validation\Rule;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'nome' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'tipo_usuario' => ['required', 'integer', 'in:1,2,3'], // aluno, avaliador, admin
            'ano_ingresso' => [
                 Rule::requiredIf(fn () => $input['tipo_usuario'] == 1),
                    'nullable', 'integer', 'min:2000',
            ],
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $user = User::create([
            'nome' => $input['nome'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'tipo_usuario' => $input['tipo_usuario'],
            'ano_ingresso' => $input['ano_ingresso'] ?? null,
        ]);

        return $user;
    }
}
