{{-- OK --}}
@extends('series.base')
@section('title', 'GNSAPK')
@section('content')


<div >

    <div class= "container">
        <div class="">
            <h1 style="margin-bottom: 30px">Afficher des numéros de série</h1>
        </div>
    
        
        <div class="row justify-content-md-center">
    
            <div class="col">
                <form action="{{ route('indexA')}}" method="post" class="form-inline">
                    @csrf

                    <button class="btn btn-primary my-2 my-sm-0" type="submit" style="margin-right: 15px">Afficher</button>  
                    <div>
                        <label for="article" style="color: rgb(38, 73, 190);font-weight: bold;">Code_article</label>
                            <select name="article" id="article">
                                @foreach($articles as $a)
                                    <option value="{{ $a->code }}">{{ $a->code }}</option>
                                @endforeach
                            </select>
                
                    </div>                    
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
    
            <table class="table table-striped" style="margin-top: 20px">
            <head>
                <tr>
                    <th>Code article</th>
                    <th>Désignation article</th>
                    <th class="text-end">Numéro série</th>
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
    
        {{ $properties->links()}}
    
    </div>
    

</div>



@endsection