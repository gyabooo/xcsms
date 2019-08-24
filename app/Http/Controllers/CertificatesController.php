<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CertificatesController extends Controller
{

    // protected $CertificateService;
    private $CertificateService;

    public function __construct()
    {
        $this->CertificateService = resolve('CertificateService');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     $commonname_list = $this->CertificateService->get_commonname_list()->getIterator();
    //     return view('certificates.index', compact('commonname_list'));

    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(int $commonname_id)
    {
        $commonname = $this->CertificateService->get_commonname_by_id($commonname_id);
        $certificate_services = $this->CertificateService->get_certificate_service_list()->getIterator();
        return view('certificates.create', compact('commonname', 'certificate_services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Certificate  $certificate
     * @return \Illuminate\Http\Response
     */
    // public function show(int $commonname_id)
    // {
    //     $commonname = $this->CertificateService->get_commonname_by_id($commonname_id);
    //     return view('certificates.show', ['commonname' => $commonname]);
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Certificate  $certificate
     * @return \Illuminate\Http\Response
     */
    public function edit(int $commonname_id, int $certificate_id)
    {
        $certificate = $this->CertificateService->get_certificate_by_id($certificate_id);
        // dd();
        $certificate_services = $this->CertificateService->get_certificate_service_list_with_selected($certificate->get_service()->get_id());
        
        return view('certificates.edit', compact('commonname_id', 'certificate', 'certificate_services'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Certificate  $certificate
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, string $id)
    // {

    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Certificate  $certificate
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $commonname_id, int $certificate_id)
    {
        $this->CertificateService->destroy_certificate_by_id($certificate_id);
        return redirect()->route('commonnames.show', ['commonname_id' => $commonname_id])->with('flash_message', '証明書の削除が完了しました');
    }
}
