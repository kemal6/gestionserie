<?php

namespace App\Imports;

use App\Models\articles;
use App\Models\num_series;
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
        $r="";

        //foreach($rows as $row ){
             //$r=$r." <-> ".$row['numeroserie'];

        $a= num_series::select('num_series.numS','num_series.id') //Nums de serie eqiv dans la bd
        ->where('num_series.numS', '=',$row['numeroserie'])->orderBy('num_series.id')->first();

        
        $b= articles::select('articles.code as code','articles.id as ida') //codea equiv dans la bd
        ->where('articles.code', '=',$row['codearticle'])->orderBy('articles.id')->first();


        //dd($row);


        if(isset($b) && !isset($a)){ //si nums absent mais codea present 


            $ida=$b->ida;
            $codea=$b->code;
            //dd('super');

             return num_series::create(
                ['numS' => $row['numeroserie'],
            'article_id' => $ida,
            'user_id' => 2,  ]
             );

        }


        
           
       // }
       




}
}
