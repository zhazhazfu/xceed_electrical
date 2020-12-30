<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemHasMaterials extends Model
{
    protected $table = 'items_has_materials';
    protected $primaryKey = 'pk_item_has_materails_id';
    protected $fillable = [
            'fk_item_id', 
            'fk_material_id'
        ];
}


// Relationships to be added:

// One-to-Many:
// QuoteItemMaterial

// Many-to-One:
// Quote
// Product