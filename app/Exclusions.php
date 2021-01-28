<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exclusions extends Model
{
    protected $table = 'exclusions';
    protected $primaryKey = 'pk_ex_id';
    protected $fillable = [
            'exclusion_name',
            'exclusion_Content'  
        ];

    // public function quotes()
    // {
    //     return $this->hasMany(Quote::class);
    // }
}