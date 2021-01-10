<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuoteHasItems extends Model
{
    protected $table = 'quote_has_items';
    protected $primaryKey = 'pk_quote_item_id';
    protected $fillable = [
            'fk_quote_id', 
            'fk_item_has_materials_id'
        ];

    public function Quotes()
    {
        return $this->hasMany(Items::class,'fk_quote_id');
    }

    public function itemHasMaterials()
    {
        return $this->hasMany(ItemHasMaterials::class, 'fk_item_has_materials_id');
    }

    
}



