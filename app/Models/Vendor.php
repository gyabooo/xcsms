<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    public function certificate_services()
    {
        return $this->hasMany('App\Models\CertificateService');
    }
}
