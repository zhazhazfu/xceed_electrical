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
            'fk_user_id', //new
            'fk_term_id',
            'fk_in_id', //new
            'fk_ex_id', //new
            'quote_number',
            'quote_status', //new
            'quote_revisionnumber',
            'quote_comment', 
        ];

    public function businessDetails()
    {
        return $this->belongsTo('App\BusinessDetail', 'fk_businessdetail_id', 'pk_businessdetail_id');
    }

    public function customers()
    {
        return $this->belongsTo('App\Customer', 'fk_customer_id', 'pk_customer_id');
    }

    public function Quote_has_item()
    {
        return $this->hasMany(Quote_has_item::class, 'fk_quote_id', 'pk_quote_id');
    }

    // Relationships to be added:

    // One-to-Many:
    // QuoteItem
    
    // Many-to-One:
    // User
    // Status

}
