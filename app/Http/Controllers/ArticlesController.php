<?php

namespace App\Http\Controllers;

use App\Http\Requests\AfficheArticlesRequest;
use App\Http\Requests\CreateArticlesRequest;
use App\Http\Requests\StorearticlesRequest;
use App\Http\Requests\UpdatearticlesRequest;
use App\Models\articles;
use App\Models\num_series;
use App\Models\plans;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


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

     if(isset($_SESSION['openA'])){

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

     }else{
        return redirect()->route('login');            
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
    $ns=$request->input('lastns');

    if(isset($ns) ){
        $lastns=$ns;
    }else{
        $lastns="";
    }
    


    $a= articles::select('articles.code')
    ->where('articles.code','=',$codearticle)->first();

    $valueToCheckcode =$codearticle;


      $resultcode = DB::table('articles')
        ->whereRaw("code COLLATE SQL_Latin1_General_CP1_CS_AS = '$valueToCheckcode'")
        ->exists();

    $valueToChecknums =$lastns;

    $resultnums = DB::table('num_series')
        ->whereRaw("numS COLLATE SQL_Latin1_General_CP1_CS_AS = '$valueToChecknums'")
        ->exists();


    $b= articles::select('articles.code as code','articles.id as ida') //codea equiv dans la bd
    ->where('articles.code', '=',$codearticle)->orderBy('articles.id')->first();



    if(!$resultcode && !$resultnums){ //si nums absent mais codea present 


        $numser=$lastns;
        $codear=$codearticle;

        $user=Auth::user();

        $ccode = substr($numser,0, strlen($codear)); //codea dans nums
        $y1 = substr($numser,-6); // 6 derniers carac de nums
        $y2 = substr($numser,-4); 


        $t3=intval($y1)==$y1; // 6 derniers carac sont des entiers

        $t1=($ccode==$codear);

        $t2=($codear.$y1==$numser); // test de long de nums

        $t4=("23".$y2 == $y1);// format 23xxxx
        //dd('ici');

        if($numser==""){
            $numser=$codear."230000";
        }

        //dd($t4);

        if($t3 && $t1 && $t2 && $t4)
        {
           // $ida=$b->ida;
            //$codea=$b->code;
            //dd('super');

           // dd($plan." ".$codearticle." ".$designarticle." ".$lastns." ".$user->id);

             articles::create(
                [
                    'plan_id' => $plan,
                    'code' => $codearticle,
                    'designation' => $designarticle,
                    'lastns' => $lastns,
                    // 'user_id' => $user->id, 
                     ]
             );

             return redirect()->back()->with('succes',"Opération réussie");

        }else{
            //dd('reoog');
            return redirect()->back()->with('error',"Valeurs incorrectes");


        }



      

      

    }else{
        //dd($lastns);

        return redirect()->back()->with('error',"Ce code est déja présent dans la base de donnée");

    }
       


     
    }


    public function afapost(AfficheArticlesRequest $request){



        
        $credentials =  $request->validated();
        
        if(isset($credentials)){


            
     

            $plans= plans::all();
            $codearticle=$request->input('code'); // val du champs article du form gnms
            $designation=$request->input('designation'); // string sous la forme  yyyy-mm-dd 
            $plan=$request->input('plan'); //
            $date=$request->input('date'); //
            
            //$tabdate=str_split($date);



            $tabdate=explode('-',$date);




            // $tabdate=array_reverse($tabdate);
            // $date=implode($tabdate);


            if( isset($codearticle) && isset($date) && isset($plan) )
            {
            //dd($plan.' '.$date.' '.$codearticle);

            $date=$tabdate[0].'-'.$tabdate[2].'-'.$tabdate[1];

                $af= articles::select('plans.id','plans.code as plan','articles.designation as designation','articles.code as code','articles.lastns as lastns')
                ->where('articles.code', '=',$codearticle)
                ->where('plans.id','=',$plan)
                ->whereDate('articles.created_at',$date)
                ->join('plans', 'articles.plan_id','plans.id')
                // ->join('users', 'users.id', 'num_series.user_id')
                ->orderBy('articles.created_at','desc')->get(); 

                $articles=articles::all(); 

                //dd($af);


                return view('series.aart',[
                    'properties' => $af,
                    'articles' => $articles,
                    'plans'=>$plans,
                    'init' => true
                ]);
            }
            elseif (isset($codearticle) && isset($date)) { //manipula date
                # code...
                
            $date=$tabdate[0].'-'.$tabdate[2].'-'.$tabdate[1];

            $af= articles::select('plans.id','plans.code as plan','articles.designation as designation','articles.code as code','articles.lastns as lastns')
            ->where('articles.code', '=',$codearticle)
            ->whereDate('articles.created_at',$date)
            ->orderBy('articles.created_at','desc')->get(); 

            $articles=articles::all(); 

            //dd($af);


            return view('series.aart',[
                'properties' => $af,
                'articles' => $articles,
                'plans'=>$plans,
                'init' => true
            ]);
           
            }elseif (isset($codearticle) && isset($plan)) {
      
            $af= articles::select('plans.id','plans.code as plan','articles.designation as designation','articles.code as code','articles.lastns as lastns')
            ->where('articles.code', '=',$codearticle)
            ->where('plans.id','=',$plan)
            ->join('plans', 'articles.plan_id','plans.id')
            ->orderBy('articles.created_at','desc')->get(); 

            $articles=articles::all(); 

            //dd($af);


            return view('series.aart',[
                'properties' => $af,
                'articles' => $articles,
                'plans'=>$plans,
                'init' => true
            ]);

            }elseif (isset($plan) && isset($date)) {
                # code...
               
            $date=$tabdate[0].'-'.$tabdate[2].'-'.$tabdate[1];

            $af= articles::select('plans.id','plans.code as plan','articles.designation as designation','articles.code as code','articles.lastns as lastns')
            ->where('plans.id','=',$plan)
            ->whereDate('articles.created_at',$date)
            ->join('plans', 'articles.plan_id','plans.id')
            // ->join('users', 'users.id', 'num_series.user_id')
            ->orderBy('articles.created_at','desc')->get(); 

            $articles=articles::all(); 

            //dd($af);


            return view('series.aart',[
                'properties' => $af,
                'articles' => $articles,
                'plans'=>$plans,
                'init' => true
            ]);

            }elseif(isset($codearticle))
            {
                
            $af= articles::select('plans.id','plans.code as plan','articles.designation as designation','articles.code as code','articles.lastns as lastns')
            ->where('articles.code', '=',$codearticle)
            ->join('plans', 'articles.plan_id','plans.id')
            // ->join('users', 'users.id', 'num_series.user_id')
            ->orderBy('articles.created_at','desc')->get(); 

            $articles=articles::all(); 

            //dd($af);


            return view('series.aart',[
                'properties' => $af,
                'articles' => $articles,
                'plans'=>$plans,
                'init' => true
            ]);

            }elseif(isset($date))
            {
              
            $date=$tabdate[0].'-'.$tabdate[2].'-'.$tabdate[1];

            $af= articles::select('plans.id','plans.code as plan','articles.designation as designation','articles.code as code','articles.lastns as lastns')
            ->whereDate('articles.created_at',$date)
            ->join('plans', 'articles.plan_id','plans.id')
            // ->join('users', 'users.id', 'num_series.user_id')
            ->orderBy('articles.created_at','desc')->get(); 

            $articles=articles::all(); 

            //dd($af);


            return view('series.aart',[
                'properties' => $af,
                'articles' => $articles,
                'plans'=>$plans,
                'init' => true
            ]);

            }elseif(isset($plan))
            {
              
            $af= articles::select('plans.id','plans.code as plan','articles.designation as designation','articles.code as code','articles.lastns as lastns')
            ->where('plans.id','=',$plan)
            ->join('plans', 'articles.plan_id','plans.id')
            // ->join('users', 'users.id', 'num_series.user_id')
            ->orderBy('articles.created_at','desc')->get(); 

            $articles=articles::all(); 

            //dd($af);


            return view('series.aart',[
                'properties' => $af,
                'articles' => $articles,
                'plans'=>$plans,
                'init' => true
            ]);
            }else{

                return back()->withErrors([
                    'articles' => 'Champs mals remplis'
                ]);

            }


            

            //return dd($a[0]->code);
            //->paginate(6);
            

            $articles=articles::all(); 

                    
                    return view('series.anums',[
                        'properties' => $a,
                        'articles' => $articles
                    ]);



                    
            

            
        } // fin if credentiels
        
        return back()->withErrors([
            'articles' => 'Désignation incorect'
        ]);
        
    }
    
    public function afaget()
    {

        $articles=articles::all(); 
        $plans=plans::all();


            ////// ici

            if(isset($_SESSION['openAA'])){ // si loggé



                if($_SESSION['openAA'] == 0){ // 1ere arrivée de l'user sur la page
                    $init=false;
                    // dd($init );
                
                    $i=0;
                
                    
                    $prop=[''];
                    //$articles=articles::all();    
                
                    return view('series.aart',[
                        'properties' => $prop,
                        'articles' => $articles,
                        'plans' => $plans,
                        'init' => $init
                    ]);
                
                
                }
                else{
                
                    
                   // $articles=articles::all(); 
                    $numrs= articles::select('articles.plan_id','plans.id','plans.code as plans','articles.designation as designation','articles.lastns as lastns','articles.code as code')
                ->join('plans', 'articles.plan_id', 'plans.id')
                ->orderBy('num_series.created_at','desc')->first();
                
                
                //dd($prop->code);
                $a=array();
                array_push($a,$numrs);        
                //dd($a);  
                //->paginate(6);
                
                $init=true;
                
                
                return view('series.aart',[
                        'properties' => $a,
                        'articles' => $articles,
                        'plans' => $plans,
                        'init' => $init
                    ]);
                
                    }  
            }else{ // non loggé ou expiré
                return redirect()->route('login');            
            }
    
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
