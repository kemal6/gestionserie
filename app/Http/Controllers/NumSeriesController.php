<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateNumsRequest;
use App\Http\Requests\Storenum_seriesRequest;
use App\Http\Requests\Updatenum_seriesRequest;
use App\Models\articles;
use App\Models\num_series;
use Illuminate\Support\Facades\Auth;

class NumSeriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $articles=articles::all(); 

    
    //---
    
    $numrs= num_series::select('articles.designation as designation','num_series.numS as numS','articles.code as code')
    ->join('articles', 'num_series.article_id', 'articles.id')
    ->orderBy('num_series.created_at','desc')->paginate(6);
       
        return view('series.create',[
            'properties' => $numrs,
            'articles' => $articles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateNumsRequest $request)
    {
        //

    $c= $request->validated( );


    if(isset($c)){




        //-- debut
       
    $nbg=$request->input('nombre'); // nombre de nms a generer        
    $codeA=$request->input('article'); // ncode de l'art a generer        

    $a= articles::select('articles.id','articles.code','num_series.numS','num_series.created_at') //dernier nums de cet art generer
    ->where('articles.code', '=',$codeA)
    ->join('num_series', 'num_series.article_id', 'articles.id')->orderBy('num_series.id','desc')->first();

   
    // ici
;

    if (!isset($a)){ // si on na encore rien generer on cmce a zero
        $lastns=0;
    }
    else{ // sinon on cmce a la dernier val de ns
         
    $ilastnsid=$a->numS; // substr($chaine, -10)
    $lastnsid=substr($ilastnsid, -4);

    $lastns=(int)$lastnsid;

    }






    
    $p=$lt=$lastns+1;

    

    $b= articles::select('articles.id') // id de cet art
    ->where('code', '=',$codeA)->first();

    $artid=$b->id;


    for($j=1;$j<=$nbg;$j++){ // on boucle le nbr de generation desire

        $lt="";
   
        $nbzc= 4-strlen($p); // nombre de zero a cplter
    
        $year=substr(strval(date('Y')),-2);  // deux derniers carac de l'année en cours 
        
        for ($i = 1; $i <= $nbzc; $i++) {
            $lt="0".$lt; // on completele reste de zero pour avoir "_____0000"/"___0001"
        }
        $lt=$lt.$p;
    
        $nsf= $codeA.$year.$lt; // formatage "codeA23xxxx"
    
        $numser=$nsf;
        $userid=Auth::user()->id;
        //$artid=1;


        $nums= num_series::create(
            [
            'article_id'=> $artid,        
            'numS' => $numser,
            'user_id' => $userid,
    
            ]
        );

        $p=$p+1;

    }


    return redirect()->route('createns')->with('succes',"Génération réussie");   
 }
    else{
    return redirect()->back()->with('error',"désination incorrecte");
}
 
    //return view('series.listns');

    //return redirect()->route('create')->with('succes',"Génération réussie");

      
    }

    /**
     * Display the specified resource.
     */
    public function show(num_series $num_series)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(num_series $num_series)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Updatenum_seriesRequest $request, num_series $num_series)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(num_series $num_series)
    {
        //
    }
}
