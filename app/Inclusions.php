<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inclusions extends Model
{
    protected $table = 'inclusions';
    protected $primaryKey = 'pk_in_id';
    protected $fillable = [
            'inclusion_Content'
        ];
}


// Relationships to be added:

// One-to-Many:
// QuoteItemMaterial

// Many-to-One:
// Quote
// Product