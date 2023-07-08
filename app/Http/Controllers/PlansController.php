<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePlansRequest;
use App\Models\articles;
use App\Models\plans;
use Illuminate\Http\Request;

class PlansController extends Controller
{
    //

    public function create()
    {
        //
        
        $prop= plans::select('plans.created_at','plans.code as code','plans.intitule as intitule')
        ->orderBy('plans.created_at','desc')->get();
        //->paginate(6);
    
        //---
            
            return view('series.createP',[
                'properties' => $prop
            ]);
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
    


        
       // finfor
    

 
    //return view('series.listns');
    //return $designarticle;
    return redirect()->route('createP')->with('succes',"Crération réussie");
//


    }
    return redirect()->back()->with('error',"Valeurs incorrectes");

  
     
    }
}
