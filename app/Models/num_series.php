<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class num_series extends Model
{
    protected $guarded = [];  
    use HasFactory;
    public function getDateFormat(){
        return 'Y-d-m H:i:s.v';
    }
}

