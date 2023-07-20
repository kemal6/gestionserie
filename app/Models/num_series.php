<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class num_series extends Model
{
    public $timestamps = true;

    protected $guarded = [];  
    use HasFactory;
    // public function getDateFormat(){
    //     return 'Y-d-m';
    // }
}

