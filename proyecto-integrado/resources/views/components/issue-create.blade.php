@extends('layouts.master')
@section('title','Inicio')
@section('content')
<x-guest-layout class="p-0 m-0">
    <x-auth-card>
        <x-slot name="logo">
            <h1 img class="d-inline text-success">Nueva Incidencia</h1>
        </x-slot>
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('incidencias.store') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="title" :value="__('Título')" />

                <x-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="description" :value="__('Descripción')" />

                <x-input id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description')" required />
            </div>

            <div class="mt-4">
                <x-label for="classroom" :value="__('Clase')" />

                <select id="classroom" name="classroom">
                @foreach ($class as $classElement)
                    <option value="{{ $classElement->id }}">{{ $classElement->class }}</option>
                @endforeach
                </select>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-4">
                    {{ __('Crear Incidencia') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
@endsection