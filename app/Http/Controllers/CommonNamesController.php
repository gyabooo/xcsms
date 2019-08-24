<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommonnamesController extends Controller
{

    // protected $Certificate;
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
    public function index()
    {
        $commonname_list = $this->CertificateService->get_commonname_list();
        return view('commonnames.index', ['commonnames' => $commonname_list->getIterator()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $certificate_services = $this->CertificateService->get_certificate_service_list()->getIterator();
        $virtualdomains = $this->CertificateService->get_virtualdomain_list()->getIterator();
        // dd($virtualdomains);
        return view('commonnames.create', compact('certificate_services', 'virtualdomains'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        // dd($request->all());
        $name = $request->input('commonname');
        $id = (int) $request->input('virtualdomain_id');
        $this->CertificateService->store_commonname($name, $id);
        return redirect()->route('commonnames.index');
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
        return view('commonnames.show', ['commonname' => $commonname]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Certificate  $certificate
     * @return \Illuminate\Http\Response
     */
    public function edit(int $commonname_id)
    {
        // dd($request);
        $commonname = $this->CertificateService->get_commonname_by_id($commonname_id);
        $virtualdomains = $this->CertificateService->get_virtualdomain_list_with_selected($commonname->get_virtualdomain()->get_id());
        return view('commonnames.edit', compact('commonname', 'virtualdomains'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Certificate  $certificate
     * @return \Illuminate\Http\Response
     */
    public function update(int $commonname_id, Request $request)
    {
        $this->CertificateService->update_commonname(
            $commonname_id,
            (int) $request->virtualdomain_id,
            $request->commonname
        );
        return redirect()->route('commonnames.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Certificate  $certificate
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $commonname_id, Request $request)
    {
        $this->CertificateService->destroy_commonname_by_id($commonname_id);
        return redirect()->route('commonnames.index')->with('flash_message', '削除が完了しました');
    }
}
