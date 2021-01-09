<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $table = 'itemsubcategories';
    protected $primaryKey = 'pk_subcategory_id';
    protected $fillable = [
            'subcategory_name', 
            'fk_category_id',
            'subcategory_archived'
        ];

    public function categories()
    {
        return $this->belongsTo(Category::class, 'fk_category_id');
    }


    public function items()
    {
        return $this->hasMany(Items::class, 'fk_subcategory_id');
    }

    public function priceLists()
    {
        return $this->hasMany('App\PriceList', 'fk_subcategory_id', 'pk_subcategory_id');
    }

}
