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

                    <form action="{{ route('storens')}}" method="post" class="form-inline">
                        @csrf
        
                        <button class="btn btn-primary my-2 my-sm-0" type="submit" style="margin-right: 15px">Génerer</button>  
        
           
                </div> 
          
    
        </div>
    
    
        <div class="container">
            
        </div>
    
    
    
    </div>

    <div class="container">

        <div
        class="table-wrapper-scroll-y my-custom-scrollbar" style="overflow-y:scroll;height:400px;"
        >
    

    <table class="table table-bordered table-striped mb-0" style="margin-top: 20px">
        <head style="overflow-y:fixed">
            <tr>
                <th scope="col">Code article</th>
                <th scope="col">Nombre</th>
                <th scope="col" class="text-end">Plan</th>
            </tr>
        </head>
        <tbody> 
            {{-- ------------------------Ligne 1--------------------- --}}
            <tr name="Line1"> 
                
                <td>
                    <div>
                    <input type="text" name="article1"  id="article1" placeholder="Article1"  style="margin-right: 30px" autocomplete="off">

                    </div>

                    <script>
                        $(document).ready(function() {
                        $( "#article1" ).autocomplete({
                      
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
                            $('#article1').val(ui.item.label);
                                    return false;
                                },
                        minLength: 1
                     });
                    })
                    </script> 
                </td>
                <td>
                    <div>
                        <input type="number" name="nombre1" id="nombre1" min="1" value="1" style="margin-left: 15px">
                    </div>
                </td>
                <td>
                    <div>
                            <input type="text" name="plan1"  id="plan1"  style="margin-right: 30px;margin-left: 30px" autocomplete="off">
                    </div>

                    <script>
                        $(document).ready(function() {
                        $( "#plan1" ).autocomplete({
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
                            $('#plan1').val(ui.item.label);
                                    return false;
                                },
                        minLength: 1
                     });
                    })
                    </script> 

                    @error("nombre1")
                        {{$message}}
                    @enderror                  
                    <div>
                        @error("article2")
                            {{$message}}
                        @enderror 
                    </div>
                </td>
                            
            </tr> 

            {{-- -----------------------Ligne2----------------------- --}}

            <tr class="line2">
                
                <td>
                    <div>
                     <input type="text" name="article2"  id="article2" placeholder="Article2"  style="margin-right: 30px" autocomplete="off">

                    </div>

                    <script>
                        $(document).ready(function() {
                        $( "#article2" ).autocomplete({
                      
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
                            $('#article2').val(ui.item.label);
                                    return false;
                                },
                        minLength: 1
                     });
                    })
                    </script> 
                </td>
                <td>
                    <div>
                        <input type="number" name="nombre2" id="nombre2" min="1" value="1" style="margin-left: 15px">
                    </div>
                </td>
                <td>
                    <div>
                            <input type="text" name="plan2"  id="plan2"  style="margin-right: 30px;margin-left: 30px" autocomplete="off">
                    </div>

                    <script>
                        $(document).ready(function() {
                        $( "#plan2" ).autocomplete({
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
                            $('#plan2').val(ui.item.label);
                                    return false;
                                },
                        minLength: 1
                     });
                    })
                    </script> 

                    @error("nombre2")
                        {{$message}}
                    @enderror                  
                    <div>
                        @error("article2")
                            {{$message}}
                        @enderror 
                    </div>
                </td>
                            
            </tr> 
            
            {{-- ------------------------Ligne 3--------------------- --}}
            <tr name="Line3"> 
                
                <td>
                    <div>
                     <input type="text" name="article3"  id="article3" placeholder="Article3"  style="margin-right: 30px" autocomplete="off">

                    </div>

                    <script>
                        $(document).ready(function() {
                        $( "#article3" ).autocomplete({
                      
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
                            $('#article3').val(ui.item.label);
                                    return false;
                                },
                        minLength: 1
                     });
                    })
                    </script> 
                </td>
                <td>
                    <div>
                        <input type="number" name="nombre3" id="nombre3" min="1" value="1" style="margin-left: 15px">
                    </div>
                </td>
                <td>
                    <div>
                            <input type="text" name="plan3"  id="plan3"  style="margin-right: 30px;margin-left: 30px" autocomplete="off">
                    </div>

                    <script>
                        $(document).ready(function() {
                        $( "#plan3" ).autocomplete({
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
                            $('#plan3').val(ui.item.label);
                                    return false;
                                },
                        minLength: 1
                     });
                    })
                    </script> 

                    @error("nombre3")
                        {{$message}}
                    @enderror                  
                    <div>
                        @error("article3")
                            {{$message}}
                        @enderror 
                    </div>
                </td>
                            
            </tr> 
            {{-- ------------------------Ligne 4--------------------- --}}
            <tr name="Line4"> 
                
                <td>
                    <div>
                        <input type="text" name="article4"  id="article4" placeholder="Article4"  style="margin-right: 30px" autocomplete="off">

                    </div>

                    <script>
                        $(document).ready(function() {
                        $( "#article4" ).autocomplete({
                      
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
                            $('#article4').val(ui.item.label);
                                    return false;
                                },
                        minLength: 1
                     });
                    })
                    </script> 
                </td>
                <td>
                    <div>
                        <input type="number" name="nombre4" id="nombre4" min="1" value="1" style="margin-left: 15px">
                    </div>
                </td>
                <td>
                    <div>
                            <input type="text" name="plan4"  id="plan4"  style="margin-right: 30px;margin-left: 30px" autocomplete="off">
                    </div>

                    <script>
                        $(document).ready(function() {
                        $( "#plan4" ).autocomplete({
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
                            $('#plan4').val(ui.item.label);
                                    return false;
                                },
                        minLength: 1
                     });
                    })
                    </script> 

                    @error("nombre4")
                        {{$message}}
                    @enderror                  
                    <div>
                        @error("article4")
                            {{$message}}
                        @enderror 
                    </div>
                </td>
                            
            </tr> 
            {{-- ------------------------Ligne 5--------------------- --}}
            <tr name="Line5"> 
                
                <td>
                    <div>
                         <input type="text" name="article5"  id="article5" placeholder="Article5"  style="margin-right: 30px" autocomplete="off">

                    </div>

                    <script>
                        $(document).ready(function() {
                        $( "#article5" ).autocomplete({
                      
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
                            $('#article5').val(ui.item.label);
                                    return false;
                                },
                        minLength: 1
                     });
                    })
                    </script> 
                </td>
                <td>
                    <div>
                        <input type="number" name="nombre5" id="nombre5" min="1" value="1" style="margin-left: 15px">
                    </div>
                </td>
                <td>
                    <div>
                            <input type="text" name="plan5"  id="plan5"  style="margin-right: 30px;margin-left: 30px" autocomplete="off">
                    </div>

                    <script>
                        $(document).ready(function() {
                        $( "#plan5" ).autocomplete({
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
                            $('#plan5').val(ui.item.label);
                                    return false;
                                },
                        minLength: 1
                     });
                    })
                    </script> 

                    @error("nombre5")
                        {{$message}}
                    @enderror                  
                    <div>
                        @error("article5")
                            {{$message}}
                        @enderror 
                    </div>
                </td>
                            
            </tr> 
            {{-- ------------------------Ligne 6--------------------- --}}
            <tr name="Line6"> 
                
                <td>
                    <div>
                        <input type="text" name="article6"  id="article6" placeholder="Article6"  style="margin-right: 30px" autocomplete="off">

                    </div>

                    <script>
                        $(document).ready(function() {
                        $( "#article6" ).autocomplete({
                      
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
                            $('#article6').val(ui.item.label);
                                    return false;
                                },
                        minLength: 1
                     });
                    })
                    </script> 
                </td>
                <td>
                    <div>
                        <input type="number" name="nombre6" id="nombre6" min="1" value="1" style="margin-left: 15px">
                    </div>
                </td>
                <td>
                    <div>
                            <input type="text" name="plan6"  id="plan6"  style="margin-right: 30px;margin-left: 30px" autocomplete="off">
                    </div>

                    <script>
                        $(document).ready(function() {
                        $( "#plan6" ).autocomplete({
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
                            $('#plan6').val(ui.item.label);
                                    return false;
                                },
                        minLength: 1
                     });
                    })
                    </script> 

                    @error("nombre6")
                        {{$message}}
                    @enderror                  
                    <div>
                        @error("article6")
                            {{$message}}
                        @enderror 
                    </div>
                </td>
                            
            </tr> 
            {{-- ------------------------Ligne 7--------------------- --}}
            <tr name="Line7"> 
                
                <td>
                    <div>
                        <input type="text" name="article7"  id="article7" placeholder="Article7"  style="margin-right: 30px" autocomplete="off">

                    </div>

                    <script>
                        $(document).ready(function() {
                        $( "#article7" ).autocomplete({
                      
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
                            $('#article7').val(ui.item.label);
                                    return false;
                                },
                        minLength: 1
                     });
                    })
                    </script> 
                </td>
                <td>
                    <div>
                        <input type="number" name="nombre7" id="nombre7" min="1" value="1" style="margin-left: 15px">
                    </div>
                </td>
                <td>
                    <div>
                            <input type="text" name="plan7"  id="plan7"  style="margin-right: 30px;margin-left: 30px" autocomplete="off">
                    </div>

                    <script>
                        $(document).ready(function() {
                        $( "#plan7" ).autocomplete({
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
                            $('#plan7').val(ui.item.label);
                                    return false;
                                },
                        minLength: 1
                     });
                    })
                    </script> 

                    @error("nombre7")
                        {{$message}}
                    @enderror                  
                    <div>
                        @error("article7")
                            {{$message}}
                        @enderror 
                    </div>
                </td>
                            
            </tr> 

            {{-- ------------------------Ligne 8--------------------- --}}
            <tr name="Line8"> 
                
                <td>
                    <div>
                         <input type="text" name="article8"  id="article8" placeholder="Article8"  style="margin-right: 30px" autocomplete="off">

                    </div>

                    <script>
                        $(document).ready(function() {
                        $( "#article8" ).autocomplete({
                      
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
                            $('#article8').val(ui.item.label);
                                    return false;
                                },
                        minLength: 1
                     });
                    })
                    </script> 
                </td>
                <td>
                    <div>
                        <input type="number" name="nombre8" id="nombre8" min="1" value="1" style="margin-left: 15px">
                    </div>
                </td>
                <td>
                    <div>
                            <input type="text" name="plan8"  id="plan8"  style="margin-right: 30px;margin-left: 30px" autocomplete="off">
                    </div>

                    <script>
                        $(document).ready(function() {
                        $( "#plan8" ).autocomplete({
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
                            $('#plan8').val(ui.item.label);
                                    return false;
                                },
                        minLength: 1
                     });
                    })
                    </script> 

                    @error("nombre8")
                        {{$message}}
                    @enderror                  
                    <div>
                        @error("article8")
                            {{$message}}
                        @enderror 
                    </div>
                </td>
                            
            </tr> 

            {{-- ------------------------Ligne 9--------------------- --}}
            <tr name="Line9"> 
                
                <td>
                    <div>
                        <input type="text" name="article9"  id="article9" placeholder="Article9"  style="margin-right: 30px" autocomplete="off">

                    </div>

                    <script>
                        $(document).ready(function() {
                        $( "#article9" ).autocomplete({
                      
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
                            $('#article9').val(ui.item.label);
                                    return false;
                                },
                        minLength: 1
                     });
                    })
                    </script> 
                </td>
                <td>
                    <div>
                        <input type="number" name="nombre9" id="nombre9" min="1" value="1" style="margin-left: 15px">
                    </div>
                </td>
                <td>
                    <div>
                            <input type="text" name="plan9"  id="plan9"  style="margin-right: 30px;margin-left: 30px" autocomplete="off">
                    </div>

                    <script>
                        $(document).ready(function() {
                        $( "#plan9" ).autocomplete({
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
                            $('#plan9').val(ui.item.label);
                                    return false;
                                },
                        minLength: 1
                     });
                    })
                    </script> 

                    @error("nombre9")
                        {{$message}}
                    @enderror                  
                    <div>
                        @error("article9")
                            {{$message}}
                        @enderror 
                    </div>
                </td>
                            
            </tr> 

            {{-- ------------------------Ligne 10--------------------- --}}
            <tr name="Line10"> 
                
                <td>
                    <div>
                        <input type="text" name="article10"  id="article10" placeholder="Article10"  style="margin-right: 30px" autocomplete="off">

                    </div>

                    <script>
                        $(document).ready(function() {
                        $( "#article10" ).autocomplete({
                      
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
                            $('#article10').val(ui.item.label);
                                    return false;
                                },
                        minLength: 1
                     });
                    })
                    </script> 
                </td>
                <td>
                    <div>
                        <input type="number" name="nombre10" id="nombre10" min="1" value="1" style="margin-left: 15px">
                    </div>
                </td>
                <td>
                    <div>
                            <input type="text" name="plan10"  id="plan10"  style="margin-right: 30px;margin-left: 30px" autocomplete="off">
                    </div>

                    <script>
                        $(document).ready(function() {
                        $( "#plan10" ).autocomplete({
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
                            $('#plan10').val(ui.item.label);
                                    return false;
                                },
                        minLength: 1
                     });
                    })
                    </script> 

                    @error("nombre10")
                        {{$message}}
                    @enderror                  
                    <div>
                        @error("article10")
                            {{$message}}
                        @enderror 
                    </div>
                </td>
                            
            </tr> 

        </tbody>
    </table>
</form>

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