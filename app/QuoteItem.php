<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuoteItem extends Model
{
    protected $table = 'quoteitem';
    protected $primaryKey = 'pk_quotes_item_id';
    protected $fillable = [
            'fk_quote_id', 
            'fk_item_has_materails_id'
        ];
}


// Relationships to be added:

// One-to-Many:
// QuoteItemMaterial

// Many-to-One:
// Quote
// Product