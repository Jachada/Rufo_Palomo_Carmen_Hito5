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

<body class="bg-success bg-opacity-25">
  <header>
    <div class="row bg-success text-white">
      <div class="col-4">
        <a class="navbar-brand" href="/">
          <img class="d-inline" src="https://codeweek-s3.s3.amazonaws.com/event_picture/logo_iespoligonosur_aggnet_24ae5691-fd1d-439f-a6cf-38ba50a9f960.png" alt="" style="width: 15%;">
          <h1 img class="d-inline text-light">IES Polígono Sur</h1>
        </a>
      </div>
    </div>

    {{-- <div class="container-fluid">
      <div class="row flex-nowrap">
        <div class="col-auto px-2 bg-dark border border-dark">
          <div class="d-flex flex-column align-items-center align-items-sm-start text-white min-vh-100">
            
          </div>
        </div>
      </div>            
    </div> --}}

    
  </header>

  <div class="row pos-f-t">
    <div class="bg-dark min-vh-75 col-auto">
      <nav class="navbar navbar-dark text-center">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </nav>
      <div class="collapse" id="navbarContent">
        <div class="bg-dark p-4">
          <a href="/incidencias">
            <h4 class="text-light">Incidencias</h4>
          </a>
          <a href="/usuarios">
            <h4 class="text-light">Usuarios</h4>
          </a>
        </div>
      </div> 
    </div>
     
    <div class="col">
      @yield('content')
    </div>
  </div>

  <footer class="text-white bg-dark text-center mt-auto" style="padding: 0.5%;">
    <div style="padding-left: 10%; padding-right: 10%">
      ©2022 IES Polígono Sur · Sevilla
    </div>
  </footer>
</body>

</html>