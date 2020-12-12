<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{

    protected $table = 'customers';
    protected $primaryKey = 'pk_customer_id';
    protected $fillable = [
            'customer_name', 
            'customer_company', 
            'customer_phone',
            'customer_email', 
            'customer_address', 
            'fk_discount_id',
            'customer_archived'
        ];

    public function discount()
    {
        return $this->belongsTo('App\Discount', 'fk_discount_id', 'pk_discount_id');
    }

    public function quotes()
    {
        return $this->hasMany('App\Quote', 'fk_customer_id', 'pk_customer_id');
    }
}
