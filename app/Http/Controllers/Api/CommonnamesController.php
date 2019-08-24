<?php

namespace App\Http\Controllers\Api;

use App\Services\CertificateService;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommonnamesRequest;

class CommonnamesController extends Controller
{

  private $CertificateService;

  public function __construct(CertificateService $CertificateService)
  {
    $this->CertificateService = $CertificateService;
  }

  public function store(StoreCommonnamesRequest $request)
  {
    $commonname = $request->commonname;
    $virtualdomain_id = (int) $request->virtualdomain_id;
    $commonname_entity = $this->CertificateService->store_commonname($commonname, $virtualdomain_id);

    $certificate_entity = $this->CertificateService->store_certificate_with_files(
      $request->certificate_service_id,
      $commonname_entity->get_id(),
      $request->file('files')
    );

    $redirect_url = route(
      'commonnames.certificates.edit',
      ['commonname' => $commonname_entity->get_id(), 'certificate' => $certificate_entity->get_id()]
    );

    return response()->json([
      'location_href' => $redirect_url,
    ]);
  }
}
