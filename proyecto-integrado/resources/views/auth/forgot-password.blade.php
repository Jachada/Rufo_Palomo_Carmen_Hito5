<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <img src="https://codeweek-s3.s3.amazonaws.com/event_picture/logo_iespoligonosur_aggnet_24ae5691-fd1d-439f-a6cf-38ba50a9f960.png" alt="" width="100px">
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Contraseña olvidada? Sin problema. Dinos tu email y te enviaremos un link para reiniciar tu contraseña y puedas asignar una nueva.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Restaurar contraseña') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
