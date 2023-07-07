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


        if($resultcode && !$resultnums){ //si nums absent mais codea present 


            $ida=$b->ida;
            $codea=$b->code;
            //dd('super');

             return num_series::create(
                ['numS' => $row['numeroserie'],
            'article_id' => $ida,
            'user_id' => 2,  ]
             );

        }


        
           
       else{
        return redirect()->route('index')->with('success', 'Opéation rréussie.');
       }
       




}
}
