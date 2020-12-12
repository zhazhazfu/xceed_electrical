<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    protected $table = 'quotes';
    protected $primaryKey = 'pk_quote_id';
    protected $fillable = [
            'fk_businessdetail_id',
            'fk_customer_id',
            'fk_quoteitem_id',
            'fk_user_id',
            'fk_status_id', 
            'quote_number',
            'quote_revisionnumber',
            'quote_comment',
            'quote_discountrate',
            'quote_termbody',
        ];

    public function businessDetails()
    {
        return $this->belongsTo('App\BusinessDetail', 'fk_businessdetail_id', 'pk_businessdetail_id');
    }

    public function customers()
    {
        return $this->belongsTo('App\Customer', 'fk_customer_id', 'pk_customer_id');
    }

    // Relationships to be added:

    // One-to-Many:
    // QuoteItem
    
    // Many-to-One:
    // User
    // Status

}
