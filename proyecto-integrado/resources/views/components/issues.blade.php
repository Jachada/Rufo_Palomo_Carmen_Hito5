@extends('layouts.master')
@section('title','Inicio')
@section('content')

<div class="p-2 bg-success bg-opacity-25 m-2">
    <h2>Listado de incidencias</h2>
    <form class="d-flex">
        <input class="form-control me-4" name="queryString" type="search" placeholder="Buscar por título o descripción" aria-label="Search">
        
        <x-label class="d-flex align-items-center me-2" for="classroom" :value="__('Aula:')" />
        <select class="me-4" id="classroom" name="classroom">
            <option selected value=""></option>
            @foreach ($class as $classElement)
                <option value="{{ $classElement->id }}">{{ $classElement->class }}</option>
            @endforeach
        </select>

        <x-label class="d-flex align-items-center me-2" for="condition" :value="__('Estado:')" />
        <select class="me-4" id="condition" name="condition">
            <option selected value=""></option>
            @foreach ($conditions as $condition)
            <option value="{{ $condition->id }}">{{ $condition->condition }}</option>
            @endforeach
        </select>

        <button class="btn btn-outline-success" type="submit">Buscar</button>
    </form>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Titulo</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Aula</th>
                <th scope="col">Autor</th>
                <th scope="col">Creación</th>
                <th scope="col">Estado</th>
                <th scope="col"></th>
            </tr>
        </thead>
        @foreach ($issues as $issue)
        <tr>
            <td>{{ $issue->title }}</td>
            <td>{{ $issue->description }}</td>
            <td>{{ $issue->classroomRelation->class }}</td>
            <td>{{ $issue->userRelation->name }}</td>
            <td>{{ $issue->created_at }}</td>
            <td>{{ $issue->conditionRelation->condition }}</td>
            <td class="text-center">
                <a href="/incidencia/ver/{{$issue->id}}">
                <button type="button" class="btn btn-success col">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                        <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                    </svg>
                </button>
                </a>
            </td>
        </tr>
        @endforeach
    </table>
</div>

@endsection