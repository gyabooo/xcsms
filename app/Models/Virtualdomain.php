<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Virtualdomain extends Model
{
    public function common_names()
    {
        return $this->hasMany('App\Models\CommonName');
    }
}
