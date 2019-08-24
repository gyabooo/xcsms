<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CertificateFiles implements Rule
{
    private $error_messages = [];
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->$error_messages = [];
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $csr = $crt = $pem = $key = [];

        // dd($value);
        foreach ($value as $file) {
            $file_extention = $file->getClientOriginalExtension();
            ${$file_extention}['filename'] = $file->getClientOriginalName();
            ${$file_extention}['content'] = file_get_contents($file->path());
        }

        /**
         *  @todo CSRアップロード時のバリデーション処理
         */
        // if ($csr) {

        // }

        if (!empty($crt)) {
            if (!openssl_x509_parse($crt['content'])['validTo_time_t']) {
                $this->error_messages[] = '証明書の有効期限が取得できません';
            }
            if (!preg_match('/-----BEGIN CERTIFICATE-----/', $crt['content']) ||
                !preg_match('/-----END CERTIFICATE-----/', $crt['content'])) {
                $this->error_messages[] = '証明書の内容が不正です';
            }
        }

        if (!empty($key)) {
            if (!preg_match('/^-----BEGIN .* PRIVATE KEY-----/', $key['content']) ||
                !preg_match('/-----END .* PRIVATE KEY-----/', $key['content'])) {
                $this->error_messages[] = '秘密鍵の内容が不正です';
            }
        }

        if (!empty($pem)) {
            if (!preg_match('/^-----BEGIN CERTIFICATE-----/', $pem['content']) ||
                !preg_match('/-----END CERTIFICATE-----/', $pem['content'])) {
                $this->error_messages[] = '中間証明書の内容が不正です';
            }
        }

        return empty($this->error_messages);

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        // return implode(PHP_EOL, $this->error_messages);
        return $this->error_messages;
    }
}
