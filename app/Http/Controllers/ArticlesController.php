<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateArticlesRequest;
use App\Http\Requests\StorearticlesRequest;
use App\Http\Requests\UpdatearticlesRequest;
use App\Models\articles;
use App\Models\plans;


session_start();

class ArticlesController extends Controller
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
        //
        $plans=plans::all(); 

    
        //---

        if($_SESSION['openA'] == 0){
            $init=false;
            // dd($init );

            $i=0;

            
            $prop=[''];
           
            return view('series.createA',[
                'plans' => $plans,
                'properties' => $prop,
                'init' => $init
            ]);


        }
        else{

            

            $prop= articles::select('articles.created_at','articles.plan_id','articles.lastns','plans.id','articles.designation as designation','articles.code as code','plans.id','plans.code as plan')
        ->join('plans', 'articles.plan_id', 'plans.id')->orderBy('articles.created_at','desc')->first();

        //dd($prop->code);
        $a=array();
        array_push($a,$prop);        
        //dd($a);  
        //->paginate(6);


           
            return view('series.createA',[
                'plans' => $plans,
                'properties' => $a,
                'init' => true
            ]);


        }
        
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateArticlesRequest $request)
    {
        //

    $c= $request->validated( );


          
    $designarticle=$request->input('designation'); // val du champs article du form gnms
    $codearticle=$request->input('code'); // val du champs article du form gnms
    $plan=$request->input('plan');

    $a= articles::select('articles.code')
    ->where('articles.code','=',$codearticle)->first();


    

    if(isset($c) && !isset($a)){



    // $a= num_series::select('num_series.numS','num_series.id')
    // ->orderBy('num_series.id','desc')->first();

    $a=$codearticle."230000";

 
    $lastns=$a;


    $art= articles::create(
        [
        'designation'=> $designarticle  ,
        'code' => $codearticle,
        'lastns' => $lastns,
        'plan_id' => $plan

        ]
    );
    
    $_SESSION['openA']=$_SESSION['openA']+ 1;

        
       // finfor
    

 
    //return view('series.listns');
    //return $designarticle;
    return redirect()->route('createA')->with('succes',"Crération réussie");
//


    }
    return redirect()->back()->with('error',"Valeurs incorrectes");

  
     
    }

    /**
     * Display the specified resource.
     */
    public function show(articles $articles)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(articles $articles)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatearticlesRequest $request, articles $articles)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(articles $articles)
    {
        //
    }
}
