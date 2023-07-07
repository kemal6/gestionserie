<?php

namespace App\Exports;

use App\Models\num_series;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class NumsExport implements FromCollection,
WithHeadings
{

    public function collection()
    {


    $nums = DB::table('num_series')->select('numS as Numero_serie', 'created_at as date_creation')->get();

    return $nums;
    }

    public function headings():array
    {
        return [
            'Numero_serie',
            'date_creation',
        ];
    }
}
