<?php

namespace App\Services;

interface VirtualdomainDataAccess extends BaseDataAccess
{
    public function store(...$data);
    public function update(...$data);
}