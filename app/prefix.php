<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prefix extends Model
{
    protected $table = 'prefixes';
    protected $primaryKey = 'pk_prefix_id';
    protected $fillable = [
        'prefix_name'
    ];

    public function quotes()
    {
        return $this->hasMany('App\Quote', 'fk_prefix_id', 'pk_prefix_id');
    }
}
