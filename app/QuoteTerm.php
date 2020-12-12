<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuoteTerm extends Model
{
    protected $table = 'quoteterms';
    protected $primaryKey = 'pk_term_id';
    protected $fillable = [
            'term_name', 
            'term_body',   
            'term_archived'
        ];

}
