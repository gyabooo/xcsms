<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $fillable = [
        "id",
        "expiration_date",
        "csr",
        "cacert",
        "crt",
        "key",
        "save_dir_path",
        "certificate_service_id",
        "commonname_id",
    ];

    public function certificate_service()
    {
        return $this->belongsTo('App\Models\CertificateService');
    }

    public function commonname()
    {
        return $this->belongsTo('App\Models\Commonname');
    }

    public function current_certificate()
    {
        return $this->hasOne('App\Models\CurrentCertificate');
    }
}
