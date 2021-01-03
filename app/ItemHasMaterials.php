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

    public function items()
    {
        return $this->belongsTo('App\Items', 'fk_item_id', 'pk_item_id');
    }

    public function material()
    {
        return $this->belongsTo('App\Material', 'fk_material_id', 'pk_material_id');
    }
}



