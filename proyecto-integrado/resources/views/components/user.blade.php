@extends('layouts.master')
@section('title','Inicio')
@section('content')

<div class="row m-2">
    <div class="card col-3">
        <div class="card-header text-center">
        {{ $user->name }}
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><b>Correo:</b> {{ $user->email }}</li>
            <li class="list-group-item"><b>Fecha:</b> {{ $user->date_birth }}</li>
            <li class="list-group-item"><b>Teléfono:</b> {{ $user->telephone }}</li>
            @if ($user->warning == 1)
                <li class="list-group-item"><b>SI</b> avisar por correo de las modificaciones y de los comentarios nuevos de las incidencias</li>
            @else
                <li class="list-group-item"><b>NO</b> avisar por correo de las modificaciones y de los comentarios nuevos de las incidencias</li>
            @endif
        </ul>
        <button type="button" class="btn btn-primary col-12" data-bs-toggle="modal" data-bs-target="#modalEditUser">Modificar usuario</button>
    </div>

    <div class="modal fade" id="modalEditUser" tabindex="-1" aria-labelledby="modalEditUserLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="/perfil">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEditUserLabel">Editar usuario</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div>
                            <div class="row">
                                <div class="col-1"></div>
                                <x-label class="col-4" for="name" :value="__('Nombre')" />
                
                                <x-input id="name" class="block mt-1 w-full col-6" type="text" name="name" value="{{ $user->name }}" required autofocus />
                            </div>

                            <div class="mt-4 row">
                                <div class="col-1"></div>
                                <x-label class="col-4" for="password" :value="__('Contraseña')" />
                
                                <x-input id="password" class="block mt-1 w-full col-6" type="password" name="password"/>
                            </div> 
                
                            <div class="mt-4 row">
                                <div class="col-1"></div>
                                <x-label class="col-4" for="email" :value="__('Email')" />
                
                                <x-input id="email" class="block mt-1 w-full col-6" type="email" name="email" value="{{ $user->email }}" required />
                            </div>
                
                            <div class="mt-4 row">
                                <div class="col-1"></div>
                                <x-label class="col-4" for="date_birth" :value="__('Fecha nacimiento')" />
                
                                <x-input id="date_birth" class="block mt-1 w-full col-6" type="date" name="date_birth" value="{{ $user->date_birth }}" required />
                            </div>
                
                            <div class="mt-4 row">
                                <div class="col-1"></div>
                                <x-label class="col-4" for="telephone" :value="__('Teléfono')" />
                
                                <x-input id="telephone" class="block mt-1 w-full col-6" type="number" name="telephone" value="{{ $user->telephone }}" required />
                            </div>

                            <div class="row mt-4">
                                <div class="col-1"></div>
                                <x-label class="col-4" for="warning" :value="__('Aviso de incidencia')" />

                                <select id="warning" name="warning" class="col-6">
                                    <option {{ ($user->warning == 1 ? "selected":"") }} value="1">Si quiero recibir emails</option>
                                    <option {{ ($user->warning == 0 ? "selected":"") }} value="0">No quiero recibir emails</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer mt-4">
                            <button  type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                            <button class="btn btn-success" data-bs-dismiss="modal">{{ __('Editar usuario') }}</button>  
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-9">
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
                    <th scope="col-3">Descripcion</th>
                    <th scope="col">Aula</th>
                    <th scope="col">Creada</th>
                    <th scope="col">Actualizada</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Comentarios</th>
                    <th scope="col-1"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($issues as $issue)
                <tr>
                    <td>{{ $issue->title }}</td>
                    <td>{{ $issue->description }}</td>
                    <td>{{ $issue->classroomRelation->class }}</td>
                    <td>{{ $issue->created_at }}</td>
                    <td>{{ $issue->updated_at }}</td>
                    <td>
                        @switch(true)
                            @case($issue->id_condition == 1)
                            <button type="button" class="btn btn-primary col-12" data-bs-toggle="modal" data-bs-target="#modalCondition{{$issue->id}}">
                                @break
                            @case($issue->id_condition == 2)
                            <button type="button" class="btn btn-success col-12" data-bs-toggle="modal" data-bs-target="#modalCondition{{$issue->id}}">
                                @break
                            @case($issue->id_condition == 4)
                            <button type="button" class="btn btn-warning col-12">
                                @break
                            @default
                            <button type="button" class="btn btn-danger col-12">
                        @endswitch
                                {{ $issue->conditionRelation->condition }}
                            </button>
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-success col-5" data-bs-toggle="modal" data-bs-target="#modalComments{{$issue->id}}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                            </svg>
                        </button>
                        @if (($issue->id_condition != 3) && ($issue->id_condition != 4))
                        <button type="button" class="btn btn-primary col-5" data-bs-toggle="modal" data-bs-target="#modalCreateComment{{$issue->id}}">+</button>
                        @endif
                    </td>
                </tr>

                <div class="modal fade" id="modalCondition{{$issue->id}}" tabindex="-1" aria-labelledby="modalCondition{{$issue->id}}Label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="POST" action="{{ route('incidencias.updateCondition') }}">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="emodalCondition{{$issue->id}}Label">Proponer cierre de "{{$issue->title}}"</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    @csrf
                                    <div>
                                        <input type="hidden" name="_method" value="PUT">

                                        <x-input id="issue" class="block mt-1 w-full d-none" type="text" name="issue" value="{{ $issue->id }}" readonly required autofocus/>
                                    
                                        <x-input id="condition" class="block mt-1 w-full d-none" type="text" name="id_condition" value="4" readonly required autofocus/>

                                        <x-label :value="__('¿Estas seguro que deséas cerrar la incidencia?')" />
                                        <x-label :value="__('Después no podrás volver atras')" />

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

                <div class="modal fade" id="modalCreateComment{{$issue->id}}" tabindex="-1" aria-labelledby="modalCreateComment{{$issue->id}}Label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="POST" action="{{ route('incidencias.storeComment') }}">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="emodalCreateComment{{$issue->id}}Label">Añadir Comentario</h5>
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
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
