<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="../../css/master.css">
  <title>@yield('title')</title>

</head>

<body class="d-flex flex-column min-vh-100">
  <header>
    <div class="row bg-success text-white" style="padding-left: 10%; padding-right: 10%">
      <div class="col-8">
        <a class="text-white" href="{{ route('login') }}">Acceder</a>
        <p class="d-inline">|</p>

        @if (Route::has('register'))
        <a class="text-white" href="{{ route('register') }}">Registrar</a>
        @endif
      </div>

      <div class="col-4" style='text-align:right'>
        <a href="https://www.instagram.com/iespsur/">
          <img class="d-inline justify-content-end" src="https://www.fundacionmicrofinanzasbbva.org/wp-content/uploads/2017/03/new-instagram-logo-png-transparent.png" alt="" style="width: 22px;">
        </a>
        <a href="https://www.youtube.com/channel/UCC7fReLLhkbP4BMR_hdspYQ">
          <img class="d-inline" src="https://restaurantelaespanola.es/wp-content/uploads/2020/04/YouTube-logo-play-icon1-e1455723974137.png" alt="" style="width: 24px;">
        </a>
        <a href="https://twitter.com/iespsur">
          <img class="d-inline" src="http://assets.stickpng.com/thumbs/580b57fcd9996e24bc43c53e.png" alt="" style="width: 28px;">
        </a>
      </div>
    </div>
    <div class="border" style="padding-left: 10%; padding-right: 10%">
      <p>C/Esclava del Señor 2 · 41013 · Sevilla // info@iespoligonosur.org // 955 622 844</p>
    </div>
    <nav class="navbar navbar-expand-lg" style="padding-left: 10%; padding-right: 10%">
      <div class="container-fluid row">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="col-4">
          <a class="navbar-brand" href="/">
            <img class="d-inline" src="https://codeweek-s3.s3.amazonaws.com/event_picture/logo_iespoligonosur_aggnet_24ae5691-fd1d-439f-a6cf-38ba50a9f960.png" alt="" style="width: 20%;">
            <h1 img class="d-inline text-success">IES Polígono Sur</h1>
          </a>
        </div>
        <div class="collapse navbar-collapse col-8 justify-content-end" id="navbarTogglerDemo03">
          <ul class="navbar-nav mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="/incidencias">Incidencias</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <div style="padding-left: 10%; padding-right: 10%">
    @yield('content')
  </div>

  <footer class="text-white bg-secondary bg-gradient mt-auto" style="padding-top: 1%;">
    <div class="row" style="padding-left: 10%; padding-right: 10%">
      <div class="col-9">
        <img class="d-inline" width="250px" src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/8a/Logotipo_del_Ministerio_de_Educaci%C3%B3n_y_Formaci%C3%B3n_Profesional.svg/2560px-Logotipo_del_Ministerio_de_Educaci%C3%B3n_y_Formaci%C3%B3n_Profesional.svg.png" alt="">
        <img class="d-inline" width="75px" src="http://www.badmintonandalucia.es/wp-content/uploads/2020/08/Logo-CED.jpg" alt="">
        <img class="d-inline" width="75px" src="https://fondosestructurales.castillalamancha.es/sites/fondosestructurales.castillalamancha.es/files/fse_cuatricolor.vertical.jpg" alt="">
        <img class="d-inline" width="100px" src="https://www.gilabertmiro.com/wp-content/uploads/2020/02/aenor-iqnet-juntos-min.jpg" alt="">
      </div>
      <div class="col-3">
        <h5 class="text-uppercase">ESTAMOS EN…</h5>
        <p>C/Esclava del Señor 2 · 41013 · Sevilla</p>
        <p>Telf: +34 955 622 844</p>
        <p>Correo: info@iespoligonosur.org</p>
      </div>
    </div>
    <div class="bg-dark" style="padding-left: 10%; padding-right: 10%">
      ©2022 IES Polígono Sur · Sevilla
    </div>
  </footer>
</body>

</html>