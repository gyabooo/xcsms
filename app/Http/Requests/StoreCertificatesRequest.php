<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CertificateFiles;

class StoreCertificatesRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'certificate_service_id' => ['required', 'numeric'],
            // 'files' => ['required', 'file', new CertificateFiles]
            'files' => ['required', new CertificateFiles],
        ];
    }
}
