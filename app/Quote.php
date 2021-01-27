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
            'fk_prefix_id', //new
            'quote_number',
            'quote_status', //new
            'quote_comment',
        ];

    public function businessDetails()
    {
        return $this->belongsTo(BusinessDetail::class, 'fk_businessdetail_id');
    }

    public function customers()
    {
        return $this->belongsTo(Customer::class, 'fk_customer_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'fk_user_id');
    }

    public function quoteterms()
    {
        return $this->belongsTo(QuoteTerm::class,'fk_term_id');
    }

    public function inclusions()
    {
        return $this->belongsTo(Inclusions::class, 'fk_customer_id');
    }

    public function exclusions()
    {
        return $this->belongsTo(Exclusions::class, 'fk_customer_id');
    }

    public function prefix()
    {
        return $this->belongsTo(Prefix::class, 'fk_prefix_id');
    }

    public function quotehasitem()
    {
        return $this->hasMany(QuoteHasItem::class, 'fk_quote_id', 'pk_quote_id');
    }

    

    // public function series()
    // {
    //     return $date->format('d-m-y H:i:s');
    // }

    // Relationships to be added:

    // One-to-Many:
    // QuoteItem
    
    // Many-to-One:
    // User
    // Status

    public static function boot()
    {
        parent::boot();

        static::creating(function($model){
            $model->quote_number = Quote::where('fk_prefix_id', $model->fk_prefix_id)->max('quote_number') + 1;
        });
    }

}
