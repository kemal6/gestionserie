<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUsersRequest;
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
