<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuoteItemMaterial extends Model
{
    protected $table = 'quoteitematerial';
    protected $primaryKey = 'pk_item_has_materails_id';
    protected $fillable = [
            'fk_item_id', 
            'fk_material_id'
        ];
}

/* public function item()
{
    return $this->belongsTo('App\SubCategory', 'fk_item_id', );
}

public function itemHasMaterial()
{
    return $this->belongsTo('App\Material', 'fk_material_id', 'pk_material_id');
}

// Relationships to be added:

// Many-to-One:
// QuoteItem
// Materials
