<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CertificateFile implements Rule
{
    private $error_messages;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->error_messages = [];
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
        // dd($value);
        $this->error_messages = [];

        $file_extention = $value->getClientOriginalExtension();
        $content = file_get_contents($value->path());

        /**
         *  @todo CSRアップロード時のバリデーション処理
         */
        if ($file_extention === 'csr') {

        }

        if ($file_extention === 'crt') {
            if (!openssl_x509_parse($content)['validTo_time_t']) {
                $this->error_messages[] = '証明書の有効期限が取得できません';
            }
            if (!preg_match('/-----BEGIN CERTIFICATE-----/', $content) ||
                !preg_match('/-----END CERTIFICATE-----/', $content)) {
                $this->error_messages[] = '証明書の内容が不正です';
            }
        }

        if ($file_extention === 'key') {
            if (!preg_match('/-----BEGIN .* PRIVATE KEY-----/', $content) ||
                !preg_match('/-----END .* PRIVATE KEY-----/', $content)) {
                $this->error_messages[] = '秘密鍵の内容が不正です';
            }
        }

        if ($file_extention === 'pem') {
            if (!preg_match('/-----BEGIN CERTIFICATE-----/', $content) ||
                !preg_match('/-----END CERTIFICATE-----/', $content)) {
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
        return implode(PHP_EOL, $this->error_messages);
    }
}
