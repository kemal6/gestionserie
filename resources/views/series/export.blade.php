@extends('series.base')

@section('title', 'GNSAPK')
@section('content')
<h1>Exporter des numéros de séries</h1>
<form action="" method="post">
    @csrf

    <div>
        <input type="text" name="article" value="{{ old('article','stylo bic')}}">
        @error("article")
            {{$message}}
        @enderror    
    </div>
     
    <button> Importer </button>
    
</form>
@endsection