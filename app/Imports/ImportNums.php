<?php

namespace App\Imports;

use App\Models\articles;
use App\Models\num_series;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToArray;
use Illuminate\Support\Collection;


class ImportNums implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * //@return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)

    {
        // $r="gomme-1";

        // //foreach($rows as $row ){
        //      //$r=$r." <-> ".$row['numeroserie'];

        // $a= num_series::select('num_series.numS','num_series.id') //Nums de serie eqiv dans la bd
        // ->where('num_series.numS', '=',$row['numeroserie'])->orderBy('num_series.id')->first();


        $b= articles::select('articles.code as code','articles.id as ida') //codea equiv dans la bd
        ->where('articles.code', '=',$row['codearticle'])->orderBy('articles.id')->first();
  

        $valueToCheckcode =$row['codearticle'];

        $resultcode = DB::table('articles')
            ->whereRaw("code COLLATE SQL_Latin1_General_CP1_CS_AS = '$valueToCheckcode'")
            ->exists();

        $valueToChecknums =$row['numeroserie'];

        $resultnums = DB::table('num_series')
            ->whereRaw("numS COLLATE SQL_Latin1_General_CP1_CS_AS = '$valueToChecknums'")
            ->exists();



           // dd($resultcode);

        //    $numser="crayon-2230002";
        //    $codear="crayon-2";


        //    $ccode = substr($numser,0, strlen($codear)); //codea dans nums
        //    $y1 = substr($numser,-6); // 6 derniers carac de nums


        //    $t1=is_int(intval($y1)); // 6 derniers carac sont des entiers

        //    $t2=($ccode==$codear);

        //    $t3=($codear.$y1==$numser);

        //    dd($t1);


        if($resultcode && !$resultnums){ //si nums absent mais codea present 

            $numser=$row['numeroserie'];
            $codear=$row['codearticle'];


            $ccode = substr($numser,0, strlen($codear)); //codea dans nums
            $y1 = substr($numser,-6); // 6 derniers carac de nums
            $y2 = substr($numser,-4); 


            $t3=intval($y1)==$y1; // 6 derniers carac sont des entiers

            $t1=($ccode==$codear);

            $t2=($codear.$y1==$numser); // test de long de nums

            $t4=("23".$y2 == $y1);// format 23xxxx
            
            //dump('ok');

            if($t3 && $t1 && $t2 && $t4)
            {
                $ida=$b->ida;
                $codea=$b->code;
                //dd('super');
    
                 return num_series::create(
                    ['numS' => $row['numeroserie'],
                'article_id' => $ida,
                'user_id' => 2,  ]
                 );

            }else{
                //dd('oog');
                //return redirect()->route('index')->with('success', 'Opéation rréussie.');


            }



          

          

        }
           
    //    else{
    //     dd('mine');
    //     return redirect()->route('index')->with('success', 'Opéation rréussie.');
    //    }
       




}
}
