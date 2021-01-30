<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perveiw extends Model
{
    protected $table = 'preveiw';
    protected $primaryKey = 'pk_preveiw_id';
    protected $fillable = [
        'fk_quote_id',
        'perveiw_html'
    ];

    public function quotes()
    {
        return $this->hasMany(Quote::class, 'fk_preveiw_id', 'pk_preveiw_id');
    }


}
