{{-- OK --}}
@extends('series.base')
@section('title', 'GNSAPK')
@section('content')


<div >

    <div class= "container">
        <div class="">
            <h1>Numéros de série</h1>
        </div>
    
        
        <div class="row justify-content-md-center">
    
            <div class="col">
                <form action="" method="post" class="form-inline">
                    @csrf
                
                    <div>
                        @error("article")
                            {{$message}}
                        @enderror 
                    </div>
                    <button class="btn btn-primary my-2 my-sm-0" type="submit" style="margin-right: 5px">Afficher</button>  
                    <div>
                        <label for="article">Article:</label>
                            <select name="article" id="article">
                                @foreach($articles as $a)
                                    <option value="{{ $a->code }}">{{ $a->code }}</option>
                                @endforeach
                            </select>
                
                    </div>                </form>
           
            </div>
    
            <div class="col col-lg-2">
                <div class="row">
                    <form action="{{ route('export')}}" method="post"> 
                        @csrf       
                        <button class="btn btn-outline-success" type="submit">Exporter</button> 
                    </form>
                    <h6>_</h6>        
                    <form action="{{ route('fimport')}}" method="get" >      
                        @csrf  
                        <button class="btn btn-outline-success" type="submit">Importer</button> 
                    </form> 
    
                </div>
    
            </div>
    
        </div>
    
    
        <div class="container">
            
        </div>
    
    
    
    </div>
    
    <div class="container">
        <div class="container">
            <div class="table-wrapper-scroll-y my-custom-scrollbar" style="overflow-y:scroll;height:400px;">
        
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
        
            {{-- {{ $properties->links()}} --}}
        
              </div>
        
        </div>
    

</div>



@endsection