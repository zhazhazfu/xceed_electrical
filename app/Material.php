<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $table = 'materials';
    protected $primaryKey = 'pk_material_id';
    protected $fillable = [
        'fk_supplier_id',
        'material_itemcode',
        'material_description',
        'material_cost',
        'material_archived'
    ];

    public function suppliers()
    {
        return $this->belongsTo(Supplier::class, 'fk_supplier_id');
    }

    public function itemHasMaterials()
    {
        return $this->hasMany(ItemHasMaterials::class, 'fk_material_id');
    }

    public function priceLists()
    {
        return $this->hasMany('App\PriceList', 'fk_material_id', 'pk_material_id');
    }
}
