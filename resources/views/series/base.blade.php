<?php
    //On démarre une nouvelle session
    //session_start();
    /*On utilise session_id() pour récupérer l'id de session s'il existe.
     *Si l'id de session n'existe  pas, session_id() rnevoie une chaine
     *de caractères vide*/
   // $id_session = session_id();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">    <meta charset="UTF-8">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
</head>
<body>

{{--  nav 1    --}}
  
{{-- <style type="text/css"> 

  </style> --}}
   

{{-- nav --}}


<div class="mx-auto bg-info ">

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon">
            
          </span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div style="margin:auto">
        
            <ul class="navbar-nav mr-auto mt-2 mt-md-0">
                <li class="nav-item">
                    <a href="{{ route('afpost')}}" class="nav-link">
                        Afficher des numéros de séries
                    </a>                
                </li>
                <li class="nav-item">
                    <a href="{{ route('createns')}}" class="nav-link">
                        Générer des numéros de séries
                    </a>                
                </li>
                <li class="nav-item">
                    <a href="{{ route('afaget')}}" class="nav-link">
                        Afficher des articles
                    </a>                
                </li>                  
                <li class="nav-item">
                    <a href="{{ route('createA')}}" class="nav-link">
                        Créer un article
                    </a>
                </li>  
                <li class="nav-item">
                    <a href="{{ route('createP')}}" class="nav-link">
                        Créer un plan
                    </a>
                </li>                  <div class="navbar-nav ns-auto nb-2 nb-lg-0">
                
                    @auth
                       

                        <form class="form-inline my-2 my-lg-0" action="{{route('auth.logout')}}" method="post">
                            @method("delete")
                            @csrf

                            <button class="btn btn-secondary">Déconnexion</button>
                        </form>
                    @endauth
                </div>
            </ul>
                   
        </div>
    </div>
</nav>

</div>
         
   

</div>

    <div class="container mt-5">
        
        @if (session('succes'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert">
                <i class="fa fa-times"></i>
            </button>
            <strong>Success ! Opération réussie </strong> {{ session('success') }}
        </div>
            
        @endif
        @if (session('error'))
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert">
                <i class="fa fa-times"></i>
            </button>
            <strong>Error !</strong> {{ session('error') }}
        </div>
            
        @endif
        
     </div>
     <div class="container mt-5">
        @yield('content')

     </div>
</body>
</html>