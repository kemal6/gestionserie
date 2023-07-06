<?php

namespace App\Imports;

use App\Models\num_series;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportNums implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new num_series([
            //
            'numS' => $row[0],
            'article_id' => $row[1],
            'user_id' => $row[2],        ]);
    }
}
