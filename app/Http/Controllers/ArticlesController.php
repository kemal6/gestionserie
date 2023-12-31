<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ArticlesController;
use App\Http\Requests\AfficheArticlesRequest;
use App\Http\Requests\CreateArticlesRequest;
use App\Http\Requests\StorearticlesRequest;
use App\Http\Requests\UpdatearticlesRequest;
use App\Models\articles;
use App\Models\num_series;
use App\Models\plans;
use Illuminate\Http\Client\Request;
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


    public function getArticles(Request $request){ // autocomplete users

    
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        //$plans=plans::all(); 

    
        //---

        if(!isset($_SESSION['openA'])){
            return redirect()->route('auth.login');
        }

     if(isset($_SESSION['openA'])){

        if($_SESSION['openA'] == 0){
            $init=false;
            // dd($init );

            $i=0;

            
            $prop=[''];
           
            return view('series.createA',[
                //'plans' => $plans,
                'properties' => $prop,
                'init' => $init
            ]);


        }
        else{

            

        $prop= articles::select('articles.id','articles.created_at','articles.lastns','articles.designation as designation','articles.code as code')
        //->join('plans', 'articles.plan_id', 'plans.id')
        ->orderBy('articles.id','desc')->first();

        //$prop=articles::latest()->first();

        //dd($prop->code);
        $a=array();
        array_push($a,$prop);        
        //dd($a);  
        //->paginate(6);


           
            return view('series.createA',[
              //  'plans' => $plans,
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
    //$plan=$request->input('plan');
    $ns=$request->input('lastns');
    $lastns=$ns;
    // if(!isset($ns) ){
    //     $lastns=$ns;
    // }else{
    //     $lastns="";
    // }
    


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
                    'code' => $codearticle,
                    'designation' => $designarticle,
                    'lastns' => $lastns,
                    // 'user_id' => $user->id, 
                     ]
             );

            $_SESSION['openA']=$_SESSION['openA']+1;

            

            // $art= articles::where('code',$codearticle)->first();
            //     //$art->code=$codearticle;
              
                 $a=array();
                array_push($a,[
                    'code' => $codearticle,
                    'designation' => $designarticle,
                    'lastns' => $lastns,
                    // 'user_id' => $user->id, 
                     ]);
             $data=['properties'=>$a,'init'=>true];


             


             //return redirect()->route('afapost',$data)->with('succes',"Opération réussie");
             return redirect()->back()->with('succes',"Opération réussie");

        }else{
            //dd('reoog');
            return redirect()->back()->with('error',"Numéros de séries incorrectes");


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

           // dd($codearticle);



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
                //dd($codearticle);

            // $af= articles::select('plans.id','plans.code as plan','articles.designation as designation','articles.code as code','articles.lastns as lastns')
            // ->where('articles.code', '=',$codearticle)
            // ->join('plans', 'articles.plan_id','plans.id')
            // // ->join('users', 'users.id', 'num_series.user_id')
            // ->orderBy('articles.created_at','desc')->get(); 

            $af=articles::select('articles.designation as designation','articles.code as code','articles.lastns as lastns')
            ->where('articles.code', '=',$codearticle)
            ->orderBy('articles.created_at','asc')->get();

            $articles=articles::all(); 

            //dd($af);


            return view('series.aart',[
                'properties' => $af,
                //'articles' => $articles,
                //'plans'=>$plans,
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
                return redirect()->route('auth.login');            
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

        $c= $request->validated( );


          
        $designarticle=$request->input('designation'); // val du champs article du form gnms
        $codearticle=$request->input('code'); // val du champs article du form gnms
        $plan=$request->input('plan');
        $ns=$request->input('lastns');
        $lastns=$ns;

        //dd($designarticle." *** ".$codearticle." *** ".$plan." *** ".$ns);
    
        // if(isset($ns) ){
        //     $lastns=$ns;
        // }else{
        //     $lastns="";
        // }
        
    
    
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

        // $lns= articles::select('articles.code as code','articles.lastns as lans','articles.id') //codea equiv dans la bd
        // ->where('articles.code', '=',$codearticle)
        // ->orderBy('articles.id')->first();

        //dd($lns);
    
        $a= articles::select('articles.id','articles.code','articles.lastns as lastns') //dernier nums de cet art generer
        ->where('articles.code', '=',$codearticle)->first();
        //->orderBy('a.id','desc')->first();

    // ici
;

       
            
        $ilastnsid=$a->lastns; // substr($chaine, -10)
        $lastnsid=substr($ilastnsid, -4);
        $lastns=(int)$lastnsid;

        $lastnside=substr($ns, -4);
        $lastnse=(int)$lastnside;

        $cmp=$lastns<=$lastnse;

        //dd(" bd: ".$lastns."  usr: ".$lastnse." cmp ".!$cmp);


        if(!$cmp){
            // dd("Lool");
                return redirect()->back()->with('error',"Numéro de série conflictuel!!   
                veuillez insérer un numéro supérieur au dernier numéro de série courrant... ");
             }


    
    
    
        if($resultcode){ //si nums absent mais codea present 
    
            // $dnumrs= num_series::select('articles.code','num_series.numS as numS','num_series.id as ids')
            // ->join('articles', 'num_series.article_id', 'articles.id')
            // ->where('articles.code','=',$codearticle)
            // ->orderBy('num_series.id','desc')->first();

            $dnumrs=$a->lastns;

            $dy1= substr($dnumrs,-6); // 6 derniers carac de nums

            $lastns=$ns;

    
            $numser=$lastns;
            $codear=$codearticle;
    
            $user=Auth::user();
    
            $ccode = substr($numser,0, strlen($codear)); //codea dans nums
            $y1 = substr($numser,-6); // 6 derniers carac de nums
            $y2 = substr($numser,-4); 
            
            //dd($a->lastns);

    
            $t3=intval($y1)==$y1; // 6 derniers carac sont des entiers
    
            $t1=($ccode==$codear);
    
            $t2=($codear.$y1==$numser); // test de long de nums
            $year=substr(strval(date('Y')),-2);  // deux derniers carac de l'année en cours
    
            $t4=($year.$y2 == $y1);// format 23xxxx
            //dd('ici');

            $t5=intval($y1)>=intval($dy1); // dernier ns de usr > dernier ns en bd
    
            if($numser==""){

                return redirect()->back()->with('error',"Numéro de série invalide..");

                //$numser=$codear."230000";

            }
    
            //dd("3:".$t3." 1:".$t1." 2:".$t2." 4:".$t4." 5:".$t5);
            //dd($t4);
            //continue
    
            if($t3 && $t1 && $t2 && $t4 && $t5)
            {
               // $ida=$b->ida;
                //$codea=$b->code;
                //dd('super');
    
                //dd($plan." ".$codearticle." ".$designarticle." ".$numser);
    
                $art= articles::where('code',$codearticle)->first();
                //$art->code=$codearticle;
                $art->designation=$designarticle;
                $art->lastns=$numser;                
                $art->save();

                //  articles::create(
                //     [
                //         'plan_id' => $plan,
                //         'code' => $codearticle,
                //         'designation' => $designarticle,
                //         'lastns' => $lastns,
                //         // 'user_id' => $user->id, 
                //          ]
                //  );
    
                 return redirect()->back()->with('succes',"Opération réussie");
    
            }else{
                //dd('reoog');
                return redirect()->back()->with('error',"Valeurs incorrectes");
    
    
            }
    
    
    
          
    
          
    
        }else{
            //dd($lastns);
    
            return redirect()->back()->with('error',"Cet article existe déja dans la base de donnée..");
    
        }
           
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(articles $articles)
    {
        //
    }
}
