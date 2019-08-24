<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CertificateFiles;

class StoreCommonnamesRequest extends ApiRequest
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
            'commonname' => ['required'],
            'virtualdomain_id' => ['required', 'numeric'],
            'certificate_service_id' => ['required', 'numeric'],
            'files' => [new CertificateFiles],
        ];
    }
}
