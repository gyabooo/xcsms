<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    public function certificate_service()
    {
        return $this->belongsTo('App\Models\CertificateService');
    }

    public function common_name()
    {
        return $this->belongsTo('App\Models\CommonName');
    }

    public function current_certificate()
    {
        return $this->hasOne('App\Models\CurrentCertificate');
    }
}
