<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form x-data="tipoUsuario()" method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Nome -->
            <div>
                <x-label for="nome" value="{{ __('Nome') }}" />
                <x-input id="nome" class="block mt-1 w-full" type="text" name="nome" :value="old('nome')" required autofocus autocomplete="name" />
            </div>

            <!-- Usuário -->
            <div class="mt-4">
                <x-label for="email" value="{{ __('Usuário') }}" />
                <x-input id="email" class="block mt-1 w-full" type="text" name="email" :value="old('email')" required autocomplete="username" />
            </div>

            <!-- Senha -->
            <div class="mt-4">
                <x-label for="password" value="{{ __('Senha') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirme sua senha') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <!-- Tipo de Usuário -->
            <div class="mt-4">
                <x-label for="tipo_usuario" value="Tipo de Usuário" />
                <select name="tipo_usuario" id="tipo_usuario" class="block mt-1 w-full" x-model="tipo">
                    <option value="">Selecione</option>
                    <option value="1">Aluno</option>
                    <option value="2">Avaliador</option>
                    <option value="3">Admin</option>
                </select>
            </div>

            <!-- Ano de Ingresso (exibido apenas se for aluno) -->
            <div class="mt-4" x-show="tipo === '1'">
                <x-label for="ano_ingresso" value="Ano de Ingresso" />
                <x-input id="ano_ingresso" class="block mt-1 w-full" type="number" name="ano_ingresso" :value="old('ano_ingresso')" />
            </div>

            <!-- Botões -->
            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                   href="{{ route('login') }}">
                    {{ __('Já está registrado?') }}
                </a>

                <x-button class="ms-4">
                    {{ __('Registrar') }}
                </x-button>
            </div>
        </form>

        <!-- Alpine.js para alternar campo do aluno -->
        <script>
            function tipoUsuario() {
                return {
                    tipo: '{{ old('tipo_usuario') }}'
                }
            }
        </script>
    </x-authentication-card>
</x-guest-layout>
