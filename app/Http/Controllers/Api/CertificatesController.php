<?php

namespace App\Http\Controllers\Api;

use App\Services\CertificateService;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCertificatesRequest;
use App\Http\Requests\UpdateCertificatesRequest;

class CertificatesController extends Controller
{

    private $CertificateService;

    public function __construct(CertificateService $CertificateService)
    {
        $this->CertificateService = $CertificateService;
    }

    public function store(int $commonname_id, StoreCertificatesRequest $request)
    {
        $certificate_entity = $this->CertificateService->store_certificate_with_files(
            $request->certificate_service_id,
            $commonname_id,
            $request->file('files')
        );

        $redirect_url = route(
            'commonnames.certificates.edit',
            ['commonname' => $commonname_id, 'certificate' => $certificate_entity->get_id()]
        );

        return response()->json([
            'location_href' => $redirect_url,
        ]);
    }

    public function update(int $commonname_id, int $certificate_id, UpdateCertificatesRequest $request)
    {
        $post_data = $request->except('_token', '_method');
        $is_symlink = $post_data['is_symlink'];
        $certificate_service_id = $post_data['certificate_service_id'];

        $this->CertificateService->update_certificate_with_files(
            $certificate_id,
            $certificate_service_id,
            $commonname_id,
            $request->file('files')
        );

        $this->CertificateService->update_or_create_current_certificate(
            $commonname_id,
            $certificate_id,
            $is_symlink
        );

        $redirect_url = route(
            'commonnames.show',
            ['commonname' => $commonname_id]
        );
        
        return response()->json([
            'location_href' => $redirect_url,
        ]);
    }
}
