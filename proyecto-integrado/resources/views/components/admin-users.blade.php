@extends('layouts.masterAdmin')
@section('title','Usuarios')
@section('content')

<div class="p-2 bg-success bg-opacity-25 m-2">
    <h2>Listado de TODOS los usuarios</h2>
    <form class="d-flex">
        <input class="form-control me-4" name="queryString" type="search" placeholder="Buscar por nombre" aria-label="Search">
        
        <input class="form-control me-4" name="telephoneEmail" type="search" placeholder="Buscar por email o telefono" aria-label="Search">

        <x-label class="d-flex align-items-center me-2" for="warning" :value="__('Avisos:')" />
        <select class="me-4" id="warning" name="warning">
            <option selected value=""></option>
            <option value="1">Si</option>
            <option value="0">No</option>
        </select>

        <x-label class="d-flex align-items-center me-2" for="state" :value="__('Estado:')" />
        <select class="me-4" id="state" name="state">
            <option selected value=""></option>
            @foreach ($states as $state)
            <option value="{{ $state->id }}">{{ $state->state }}</option>
            @endforeach
        </select>

        <button class="btn btn-outline-success" type="submit">Buscar</button>
    </form>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Email</th>
                <th class="text-center" scope="col">Fecha Nacimiento</th>
                <th class="text-center" scope="col">Teléfono</th>
                <th class="text-center" scope="col">Avisos</th>
                <th class="text-center" scope="col">Estado</th>
                <th scope="col"></th>
            </tr>
        </thead>
        @foreach ($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td class="text-center">{{ $user->date_birth }}</td>
            <td class="text-center">{{ $user->telephone }}</td>
            <td class="text-center">{{ ($user->warning == 1 ? "Si" : "No") }}</td>
            <td class="text-center">
                @switch(true)
                    @case($user->id_state == 1)
                    <button type="button" class="btn btn-warning col-12" data-bs-toggle="modal" data-bs-target="#modalState{{$user->id}}">
                        @break
                    @case($user->id_state == 2)
                    <button type="button" class="btn btn-success col-12" data-bs-toggle="modal" data-bs-target="#modalState{{$user->id}}">
                        @break
                    @default
                    <button type="button" class="btn btn-danger col-12" data-bs-toggle="modal" data-bs-target="#modalState{{$user->id}}">
                        @endswitch
                        {{ $user->statesRelation->state }}
                    </button>
            </td>
            <td class="text-center">
                <a href="usuario/editar/{{ $user->id }}">
                    <button type="button" class="btn btn-success col">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                        </svg>
                    </button>
                </a>
            </td>
        </tr>

        <div class="modal fade" id="modalState{{$user->id}}" tabindex="-1" aria-labelledby="modalState{{$user->id}}Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" action="{{ route('usuarios.updateState') }}">
                        <div class="modal-header">
                            <h5 class="modal-title" id="emodalState{{$user->id}}Label">Cambiar estado de {{$user->name}}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            @csrf
                            <div>
                                <input type="hidden" name="_method" value="PUT">

                                <x-input id="user" class="block mt-1 w-full d-none" type="text" name="user" value="{{ $user->id }}" readonly required autofocus/>

                                <x-label for="state" :value="__('Estado')" />
                                <select id="state" name="id_state">
                                    @foreach ($states as $state)
                                    <option {{ ($user->id_state == $state->id ? "selected":"") }} value="{{ $state->id }}">{{ $state->state }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button  type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                <button class="btn btn-success" data-bs-dismiss="modal">{{ __('Cambiar estado') }}</button>  
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </table>
</div>

@endsection
