<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessDetail extends Model
{
    protected $table = 'businessdetails';
    protected $primaryKey = 'pk_businessdetail_id';
    protected $fillable = [
            'businessdetail_name',
            'businessdetail_addressline1',
            'businessdetail_addressline2',
            'businessdetail_phone',
            'businessdetail_fax', 
            'businessdetail_email',
            'businessdetail_website',
            'businessdetail_archived'
        ];

    public function quotes()
    {
        return $this->hasMany('App\Quote', 'fk_businessdetail_id', 'pk_businessdetail_id');
    }

}
