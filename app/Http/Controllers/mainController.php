<?php

namespace App\Http\Controllers;

use App\Exports\NumsExport;
use App\Http\Requests\UploadfexRequest;
use App\Imports\ImportNums;
use App\Imports\NumsImport;
use App\Imports\NumsIport;
use App\Http\Requests\AfficheNumsRequest;
use App\Http\Requests\CreateArticlesRequest;
use App\Http\Requests\CreateNumsRequest;
use App\Models\articles;
use App\Models\plans;
use Cyberduck\LaravelExcel\Contract\ParserInterface;
//use DB;
use Excel;
use Importer;

use App\Models\num_series;
use Illuminate\Support\Facades\Auth;
 use Illuminate\Support\Facades\DB;
use Illuminate\view\view;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
//use Maatwebsite\Excel\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
//use Maatwebsite\Excel\Facades\Excel;
use RectorPrefix202306\Symfony\Component\Console\Input\Input;

use SQLConnection;
use System;
//use System.Data.SqlClient;



class mainController extends Controller
{


    //

    public function index(): View {

        $articles=articles::all(); 

    
    //---
    
    $numrs= num_series::select('articles.designation as designation','num_series.numS as numS','articles.code as code')
    ->join('articles', 'num_series.article_id', 'articles.id')
    ->orderBy('num_series.created_at','desc')->paginate(6);
       
        return view('series.serieindex',[
            'properties' => $numrs,
            'articles' => $articles
        ]);

        //----

        //return view('series.serieindex');
    }


    public function indexA(AfficheNumsRequest $request)
    {
        $credentials =  $request->validated();
        
        if(isset($credentials)){
     


            $codearticle=$request->input('article'); // val du champs article du form gnms


            // $mareq=         "
            // DECLARE @v NVARCHAR(250)
            // SET @v='".$designarticle."'
            // SELECT num_series.numS , articles.designation
            // FROM articles, num_series 
            //  WHERE num_series.article_id = articles.id AND articles.designation =@v
            // ";

            

            $a= articles::select('*')
            ->where('code', '=',$codearticle)
            ->join('num_series', 'num_series.article_id', 'articles.id')
            ->paginate(15);
            //$images=Page::select('*')->where('type','GALLERY')->paginate(2);

            $articles=articles::all(); 

                    
                    return view('series.serieindex',[
                        'properties' => $a,
                        'articles' => $articles
                    ]);
            

            
        }
        
        return back()->withErrors([
            'articles' => 'Désignation incorect'
        ]);
        
    }

    // public function indexA(AfficheNumsRequest $request): View {
    //     //$nums= num_series::paginate(25);

  
    //         //return view('series.serieindex');
    //     }

//     public function fexport(): View {

//         return view('series.fexport');     
//    }


    public function create(): View {

        //return view('series.create');

        $articles=articles::all(); 
        
        return view('series.create',[
            'articles' => $articles
        ]);  
     }

   

   public function createA(): View {
 
 
    $plans=plans::all();


        return view('series.createA',[
            'plans' => $plans
        ]);
}


   public function listns(): View{
    return view('series.listns');
}
   

//    Configuration::selectRaw('configurations.* as configs', 'shoes.* as shoes', 'categories.* as cats')
//    ->where('configurations.product_id', '$product->id')        // Please use your relation
//    ->join('shoes', 'shoes.config_id', 'configurations.id')
//    ->join('categories', 'categories.shoe_id', 'shoes.id')
//    ->get();

//DB::select('SELECT * FROM configurations as configs, shoes as shoes, categories as cats');

    


public function export() {

    return Excel::download(new NumsExport,'Numeros_de_Series.xlsx');     
}

public function import(UploadfexRequest $request, Excel $excel) {
  
    $credentials =  $request->validated();
    $file = $request->file('file1');


    //return redirect()->back()->with('success', 'Le fichier Excel a été importé avec succès.');
    //$serverName = "kemal-SATELLITE-C660\sqlexpress"; //serverName\instanceName

// Since UID and PWD are not specified in the $connectionInfo array,
// The connection will be attempted using Windows Authentication.
// $connectionInfo = array( "Database"=>"test4", "UID"=>'sa',"PWD"=>'S0L_S3rv3r',);
// $conn = \sqlsrv_connect( $serverName, $connectionInfo);

// if( $conn ) {
//      return 'ok';
// }else{
//      echo "Connection could not be established.<br />";
//      die( print_r( sqlsrv_errors(), true));
// }

//DB::beginTransaction();

// return $request->file('file1');
DB::beginTransaction();
DB::commit();
Excel::import(new ImportNums, $request->file1);
DB::commit();

DB::rollback();


try {
    // Votre code SQL ici
    DB::beginTransaction();
        Excel::import(new ImportNums, $request->file1);

    DB::commit();
} catch (\Exception $e) {
    //DB::rollback();
    // Gérer l'erreur ici
   
    return 'error';
}
  

    return redirect()->route('index')->with('succes',"Importation réussie");;

    
 //return dump($request->file1);     
}
public function fimport() {
    return view('series.fimport');    
}


 
   public function store(CreateNumsRequest $request){

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


    return redirect()->route('index')->with('succes',"Génération réussie");   
 }
    else{
    return redirect()->back()->with('error',"désination incorrecte");
}
 
    //return view('series.listns');

    //return redirect()->route('create')->with('succes',"Génération réussie");

      
    
}



public function storeA(CreateArticlesRequest $request){

 
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
    


        
       // finfor
    

 
    //return view('series.listns');
    //return $designarticle;
    return redirect()->route('createA')->with('succes',"Crération réussie");
//


    }
    return redirect()->back()->with('error',"Valeurs incorrectes");

  
      
    
}





}
