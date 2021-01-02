<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perpointquote extends Model
{
    protected $table = 'perpointquote';
    protected $primaryKey = 'pk_perpoint_id';
    protected $fillable = [
            'fk_user_id',
            'fk_term_id',
            'fk_in_id',
            'fk_ex_id', 
            'fk_customer_id',
            'fk_businessdetail_id',
            'fk_material_id',
            'perpoint_comments',
            'perpoint_number',
            'perpoint_status'
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
