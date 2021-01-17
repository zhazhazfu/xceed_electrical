<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemHasMaterials extends Model
{
    protected $table = 'item_has_materials';
    protected $primaryKey = 'pk_item_has_materails_id';
    protected $fillable = [
            'fk_item_id', 
            'fk_material_id',
            'quantity'
        ];

    public function items()
    {
        return $this->belongsTo(Items::class,'fk_item_id','pk_item_id');
    }

    public function material()
    {
        return $this->belongsTo(Material::class,'fk_material_id');
    }
}



