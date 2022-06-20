@extends('layouts.masterAdmin')
@section('title','Inicio')
@section('content')
<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <h1 img class="d-inline text-success">Usuario: {{ $user->name }}</h1>
        </x-slot>
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('usuarios.admin') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Nombre')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $user->name }}" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="text" name="email" value="{{ $user->email }}" required />
            </div>

            <div class="mt-4">
                <x-label for="date_birth" :value="__('Fecha nacimiento')" />

                <x-input id="date_birth" class="block mt-1 w-full" type="date" name="date_birth" value="{{ $user->date_birth }}" required />
            </div>

            <div class="mt-4">
                <x-label for="telephone" :value="__('Teléfono')" />

                <x-input id="telephone" class="block mt-1 w-full" type="number" name="telephone" value="{{ $user->telephone }}" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-4">
                    {{ __('Editar Usuario') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
@endsection
