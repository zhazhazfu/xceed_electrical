<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuoteHasItem extends Model
{
    protected $table = 'quote_has_items';
    protected $primaryKey = 'pk_quote_has_item_id ';
    protected $fillable = [
            'fk_quote_id ', 
            'fk_item_id ',
            'price',
            'GST_price'
        ];

    public function quotes()
    {
        return $this->belongsTo(Quote::class);
    }

    public function items()
    {
        return $this->belongsTo(Items::class);
    }
}