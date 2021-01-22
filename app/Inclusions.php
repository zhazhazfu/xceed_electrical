<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inclusions extends Model
{
    protected $table = 'inclusions';
    protected $primaryKey = 'pk_in_id';
    protected $fillable = [
            'inclusion_name',
            'inclusion_Content'
        ];
    
    public function quotes()
    {
        return $this->hasMany(Quote::class);
    }
}