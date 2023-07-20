<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class users extends Model
{
    public $timestamps = true;
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
    protected $guarded = [];  
    

    public function getDateFormat(){
        return 'Y-d-m H:i:s.v';
    }

    
}
