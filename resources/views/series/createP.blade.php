@extends('series.base')

@section('title', 'GNSAPK')
@section('content')
<div>
<div class="container">
<h1 style="margin-bottom: 30px">Créer un plan </h1>
          
    <div class="row justify-content-md-center">
    
        <div class="col">
<form action="" method="post" class="form-inline">
    @csrf

    
    <button class="btn btn-primary" style="margin-right: 25px"> Créer </button>

    
    <div>
    @error("code")
        {{$message}}
    @enderror
    <label for="code" style="color: rgb(38, 73, 190);font-weight: bold;" >Code</label>    
    <input type="text" name="code" value="{{ old('code','plan-1')}} " style="margin-right: 15px">
    </div>
    
    <div>
        @error("designation")
        {{$message}}
    @enderror          
    <label for="intitule" style="color: rgb(38, 73, 190);font-weight: bold;">Intitulé</label>    
        <input type="text" name="intitule" value="{{ old('designation','AkwaB1')}}" style="margin-right: 15px">
    </div>

   
    
 


    
</form>
</div>
    </div>

</div>


    
    <div class="container">
    
            <table class="table table-striped" style="margin-top: 20px">
            <head>
                <tr>
                    <th>Code plan </th>
                    <th class="text-end">Intitulé</th>
                </tr>
            </head>
            <tbody>
                @foreach ($properties as $property )
                    <tr>
                        <td>{{ $property->code}}</td>
                        <td>{{ $property->intitule}}</td>
                    </tr>
                    
                @endforeach
            </tbody>
        </table>
    
        {{ $properties->links()}}
    
    </div>
    

</div>
@endsection