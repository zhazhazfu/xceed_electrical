<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PriceList extends Model
{
    protected $table = 'items';
    protected $primaryKey = 'pk_item_id';
    protected $fillable = [
        'item_number',
        'item_jobtype',
        'fk_subcategory_id',
        'item_description',
        'fk_material_id',
        'item_estimatedtime',
        'item_servicecall',
        'item_archived'
    ]; 

    public function subCategory()
    {
        return $this->belongsTo('App\SubCategory', 'fk_subcategory_id', 'pk_subcategory_id');
    }

    public function material()
    {
        return $this->belongsTo('App\Material', 'fk_material_id', 'pk_material_id');
    }

}
