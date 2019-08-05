<?php

namespace App\Services;

class CertificateService
{
  protected $CertificateDataAccess;

  public function __construct(CertificateDataAccess $CertificateDataAccess)
  {
    $this->CertificateDataAccess = $CertificateDataAccess;
  }

  public function get_commonname_list()
  {
    return $this->CertificateDataAccess->get_commonname_list();
  }

  public function get_commonname_by_id(int $id)
  {
    return $this->CertificateDataAccess->get_commonname_by_id($id);
  }
  public function get_certificate_by_id(int $id)
  {
    $certificate = $this->CertificateDataAccess->get_certificate_by_id($id);
    
    return $this->CertificateDataAccess->get_certificate_by_id($id);
  }
}
