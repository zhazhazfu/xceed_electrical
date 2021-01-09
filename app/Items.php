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
            'item_labourcost'
        ];

    public function subcategories()
    {
        return $this->belongsTo('App\subCategory', 'fk_subcategory_id', 'pk_subcategory_id');
    }
}