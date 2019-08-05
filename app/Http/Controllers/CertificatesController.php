<?php

namespace App\Http\Controllers;

use App\Models\CommonName;
use Illuminate\Http\Request;
// use App\Repositories\Certificate\CertificateDataAccessRepositoryInterface as CertificateDataAccess;
use App\Services\CertificateService;

class CertificatesController extends Controller
{

    // protected $Certificate;
    private $CertificateService;

    public function __construct(CertificateService $CertificateService)
    {
        $this->CertificateService = $CertificateService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $commonname_list = $this->CertificateService->get_commonname_list();
        return view('certificates.index', ['commonnames' => $commonname_list->getIterator()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Certificate  $certificate
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $commonname = $this->CertificateService->get_commonname_by_id($id);
        // dd($commonname);
        return view('certificates.show', ['commonname' => $commonname]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Certificate  $certificate
     * @return \Illuminate\Http\Response
     */
    public function edit(int $commonname_id, int $certificate_id)
    {
        $certificate = $this->CertificateService->get_certificate_by_id($certificate_id);
        return view('certificates.edit', compact('commonname_id', 'certificate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Certificate  $certificate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $id)
    {
        // dd($id);
        // foreach ($request->file('csr-file') as $key => $value){
        //     dd($value);
        // }
        dd($request->file('csr-file'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Certificate  $certificate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Certificate $certificate)
    {
        //
    }
}
