<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use App\Services\CertificateService;

class CertificateResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
        // $commonname_list = $this->CertificateService->getCommonNameList();
        // return [
        //     data => $commonname_list->getIterator(),
        // ];
    }
}
