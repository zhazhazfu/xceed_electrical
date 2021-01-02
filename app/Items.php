<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    protected $table = 'items';
    protected $primaryKey = 'pk_item_id';
    protected $fillable = [
            'fk_category_id', 
            'item',
            'item_number',
            'item_jobtype',
            'item_description',
            'item_estimatedtime',
            'item_servicecall',
            'item_labourcost'
        ];
}


// Relationships to be added:

// One-to-Many:
// QuoteItemMaterial

// Many-to-One:
// Quote
// Product