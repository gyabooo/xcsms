<?php

namespace App\Services;

interface CertificateDataAccess
{
  public function get_commonname_list();
  public function get_commonname_by_id(int $id);
  public function get_certificate_by_id(int $id);
}
