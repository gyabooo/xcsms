<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CurrentCertificate extends Model
{
    public function common_name()
    {
        return $this->belongsTo('App\Models\CommonName');
    }

    public function certificate()
    {
        return $this->belongsTo('App\Models\Certificate');
    }
}
