@extends('layouts.master')
@section('title','Inicio')
@section('content')

<div class="justify-content-center m-2 border border-dark">
    <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="5000">
                <img src="https://blog.comparasoftware.com/wp-content/uploads/2020/07/gestion-de-incidencias.png" height="600px" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block text-light">
                    <h3 class="text-dark">Bienvenidos</h3>
                    <p class="text-dark">Página de incidencias del IES Polígono Sur</p>
                </div>
            </div>
            <div class="carousel-item" data-bs-interval="2000">
                <img src="https://iespoligonosur.org/www/wp-content/uploads/2014/05/biblio1.png" height="600px" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block text-light">
                    <h5>Los estudios primero</h5>
                </div>
            </div>
            <div class="carousel-item" data-bs-interval="2000">
                <img src="https://pbs.twimg.com/media/EPhfyukW4AE38aS.jpg" height="600px" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block text-light">
                    <h5>Luego a divertirse</h5>
                </div>
            </div>
            
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
@endsection