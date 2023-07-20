@extends('series.base')
@section('title', 'GNSAPK')
@section('content')


<div >

    <div class= "container">
        <div class="">
            <h1 style="margin-bottom: 30px">Génerer des numéros de série</h1>
        </div>
    
        
        <div class="row justify-content-md-center">
    
            <div class="col">
                <form action="" method="post" class="form-inline">
                    @csrf

                    <button class="btn btn-primary my-2 my-sm-0" type="submit" style="margin-right: 15px">Génerer</button>  
                   
                    <div>
                        <label for="article" style="color: rgb(38, 73, 190);font-weight: bold;">Code_article</label>
                            <input type="text" name="article"  id="article"  style="margin-right: 30px" autocomplete="off">
                    </div>

                    <script>
                        $(document).ready(function() {
                        $( "#article" ).autocomplete({
                      
                            source: function(request, response) {
                                $.ajax({
                                headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                            },
                                url: "{{ route('getArticles')}}",
                                dataType: "json",
                                async: true,
                                data: {
                                    term : request.term
                                    //term : 'envoie'
                                 },
                                 method:"POST",
                                success: function(data){
                                    response(data);
                                //console.log(data);
                                },
                                error: function (data, textStatus, errorThrown) {
                            console.log(data);
                    
                        },
                            });
                        },
                    
                        select: function(event,ui){
                            $('#article').val(ui.item.label);
                                    return false;
                                },
                        minLength: 1
                     });
                    })
                    </script> 
                    {{-- <div>
                        <label for="plan" style="color: rgb(38, 73, 190);font-weight: bold;" style="margin-right: 15px">Plan</label>
                
                            <select name="plan" id="plan" style="margin-right: 15px">
                                @foreach($plans as $p)
                                    <option value="{{ $p->code }}">{{ $p->code }}</option>
                                @endforeach
                            </select>
                
                    </div> --}}
                    <div>
                    <label for="nombre" style="color: rgb(38, 73, 190);font-weight: bold;" style="margin-right: 15px">Nombre</label>

                    <input type="number" name="nombre" id="" min="1" value="1" style="margin-left: 15px">
                    </div>

                    <div>
                        <label for="plan" style="color: rgb(38, 73, 190);font-weight: bold;">Plan</label>
                            <input type="text" name="plan"  id="plan"  style="margin-right: 30px;margin-left: 30px" autocomplete="off">
                    </div>

                    <script>
                        $(document).ready(function() {
                        $( "#plan" ).autocomplete({
                           source:function(request, response) {
                                $.ajax({
                                headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                            },
                                url: "{{ route('getPlans')}}",
                                dataType: "json",
                                async: true,
                                data: {
                                    term : request.term
                                    //term : 'envoie'
                                 },
                                 method:"POST",
                                success: function(data){
                                    response(data);
                                //console.log(data);
                                },
                                error: function (data, textStatus, errorThrown) {
                            console.log(data);
                    
                        },
                            });
                        },
                    
                        select: function(event,ui){
                            $('#plan').val(ui.item.label);
                                    return false;
                                },
                        minLength: 1
                     });
                    })
                    </script> 




                    @error("nombre")
                        {{$message}}
                    @enderror                  
                    <div>
                        @error("article")
                            {{$message}}
                        @enderror 
                    </div>

                </form>
           
            </div>
    
            <div class="col col-lg-2">
                <div class="row">
                    <form action="{{ route('export')}}" method="post"> 
                        @csrf       
                        <button class="btn btn-outline-success" type="submit">Exporter</button> 
                    </form>
                    {{-- <h6>_</h6>        
                    <form action="{{ route('fimport')}}" method="get" >      
                        @csrf  
                        <button class="btn btn-outline-success" type="submit">Importer</button> 
                    </form>  --}}
    
                </div>
    
            </div>
    
        </div>
    
    
        <div class="container">
            
        </div>
    
    
    
    </div>
    
    <div 
    {{-- class="table-wrapper-scroll-y my-custom-scrollbar" style="overflow-y:scroll;height:400px;" --}}
    >

    <?php

            if($init==true){
                ?>
    
        <table class="table table-bordered table-striped mb-0" style="margin-top: 20px">
        <head style="overflow-y:fixed">
            <tr>
                <th scope="col">Code article</th>
                <th scope="col">Désignation article</th>
                <th scope="col" class="text-end">Numéro série</th>
            </tr>
        </head>
        <tbody>
           
            

                @foreach ($properties as $property )
            <tr>
                
                <td>{{ $property->code}}</td>
                <td>{{ $property->designation}}</td>
                <td>{{ $property->numS}}</td>
            </tr>
            
        @endforeach

           
        </tbody>
    </table>
    <?php
    $_SESSION['openS'] = 0;
}
?>
    {{-- {{ $properties->links()}} --}}

      </div>

</div>
    

</div>



@endsection