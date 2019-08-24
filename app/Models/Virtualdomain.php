<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Virtualdomain extends Model
{
    // protected $fillable = ['id', 'name'];

    public function commonnames()
    {
        return $this->hasMany('App\Models\Commonname');
    }
}
