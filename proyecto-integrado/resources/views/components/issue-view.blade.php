@extends('layouts.master')
@section('title','Inicio')
@section('content')
<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <h1 img class="d-inline text-success">Incidencia de: {{ $issue->userRelation->name }}</h1>
        </x-slot>
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <div class="card-body">
              <h5 class="card-title">{{ $issue->title }}</h5>
              <p class="card-text">{{ $issue->description }}</p>
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item col-12">Clase: {{ $issue->classroomRelation->class }}</li>
              <li class="list-group-item col-12">Estado: {{ $issue->conditionRelation->condition }}</li>
              <li class="list-group-item col-6 d-inline">Creada: {{ $issue->created_at }}</li>
              <li class="list-group-item col-6 d-inline">Creada: {{ $issue->updated_at }}</li>
            </ul>
            <div class="card-body">
              <button type="button" class="btn bg-success text-light col" data-bs-toggle="modal" data-bs-target="#modalComments">
                Ver comentarios
              </button>
              @if (($issue->id_condition != 3) && ($issue->id_condition != 4))
              <button type="button" class="btn bg-primary text-light col" data-bs-toggle="modal" data-bs-target="#modalCreateComment">Añadir comentarios</button>
              @endif
            </div>
    </x-auth-card>
</x-guest-layout>

<div class="modal fade" id="modalCreateComment" tabindex="-1" aria-labelledby="modalCreateCommentLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <form method="POST" action="{{ route('incidencias.storeComment') }}">
              <div class="modal-header">
                  <h5 class="modal-title" id="emodalCreateCommentLabel">Añadir Comentario</h5>
                  <button type="button bg-secundary" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  @csrf
                  <div>
                      <x-input id="issue" class="block mt-1 w-full d-none" type="text" name="issue" value="{{ $issue->id }}" readonly required autofocus/>
                  
                      <x-label for="comment" :value="__('Comentario')" />
      
                      <x-input id="comment" class="block mt-1 w-full" type="text" name="comment" :value="old('comment')" required autofocus />
                  </div>
                  <div class="modal-footer">
                      <button  type="button" class="btn bg-danger text-light" data-bs-dismiss="modal">Cancelar</button>
                      <button class="btn btn-success" data-bs-dismiss="modal">{{ __('Añadir comentario') }}</button>  
                  </div>
              </div>
          </form>
      </div>
  </div>
</div>

<div class="modal fade bd-example-modal-lg" id="modalComments" tabindex="-1" role="dialog" aria-labelledby="modalCommentsLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg bg-light">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="modalCommentsLabel">Comentarios de {{$issue->title}}</h5>
              <button type="button bg-secundary" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
          <button type="button" class="btn bg-secondary text-light" data-bs-dismiss="modal">Cerrar</button>
      </div>
  </div>
</div>
@endsection