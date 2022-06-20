@extends('layouts.masterAdmin')
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
                <th class="text-center" scope="col">Aula</th>
                <th class="text-center" scope="col">Autor</th>
                <th class="text-center" scope="col">Comentarios</th>
                <th class="text-center" scope="col">Creado</th>
                <th class="text-center" scope="col">Modificado</th>
                <th class="text-center" scope="col">Estado</th>
                <th scope="col"></th>
            </tr>
        </thead>
        @foreach ($issues as $issue)
        <tr >
            <td>{{ $issue->title }}</td>
            <td>{{ $issue->description }}</td>
            <td class="text-center">{{ $issue->classroomRelation->class }}</td>
            <td class="text-center">{{ $issue->userRelation->name }}</td>
            <td class="text-center">
                <button type="button" class="btn btn-success col-5" data-bs-toggle="modal" data-bs-target="#modalComments{{$issue->id}}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                        <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                    </svg>
                </button>
                <button type="button" class="btn btn-primary col-5" data-bs-toggle="modal" data-bs-target="#modalCreateComment{{$issue->id}}">+</button>
            </td>
            <td class="text-center">{{ $issue->created_at }}</td>
            <td class="text-center">{{ $issue->updated_at }}</td>
            <td>
                @switch(true)
                    @case($issue->id_condition == 1)
                    <button type="button" class="btn btn-danger col-12" data-bs-toggle="modal" data-bs-target="#modalCondition{{$issue->id}}">
                        @break
                    @case($issue->id_condition == 2)
                    <button type="button" class="btn btn-warning col-12" data-bs-toggle="modal" data-bs-target="#modalCondition{{$issue->id}}">
                        @break
                    @case($issue->id_condition == 4)
                    <button type="button" class="btn btn-secondary col-12">
                        @break
                    @default
                    <button type="button" class="btn btn-success col-12">
                @endswitch
                        {{ $issue->conditionRelation->condition }}
                    </button>
            </td>
            <td>
                <a href="incidencia/editar/{{ $issue->id }}">
                    <button type="button" class="btn btn-success col">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                        </svg>
                    </button>
                </a>
            </td>
        </tr>

        <div class="modal fade" id="modalCreateComment{{$issue->id}}" tabindex="-1" aria-labelledby="modalCreateComment{{$issue->id}}Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" action="{{ route('incidencias.storeComment') }}">
                        <div class="modal-header">
                            <h5 class="modal-title" id="emodalCreateComment{{$issue->id}}Label">Añadir Comentario a {{$issue->title}}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            @csrf
                            <div>
                                <x-input id="issue" class="block mt-1 w-full d-none" type="text" name="issue" value="{{ $issue->id }}" readonly required autofocus/>
                            
                                <x-label for="comment" :value="__('Comentario')" />
                
                                <x-input id="comment" class="block mt-1 w-full" type="text" name="comment" :value="old('comment')" required autofocus />
                            </div>
                            <div class="modal-footer">
                                <button  type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                <button class="btn btn-success" data-bs-dismiss="modal">{{ __('Añadir comentario') }}</button>  
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade bd-example-modal-lg" id="modalComments{{$issue->id}}" tabindex="-1" role="dialog" aria-labelledby="modalComments{{$issue->id}}Label" aria-hidden="true">
            <div class="modal-dialog modal-lg bg-light">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalComments{{$issue->id}}Label">Comentarios de {{$issue->title}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <p class="col"><strong>Fecha</strong></p>
                        <p class="col"><strong>Comentario</strong></p>
                        <p class="col"><strong>Autor</strong></p>
                    </div>
                    @foreach ($issue->comments as $comment)
                    <hr/>
                    <div class="row">
                        <p class="col">{{$comment->created_at}}</p>
                        <p class="col">{{$comment->comment}}</p>
                        <p class="col">{{$comment->userRelation->name}}</p>
                    </div>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalCondition{{$issue->id}}" tabindex="-1" aria-labelledby="modalCondition{{$issue->id}}Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" action="{{ route('incidencias.updateCondition') }}">
                        <div class="modal-header">
                            <h5 class="modal-title" id="emodalCondition{{$issue->id}}Label">Cambiar estado de "{{$issue->title}}"</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            @csrf
                            <div>
                                <input type="hidden" name="_method" value="PUT">

                                <x-input id="issue" class="block mt-1 w-full d-none" type="text" name="issue" value="{{ $issue->id }}" readonly required autofocus/>

                                <x-label for="condition" :value="__('Estado')" />
                                <select id="condition" name="id_condition">
                                    @foreach ($conditions as $condition)
                                    <option {{ ($issue->id_condition == $condition->id ? "selected":"") }} value="{{ $condition->id }}">{{ $condition->condition }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button  type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                <button class="btn btn-success" data-bs-dismiss="modal">{{ __('Proponer cierre') }}</button>  
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