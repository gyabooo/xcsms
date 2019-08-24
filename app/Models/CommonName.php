<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commonname extends Model
{
    protected $fillable = ['name', 'virtualdomain_id'];

    public function virtualdomain()
    {
        return $this->belongsTo('App\Models\Virtualdomain');
    }

    public function certificates()
    {
        return $this->hasMany('App\Models\Certificate')->orderBy('expiration_date', 'desc');
    }

    public function current_certificate()
    {
        return $this->hasOne('App\Models\CurrentCertificate');
    }
}
