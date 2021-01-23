<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perveiw extends Model
{
    protected $table = 'perveiw';
    protected $primaryKey = 'pk_perveiw_id';
    protected $fillable = [
        'fk_quote_id',
        'fk_perpoint_id',
        'perveiw_html'
    ];

    public function quotes()
    {
        return $this->hasMany('App\Quote', 'fk_preveiw_id', 'pk_preveiw_id');
    }


}
