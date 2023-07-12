@extends('series.base')

@section('title', 'GNSAPK')
@section('content')
<div>
<div class="container">
<h1 style="margin-bottom: 30px">Afficher un article</h1>
          
    <div class="row justify-content-md-center">
    
        <div class="col">
<form action="" method="post" class="form-inline">
    @csrf

    
    <button class="btn btn-primary" style="margin-right: 25px"> Afficher </button>

    <div>
        <label for="plan" style="color: rgb(38, 73, 190);font-weight: bold;">Plan</label>

            <select name="plan" id="plan" style="margin-right: 15px">
                @foreach($plans as $p)
                    <option value="{{ $p->id }}">{{ $p->code }}</option>
                @endforeach
            </select>

    </div>

    
    <div>
    @error("code")
        {{$message}}
    @enderror
    <label for="code" style="color: rgb(38, 73, 190);font-weight: bold;" >Code_article</label>    
    <input type="text" name="code" value="{{ old('code','stylo-x')}} " style="margin-right: 15px">
    </div>
    <div>
        <label for="date" style="color: rgb(38, 73, 190);font-weight: bold;">Date</label>
            <input type="date" name="date" id="date" style="margin-right: 30px">

    </div>
    
    {{-- <div>
        @error("designation")<button type="button" data-toggle="modal" data-target="#infos" class="btn btn-secondary">Commande</button>
<div class="modal" id="infos">
  <div class="modal-dialog">
    <div class="modal-content">
      Contenu de la fenêtre modale
    </div>
  </div>
</div>
        {{$message}}
    @enderror          
    <label for="designation" style="color: rgb(38, 73, 190);font-weight: bold;">Désignation</label>    
        <input type="text" name="designation" value="{{ old('designation','stylo')}}" style="margin-right: 15px">
    </div> --}}
    
</form>
</div>
    </div>

</div>


    
    
<div class="container">
    
    
     <?php
                if($init==true){
                    ?>

            <div
            class="table-wrapper-scroll-y my-custom-scrollbar" style="overflow-y:scroll;height:400px;"
            >
                
        <table class="table table-bordered table-striped mb-0" style="margin-top: 20px">
        <head style="overflow-y:fixed">
            <tr>
                <th scope="col">Code article</th>
                <th scope="col">Désignation article</th>
                <th class="text-end">Dernier numéro de série</th>
                <th class="text-end">Code plan</th>
                <th class="text-end"></th>
            </tr>
        </head>
        <tbody>
            

                    @foreach ($properties as $property )
                <tr>
                    
                    <td>{{ $property->code}}</td>
                    <td>{{ $property->designation}}</td>
                    <td>{{ $property->lastns}}</td>
                    <td>{{ $property->plan}}</td>
                    <td>
                        <center> 
                            {{-- Bouton déclencheur  --}}
                           
                            <div class="container">

                                <div id="html">
                                  <button data-toggle="modal" data-target="#{{ $property->code }}" class="btn btn-secondary">editer</button>
                                </div>
                                <div class="modal fade" id="{{ $property->code }}">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h4 class="modal-title" style="color: rgb(38, 73, 190);font-weight: bold;">{{ $property->code}}</h4>

                                        <button type="button" class="close" data-dismiss="modal">
                                          <span>&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body row">
                                        <form class="col"  style="font-weight: bold;" action="{{ route('updateA')}}" method="post">
                                            @csrf
                                            
                                          <div class="form-group">
                                            @error("designation")
                                            {{$message}}
                                            @enderror  
                                            <label for="designation" class="form-control-label">Désignation</label>
                                            <input type="text" class="form-control" name="designation" id="designation" value="{{ $property->designation}}" placeholder="">
                                          </div>
                                          <div class="form-group">
                                            @error("lastns")
                                            {{$message}}
                                            @enderror  
                                            <label for="lastns" class="form-control-label">Dernier numéro de série</label>
                                            <input type="text" class="form-control" name="lastns" id="lastns" value="{{$property->lastns}}" placeholder="">
                                          </div>
                                          <div class="form-group">
                                            <label for="plan" style="">Plan</label>
                                    
                                                <select name="plan" id="plan" style="">
                                                    @foreach($plans as $p)
                                                        <option value="{{ $p->id }}">{{ $p->code }}</option>
                                                    @endforeach
                                                </select>
                                    
                                        </div>

                                        <div class="form-group">
                                            <input type="hidden" class="form-control" name="code" id="code" value="{{$property->code}}">                                    
                                        </div>
                                          
                                    
                                          <button type="submit" class="btn btn-primary pull-right">Envoyer</button>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            
                            </div>
                            
                            <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.0/umd/popper.min.js"></script>
                            <script src="js/bootstrap.min.js"></script>
                            {{-- <script>
                              $(function(){
                                $('form').submit(function(e) {
                                  e.preventDefault()
                                  var $form = $(this)
                                  $.post($form.attr('action'), $form.serialize())
                                  .done(function(data) {
                                    $('#html').html(data)
                                    $('#{{ $property->code }}').modal('hide')
                                  })
                                  .fail(function() {
                                    alert('ça ne marche pas...')
                                  })
                                })
                                $('.modal').on('shown.bs.modal', function(){
                                  $('input:first').focus()
                                })
                              })
                            </script> --}}

                    </center>
                    </td>

                </tr>
                
            @endforeach

               
            
        </tbody>
    </table>
</div>

    <?php
    $_SESSION['openA'] = 0;
}
?>
    {{-- {{ $properties->links()}} --}}

    </div>
     

</div>
    

</div>
@endsection