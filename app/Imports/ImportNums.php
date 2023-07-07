<?php

namespace App\Imports;

use App\Models\articles;
use App\Models\num_series;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ImportNums implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)

    {


        $a= num_series::select('num_series.numS','num_series.id') //dernier nums de cet art generer
        ->where('num_series.numS', '=',$row[0])->orderBy('num_series.id')->first();

       
    
        // $codens=$row[0];
        // $t = strlen($codens)-4;

        // $codea=substr($codens,0,$t);

        //$codea=$row[1];

        $b= articles::select('articles.code as code','articles.id as ida') //dernier nums de cet art generer
        ->where('articles.code', '=',$row[1])->orderBy('articles.id')->first();

        // $c= articles::select('articles.code as code','articles.id') //dernier nums de cet art generer
        // ->where('articles.code', '=',$codea)->orderBy('articles.id')->first();

        // // $d=$b->code;
        // $e=$b->idea;


     if(isset($b) && !isset($a)){


        return new num_series([
            //

            'numS' => $row[0],
            'article_id' => $row[1],
            'user_id' => 2,        ]);

     }


}
}
