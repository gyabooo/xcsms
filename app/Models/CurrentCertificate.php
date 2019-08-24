<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CurrentCertificate extends Model
{
    protected $fillable = ['commonname_id', 'certificate_id'];

    public function commonname()
    {
        return $this->belongsTo('App\Models\Commonname');
    }

    public function certificate()
    {
        return $this->belongsTo('App\Models\Certificate');
    }
}
