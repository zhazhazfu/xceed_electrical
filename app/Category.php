<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'itemcategories';
    protected $primaryKey = 'pk_category_id';
    protected $fillable = [
            'category_name', 
            'category_archived'
        ];

    public function subCategories()
    {
        return $this->hasMany('App\SubCategory', 'fk_category_id', 'pk_category_id');
    }

    public function priceLists()
    {
        return $this->hasManyThrough(
            'App\PriceList', 
            'App\SubCategory', 
            'fk_category_id', 
            'fk_subcategory_id',
            'pk_item_id',
            'pk_subcategory_id'
        );
    }

}
