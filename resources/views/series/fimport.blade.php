@extends('series.base')

@section('title', 'GNSAPK')
@section('content')
<h1>Exporter des numéros de séries</h1>
<form action="{{ route('import')}}" method="post">
    @csrf

    <div>
        <input type="file" name="file" id="file"  accept=".xlsx" class="custom-file-input">
        @error("file")
            {{$message}}
        @enderror  
            
    <script>
    var previousPath="";
    
    function maFonction(){
    var path=window.document.getElementById("file").value;
    
    // permet l'exécution seulement si "path" a été modifié et non null
    if(path==previousPath)
      return;
    previousPath=path;
    
    // execution
    alert(path);
    }
    </script>  
    </div>
    <INPUT TYPE="file" NAME="file1" SIZE="60" MAXLENGTH="60" onchange='return file1Value(this)'>
        <INPUT TYPE="hidden" NAME="file1name" VALUE="">
         
        <SCRIPT LANGUAGE="JavaScript">
        const selectedFile = document.getElementById("file1").files[0];
        var path = (window.URL || window.webkitURL).createObjectURL(file);
    console.log('path', path);

        thisvalue.form.file.value = selectedFile;

        </SCRIPT>
     
    <button> Importer </button>
    
</form>
@endsection

<!-- permet de créer la boite de parcourt -->

