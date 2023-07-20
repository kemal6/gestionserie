<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUsersRequest;
use App\Models\articles;
use App\Models\plans;
use App\Models\users;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class CreateUsersController extends Controller
{
    //
    public function fregister()
    {
        return view('series.register');
    }




    public function getPlans(Request $request){ // autocomplete users

        $search = $request->search;
    
        $search = $request->get('term'); // récupère la saisie de l'utilisateur
    
        if($search == ""){
            $usrs= plans::orderby('code','asc')
            ->select('id','code')
            ->limit(5)
            ->get();
        }else{
            $usrs= plans::orderby('code','asc')
            ->select('id','code')
            ->where('code','like','%'.$search.'%')
            ->limit(5)
            ->get();
        }
        $response=$usrs;
    
    
        //$response= ['yo','ok'];
        $response = array();
        foreach($usrs as $usr){
            $response[] = array(
                'value' => $usr->id,
                'label' => $usr->code
            );
        }
        return response()->json($response);
    
    }




    public function getArticles(Request $request){ // autocomplete users

        $search = $request->search;
    
        $search = $request->get('term'); // récupère la saisie de l'utilisateur
    
        if($search == ""){
            $usrs= articles::orderby('code','asc')
            ->select('id','code')
            ->limit(5)
            ->get();
        }else{
            $usrs= articles::orderby('code','asc')
            ->select('id','code')
            ->where('code','like','%'.$search.'%')
            ->limit(5)
            ->get();
        }
        $response=$usrs;
    
    
        //$response= ['yo','ok'];
        $response = array();
        foreach($usrs as $usr){
            $response[] = array(
                'value' => $usr->id,
                'label' => $usr->code
            );
        }
        return response()->json($response);
    
    }

public function getUsers(Request $request){ // autocomplete users

    $search = $request->search;

    $search = $request->get('term'); // récupère la saisie de l'utilisateur

    if($search == ""){
        $usrs= User::orderby('email','asc')
        ->select('id','email')
        ->limit(5)
        ->get();
    }else{
        $usrs= User::orderby('email','asc')
        ->select('id','email')
        ->where('email','like','%'.$search.'%')
        ->limit(5)
        ->get();
    }
    $response=$usrs;


    //$response= ['yo','ok'];
    $response = array();
    foreach($usrs as $usr){
        $response[] = array(
            'value' => $usr->id,
            'label' => $usr->email
        );
    }
    return response()->json($response);

}

    /**
     * Show the form for creating a new resource.
     */
    public function register(CreateUsersRequest $request)
    {
        

        $c=$request->validated();
        $name=$request->input('nom'); // nombre de nms a generer        
        $email=$request->input('email'); // nombre de nms a generer        
        $passw=$request->input('password'); // nombre de nms a generer        

        if(isset($c))
        {

            // $user=User::create(
            //     [
            //     'name'=> $name  ,
            //     'email' => $email,
            //     'password' => $passw    
            //     ]
            // ); 
        $usr=users::create(
            [
            'name'=> $name  ,
            'email' => $email,
            'password' => Hash::make($passw)    
            ]
        );  
        
         
        
        return redirect()->route('auth.login')->with('succes',"Crération réussie");
        }
        return redirect()->back()->with('error',"Valeurs incorrectes");


        
    }

}
