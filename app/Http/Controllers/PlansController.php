<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePlansRequest;
use App\Models\articles;
use App\Models\plans;
use Illuminate\Http\Request;

session_start();


class PlansController extends Controller
{
    //

    public function create()
    {
                
        //


    
        //---

        if( $_SESSION['openP'] == 0){
            // dd($init );

            $prop=[''];
           
            return view('series.createP',[
                'properties' => $prop,
                'init' =>false,
            ]);

        }
        else{


        $prop= plans::select('plans.created_at','plans.code as code','plans.intitule as intitule')
        ->orderBy('plans.created_at','desc')->first();

        //dd($prop->code);
        $a=array();
        array_push($a,$prop);        
        //dd($a);  
        //->paginate(6);


           
        return view('series.createP',[
                'properties' => $a,
                'init' => true
            ]);


        }
    }


    public function store(CreatePlansRequest $request)
    {
        //

    $c= $request->validated( );


          
    $intitule=$request->input('intitule'); 
    $code=$request->input('code'); 

    $a= plans::select('plans.code')
    ->where('plans.code','=',$code)->first();


    

    if(isset($c) && !isset($a)){



 

    $p= plans::create(
        [
        'code' => $code,
        'intitule' => $intitule
        ]
    );

    $_SESSION['openP']=$_SESSION['openP']+ 1;

    


        
       // finfor
    

 
    //return view('series.listns');
    //return $designarticle;
    return redirect()->route('createP')->with('succes',"Crération réussie");
//


    }
    return redirect()->back()->with('error',"Valeurs incorrectes");

  
     
    }
}
