<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
// use App\Rules\CertificateFiles;
use App\Rules\CertificateFile;

class UpdateCertificatesRequest extends ApiRequest
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
            'is_symlink' => ['required', 'in:true,false'],
            'files.*' => ['file', new CertificateFile],
            // 'files' => [new CertificateFiles]
        ];
    }
}
