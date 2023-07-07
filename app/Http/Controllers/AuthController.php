<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Models\users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function login()
    {
        // User::create([
        //     'name' => 'john',
        //     'email' => 'john@gmail.com',
        //     'password'=> Hash::make('5623')
        // ]);
        return view('auth.login');
        
    }

    public function dologin(LoginRequest $request)
    {
        $credentials =  $request->validated();
        $um= $request->input('email');
        $pwe= $request->input('password');
        
        $b= users::select('users.email as email','users.password as password') // id de cet art
        ->where('users.email', '=',$um)->first();
    

//return (Auth::attempt($credentials));


            if(Auth::attempt($credentials)){

        $artid=$b->email;
        $pwd=$b->password;

        $artv= $pwe==$pwd;


                $request->session()->regenerate();
                return redirect()->intended(route('index'));
            }
        
        return back()->withErrors([
            'email' => 'Identifiants incorrect'
        ])->onlyInput('email');
        
    }

    public function logout()
    {
        Auth::logout();
        return to_route('auth.login')->with('succes','Vous etes maintenant déconnecté');
    }
}
