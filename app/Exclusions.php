<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exclusions extends Model
{
    protected $table = 'exclusions';
    protected $primaryKey = 'pk_ex_id';
    protected $fillable = [
            'exclusion_Content',    
        ];
}


// Relationships to be added:

// One-to-Many:
// QuoteItemMaterial

// Many-to-One:
// Quote
// Product