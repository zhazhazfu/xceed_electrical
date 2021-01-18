<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    protected $table = 'items';
    protected $primaryKey = 'pk_item_id';
    protected $fillable = [
            'fk_subcategory_id', 
            'item_number',
            'item_jobtype',
            'item_description',
            'item_estimatedtime',
            'item_servicecall',
            'item_archived'
        ];

    public function subcategories()
    {
        return $this->belongsTo(SubCategory::class, 'fk_subcategory_id');
    }

    public function itemHasMaterials()
    {
        return $this->hasMany(ItemHasMaterials::class, 'fk_item_id', 'pk_item_id');
    }

    public function Quote_has_item()
    {
        return $this->hasMany(Quote_has_item::class, 'fk_item_id', 'pk_item_id');
    }
}