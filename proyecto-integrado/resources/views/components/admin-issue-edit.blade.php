@extends('layouts.masterAdmin')
@section('title','Inicio')
@section('content')
<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <h1 img class="d-inline text-success">Incidencia: {{ $issue->id }}</h1>
        </x-slot>
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="/incidencia/editar/{{$issue->id}}">
            @csrf
            <input type="hidden" name="_method" value="PUT">
            <!-- Name -->
            <div>
                <x-label for="title" :value="__('Título')" />

                <x-input id="title" class="block mt-1 w-full" type="text" name="title" value="{{ $issue->title }}" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="description" :value="__('Descripción')" />

                <x-input id="description" class="block mt-1 w-full" type="text" name="description" value="{{ $issue->description }}" required />
            </div>

            <div class="mt-4">
                <x-label for="classroom" :value="__('Clase')" />

                <select id="classroom" name="classroom">
                @foreach ($class as $classElement)
                    <option {{ ($issue->classroom == $classElement->id ? "selected":"") }} value="{{ $classElement->id }}">{{ $classElement->class }}</option>
                @endforeach
                </select>
            </div>

            <div class="mt-4">
                <x-label for="condition" :value="__('Estado')" />
                <select id="condition" name="id_condition">
                    @foreach ($conditions as $condition)
                    <option {{ ($issue->id_condition == $condition->id ? "selected":"") }} value="{{ $condition->id }}">{{ $condition->condition }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-4">
                    {{ __('Editar Incidencia') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
@endsection