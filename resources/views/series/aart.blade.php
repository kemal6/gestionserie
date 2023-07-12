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
        @error("designation")
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
            </tr>
        </head>
        <tbody>
            

                    @foreach ($properties as $property )
                <tr>
                    
                    <td>{{ $property->code}}</td>
                    <td>{{ $property->designation}}</td>
                    <td>{{ $property->lastns}}</td>
                    <td>{{ $property->plan}}</td>

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