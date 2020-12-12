<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyCost extends Model
{

    protected $table = 'companycosts';
    protected $primaryKey = 'pk_companycost_id';
    protected $fillable = [
            'companycost_name',
            'companycost_yearly', 
            'companycost_archived'
        ];

}
