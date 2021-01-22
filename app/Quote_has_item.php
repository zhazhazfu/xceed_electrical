<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quote_has_item extends Model
{
    protected $table = 'quote_has_items';
    protected $primaryKey = 'pk_quote_has_item_id ';
    protected $fillable = [
            'fk_quote_id ', 
            'fk_item_id '
        ];

    public function quotes()
    {
        return $this->belongsTo(Quote::class);
    }
}