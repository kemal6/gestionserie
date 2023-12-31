<?php

namespace App\Http\Controllers;

use App\Http\Requests\AfficheNumsRequest;
use App\Http\Requests\CreateNumsRequest;
use App\Http\Requests\Storenum_seriesRequest;
use App\Http\Requests\Updatenum_seriesRequest;
use App\Models\articles;
use App\Models\num_series;
use App\Models\plans;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

session_start();
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
        $plans= plans::all();

    
    // //---
    
    // $numrs= num_series::select('articles.designation as designation','num_series.numS as numS','articles.code as code')
    // ->join('articles', 'num_series.article_id', 'articles.id')
    // ->orderBy('num_series.id','desc')->get();
    // //->paginate(6);
       
    //     return view('series.create',[
    //         'properties' => $numrs,
    //         'articles' => $articles
    //     ]);



        ////// ici
        if(!isset($_SESSION['openS'])){
            return redirect()->route('auth.login');
        }

if($_SESSION['openS'] == 0){
    $init=false;
    // dd($init );

    $i=0;

    
    $prop=[''];
    //$articles=articles::all();    

    return view('series.create',[
        'properties' => $prop,
        'articles' => $articles,
        'init' => $init,
        'plans'=>$plans
    ]);


}
else{

    
   // $articles=articles::all(); 
    $numrs= num_series::select('articles.designation as designation','num_series.numS as numS','articles.code as code')
    ->join('articles', 'num_series.article_id', 'articles.id')
    ->orderBy('num_series.id','desc')->first();

//dd($prop->code);
$a=array();
array_push($a,$numrs);        
//dd($a);  
//->paginate(6);

$init=true;

$plans=plans::all(); 
   
return view('series.create',[
        'properties' => $a,
        'articles' => $articles,
        'init' => $init,
        'plans' => $plans
    ]);



}
    }



    public function afget()
    {

        $articles=articles::all(); 
        $plans=plans::all(); 


    
    // //---
    
    // $numrs= num_series::select('articles.designation as designation','num_series.numS as numS','articles.code as code')
    // ->join('articles', 'num_series.article_id', 'articles.id')
    // ->orderBy('num_series.id','desc')->get();
    // //->paginate(6);
       
    //     return view('series.anums',[
    //         'properties' => $numrs,
    //         'articles' => $articles
    //     ]);
    
    
    
            ////// ici
            if(!isset($_SESSION['openS'])){
                return redirect()->route('auth.login');
            }


if($_SESSION['openS'] == 0){ // 1ere arrivée de l'user sur la page
    $init=false;
    // dd($init );

    $i=0;

    
    $prop=[''];
    //$articles=articles::all();    

    return view('series.anums',[
        'properties' => $prop,
        'articles' => $articles,
        'init' => $init,
        'plans'=> $plans
    ]);


}
else{

    
   // $articles=articles::all(); 
    $numrs= num_series::select('articles.designation as designation','num_series.numS as numS','articles.code as code')
->join('articles', 'num_series.article_id', 'articles.id')
->orderBy('num_series.created_at','desc')->first();


//dd($prop->code);
$a=array();
array_push($a,$numrs);        
//dd($a);  
//->paginate(6);

$init=true;
   
return view('series.anums',[
        'properties' => $a,
        'articles' => $articles,
        'init' => $init,
        'plans'=> $plans
    ]);

    }       
    
    }




    public function afpost(AfficheNumsRequest $request)
    {

        
        $credentials =  $request->validated();
        
        if(isset($credentials)){


            
     


            $codearticle=$request->input('article'); // val du champs article du form gnms
            $date=$request->input('date'); // string sous la forme  yyyy-mm-dd 
            $usr=$request->input('usr'); //

            
            //$tabdate=str_split($date);



            $tabdate=explode('-',$date);




            // $tabdate=array_reverse($tabdate);
            // $date=implode($tabdate);


            if( isset($codearticle) && isset($date) && isset($usr) )
            {
                $date=$tabdate[0].'-'.$tabdate[1].'-'.$tabdate[2];

                

               // dd("date: ".$date." **User: ".$usr. "  **code:  ".$codearticle);


                $af= articles::select('num_series.created_at','num_series.user_id as user','articles.designation as designation','num_series.numS as numS','articles.code as code')
                ->where('code', '=',$codearticle)
                ->where('users.id','=',$usr)
                ->whereDate('num_series.created_at','2023-07-17')
                ->join('num_series', 'num_series.article_id', 'articles.id')
                ->join('users', 'users.id', 'num_series.user_id')
                ->orderBy('num_series.id','desc')->get(); 

                //dd($af);

                // $b= num_series::select('num_series.created_at as c ','num_series.numS as n' ,'num_series.id as i')
                // ->orderBy('num_series.id','desc')->get(); 

                $articles=articles::all(); 

                //return($af);


                return view('series.anums',[
                    'properties' => $af,
                    'articles' => $articles,
                    'init' => true
                ]);
            }
            elseif (isset($codearticle) && isset($date)) { //manipula date
                # code...
                $date=$tabdate[0].'-'.$tabdate[1].'-'.$tabdate[2];

                $af= articles::select('num_series.created_at','num_series.user_id as user','articles.designation as designation','num_series.numS as numS','articles.code as code')
                ->where('code', '=',$codearticle)
                ->whereDate('num_series.created_at',$date)
                ->join('num_series', 'num_series.article_id', 'articles.id')
                //->join('users', 'users.id', 'num_series.user_id')
                ->orderBy('num_series.id','desc')->get(); 

                $articles=articles::all(); 


                return view('series.anums',[
                    'properties' => $af,
                    'articles' => $articles,
                    'init' => true
                ]);
           
            }elseif (isset($codearticle) && isset($usr)) {
                
                $af= articles::select('num_series.user_id as user','articles.designation as designation','num_series.numS as numS','articles.code as code')
                ->where('code', '=',$codearticle)
                ->where('users.id','=',$usr)
                ->join('num_series', 'num_series.article_id', 'articles.id')
                ->join('users', 'users.id', 'num_series.user_id')
                ->orderBy('num_series.id','desc')->get();   

                $articles=articles::all(); 


                return view('series.anums',[
                    'properties' => $af,
                    'articles' => $articles,
                    'init' => true
                ]);

                   // dd($a);

            }elseif (isset($user) && isset($date)) {
                # code...
                $date=$tabdate[0].'-'.$tabdate[1].'-'.$tabdate[2];
                
                $af= articles::select('num_series.created_at','num_series.user_id as user','articles.designation as designation','num_series.numS as numS','articles.code as code')
                ->where('user', '=',$usr)
                ->whereDate('num_series.created_at',$date)
                ->join('num_series', 'num_series.article_id', 'articles.id')
                //->join('users', 'users.id', 'num_series.user_id')
                ->orderBy('num_series.id','desc')->get();   

                $articles=articles::all(); 


                return view('series.anums',[
                    'properties' => $af,
                    'articles' => $articles,
                    'init' => true
                ]);


            }elseif(isset($codearticle))
            {


                $a= articles::select('articles.designation as designation','num_series.numS as numS','articles.code as code')
            ->where('code', '=',$codearticle)
            ->join('num_series', 'num_series.article_id', 'articles.id')
            ->orderBy('num_series.id','desc')->get();
               // dd($codearticle);

               $articles=articles::all(); 


               return view('series.anums',[
                   'properties' => $a,
                   'articles' => $articles,
                   'init' => true
               ]);


            }elseif(isset($date))
            {
                //dd($codearticle);
//                dd($date);


                $date=$tabdate[0].'-'.$tabdate[1].'-'.$tabdate[2];


                $af= articles::select('num_series.created_at','num_series.user_id as user','articles.designation as designation','num_series.numS as numS','articles.code as code')
                ->where('num_series.created_at','=',$date)
                ->join('num_series', 'num_series.article_id', 'articles.id')
                //->join('users', 'users.id', 'num_series.user_id')
                ->orderBy('num_series.id','desc')->get(); 

                //$af=num_series::select('created_at')->first();

                // date_DB: 2023-07-25

                //dd($date);

               //return num_series::select('numS','created_at')->where('created_at','=','2023-07-19')->get();

                //dd($af);

                $articles=articles::all(); 


                return view('series.anums',[
                    'properties' => $af,
                    'articles' => $articles,
                    'init' => true
                ]);


            }elseif(isset($usr))
            {
                $a= articles::select('user_id','articles.designation as designation','num_series.numS as numS','articles.code as code')
            ->where('user_id', '=',$usr)
            ->join('num_series', 'num_series.article_id', 'articles.id')
            ->orderBy('num_series.id','desc')->get();
                //dd($usr);

                $articles=articles::all(); 


                return view('series.anums',[
                    'properties' => $a,
                    'articles' => $articles,
                    'init' => true
                ]);


            }else{

                return back()->withErrors([
                    'articles' => 'Champs mals remplis'
                ]);

            }


            

            //return dd($a[0]->code);
            //->paginate(6);

//             $numrs= num_series::select('articles.designation as designation','num_series.numS as numS','articles.code as code')
// ->join('articles', 'num_series.article_id', 'articles.id')
// ->orderBy('num_series.created_at','desc')->first();


// //dd($prop->code);
// // $a=array();
// // array_push($a,$numrs);
            

//             $articles=articles::all(); 

                    
//                     return view('series.anums',[
//                         'properties' => $a,
//                         'articles' => $articles
//                     ]);



                    
            

            
        } // fin if credentiels
        
        return back()->withErrors([
            'articles' => 'Désignation incorect'
        ]);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateNumsRequest $request)
    {
        // 
        

        $plan=plans::all();   
        

        if(!isset($_SESSION['openS'])){
            return redirect()->route('auth.login');
        }

    $c= $request->validated( );
    $c=1;


    if(isset($c)){

        $ac="";
        $arc=[];

        $arcl=[];

        for($i=1;$i<=10;$i++){  // Pour toutes les lignes du tableau


            $ac=" Article".$i.": ".$request->input('article'.$i)."   ** Plan".$i.": ".$request->input('plan'.$i)."   ** Nombre".$i.": ".$request->input('nombre'.$i);
            
            array_push($arcl,$request->input('article'.$i)); 
            array_push($arcl,$request->input('plan'.$i)); 
            array_push($arcl,$request->input('nombre'.$i)); 

            array_push($arc,$arcl); 
            $arcl=[];

        }

        //dd($arc);

        $rr=[];

        foreach ($arc as $row){
            if(!in_array(0,$row)){ // traitement 
                array_push($rr,$row);
            }
        }

        $ac="";


        // foreach ($rr as $row){
        //     $ac=$ac.$row['0'];
        // }

        // dd($ac);

        $arc=[];
        $n=0;

     if ($rr==$arc){ // si on na encore rien generer on cmce a zero
        return redirect()->back()->with('error',"Vérifiez qu'au moins une ligne est completement remplie..");
    }


        foreach ($rr as $row){  // Pour toutes les lignes du tableau


            // $ac=" Article".$i.": ".$request->input('article'.$i)."   ** Plan".$i.": ".$request->input('plan'.$i)."   ** Nombre".$i.": ".$request->input('nombre'.$i);
            // array_push($arc,$ac); 
            
            
                    //-- debut
       
                    // $nbg=$request->input('nombre'.$i); // nombre de nms a generer        
                    // $codeA=$request->input('article'.$i); // ncode de l'art a generer        
                    // $plan=$request->input('plan'.$i); // plan
                    // $plane= plans::where('code',$plan)->first();
                    
                    $nbg=$ac.$row['2'];// nombre de nms a generer        
                    $codeA=$ac.$row['0']; // ncode de l'art a generer        
                    $plan=$ac.$row['1']; // plan
                    $plane= plans::where('code',$plan)->first();
  
   //dd("plan : ".$plan." || ".$plane);
    
    // if (!isset($plan) && !isset($plane) && !isset()){ // si on na encore rien generer on cmce a zero
    //     return redirect()->back()->with('error',$i."jjjVérifiez les lignes que vous avez remplies sont completes");
    // }
    // if (!isset($codeA) && !isset($plan) && $n<9 ){ // si on ttes les val de col a la ligne courante
    //     $n=$n+1;
    //     break;
    //     //return redirect()->back()->with('error',"Vérifiez les lignes que vous avez remplies sont completes");
    // }
    // if ((!isset($codeA) && isset($plan)) or (isset($codeA) && !isset($plan)) or ($n==10)){ // si on ttes les val de col a la ligne courante
    //     //$testop=false;
    //     //continue;
    //     return redirect()->back()->with('error',"Vérifiez les lignes que vous avez remplies sont completes");
    // }
     
    // if (!isset($plan) && !isset($plane) && !isset()){ // si on na encore rien generer on cmce a zero
    //     return redirect()->back()->with('error',$i."jjjVérifiez les lignes que vous avez remplies sont completes");
    // }

    // $a= articles::select('articles.id','articles.code','num_series.numS','num_series.created_at') //dernier nums de cet art generer
    // ->where('articles.code', '=',$codeA)
    // ->join('num_series', 'num_series.article_id', 'articles.id')->orderBy('num_series.id','desc')->first();

    $a= articles::select('articles.id','articles.code','articles.lastns as lastns') //dernier nums de cet art generer
    ->where('articles.code', '=',$codeA)->first();
    //->orderBy('a.id','desc')->first();

    // ici
;

    if (!isset($a)){ // si on na encore rien generer on cmce a zero
        $lastns=0;
    }
    else{ // sinon on cmce a la dernier val de ns
         
    $ilastnsid=$a->lastns; // substr($chaine, -10)
    $lastnsid=substr($ilastnsid, -4);

    $lastns=(int)$lastnsid;

    }






    
    $p=$lt=$lastns;

    

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
       $ca=Carbon::now()->toDateString();

      //dd($ca);

      $existns= num_series::select('numS')->where('numS','=',$numser)->get(); // ns ayant le mm numS
      $texistns=$existns=="[]";
      if(!$texistns ){
   // dd($numser.'  *  '.$existns.'  ** '.$texistns);
       return redirect()->back()->with('error',"Numéro de série conflictuel!!   
       veuillez consuter la liste des numéros de séries existants pour cet article  
       et modifier le dernier numéro de série de l'article .. ");
    }

   //dd($numser.'  *  '.$plan.'  ** '.$ca);

            $nums= num_series::create(
                array(
                'article_id'=> $artid,        
                'numS' => $numser,
                'user_id' => $userid,
                'plan_code' => $plan,
                'created_at' => $ca,
                'updated_at' => $ca
                )
            );
        
        // $nums->timestamp('created_at')->useCurrent();
        // $nums->timestamp('updated_at')->useCurrent();
 

        $art= articles::where('code',$codeA)->first();
                //$art->plan_id=$plan;
                //$art->code=$codearticle;
                //$art->designation=$designarticle;
        $art->lastns=$numser;                
        $art->save();

        $p=$p+1;
        $_SESSION['openS']=$_SESSION['openS']+ 1;


    }



        }  // fin pour toutes les lignes du tableau

        // dd($arc);

        // print_r($ac);
    
        return redirect()->route('createns')->with('succes',"Génération réussie"); 


  
 }
    else{

        dd('ici');
    //return redirect()->back()->with('error',"désination incorrecte");
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
