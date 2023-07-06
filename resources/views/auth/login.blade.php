
 {{-- OK --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">    <meta charset="UTF-8">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <style type="text/css">
body{
    margin-top:6%;
    background:#eee;
}
.container {
    margin-right: auto;
    margin-left: auto;
    padding-right: 15px;
    padding-left: 15px;
    width: 100%;
}

@media (min-width: 576px) {
    .container {
        max-width: 540px;
    }
}

@media (min-width: 768px) {
    .container {
        max-width: 720px;
    }
}

@media (min-width: 992px) {
    .container {
        max-width: 960px;
    }
}

@media (min-width: 1200px) {
    .container {
        max-width: 1140px;
    }
}



.card-columns .card {
    margin-bottom: 0.75rem;
}

@media (min-width: 576px) {
    .card-columns {
        column-count: 3;
        column-gap: 1.25rem;
    }
    .card-columns .card {
        display: inline-block;
        width: 100%;
    }
}
.text-muted {
    color: #9faecb !important;
}

p {
    margin-top: 0;
    margin-bottom: 1rem;
}
.mb-3 {
    margin-bottom: 1rem !important;
}
    </style>
    <title>Document</title>

</head>
<body>

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<br>
<br>
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card-group mb-0">
          <div class="card p-4">
            <div class="card-body">
              <h1>Login</h1>
              <p class="text-muted">Connectez vous a votre compte
                <br>
              </p>

                <form action="{{route('auth.login')}}" method="post">
                    @csrf

                    <div class="input-group mb-3">
                        
                        <span class="input-group-addon" style="margin-right: 10px" ><i class="fa fa-user"></i></span>
                        <input type="email" class="form-control" name="email" placeholder="email"  {{-- value="{{ old('email','john@gmail.com')}}" --}} >                       
                    </div>
                    <div class="input-group mb-4">
                        <span class="input-group-addon" style="margin-right: 10px"><i class="fa fa-lock"></i></span>
                        <input type="password" class="form-control" name="password" placeholder="password" {{-- value="{{ old('password','5623')}}"--}}>
                        <div>
                            @error("password")
                            {{$message}}
                            @enderror 
                         </div>
                    </div>
                    <div class="col-sm">
                        @error("email")
                        {{$message}}
                        @enderror                               
                     </div>
                    <div class="row">
                        
                        <div class="col-6">
                            <p>
                                
                            </p>
                           
                            <button class="btn btn-primary active mt-3">Login</button>
                              
         

                    </div>

                </form>

            </div>
            </div>
          </div>


          <div class="card text-white bg-primary py-5 d-md-down-none" style="width:44%">
            <div class="card-body text-center">
              <div>
                <h2>Sign up</h2>
                <p>
                    Créez un compte
                    <br><br><br><br><br> 
                </p>
                <form action="{{route('fregister')}}">
                    <button class="btn btn-primary active mt-3">Register Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
 
</body>
</html>