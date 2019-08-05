<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CertificateService extends Model
{
    public function vendor()
    {
        return $this->belongsTo('App\Models\Vendor');
    }

    public function certificates()
    {
        return $this->hasMany('App\Models\Certificate');
    }
}
