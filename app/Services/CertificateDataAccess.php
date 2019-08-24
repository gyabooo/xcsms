<?php

namespace App\Services;

interface CertificateDataAccess
{
  # commonname methods
  public function get_commonname_list();
  public function get_commonname_by_id(int $id);
  public function store_commonname(string $commonname, int $virtualdomain_id);
  public function update_commonname(int $commonname_id, int $virtualdomain_id, string $commonname);
  public function destroy_commonname_by_id(int $commonname_id);

  # virtualdomain methods
  public function get_virtualdomain_list();
  public function get_virtualdomain_by_id(int $id);

  # certificate methods
  public function get_certificate_by_id(int $id);
  public function store_certificate(
    string $is_symlink = null,
    string $expiration_date = null,
    string $csr = null,
    string $crt = null,
    string $cacert = null,
    string $key = null,
    int $certificate_service_id = null,
    int $commonname_id = null
  );
  public function store_certificate_with_files(
    int $certificate_service_id,
    int $commonname_id,
    array $files
  );
  public function update_certificate_with_files(
    int $certificate_id,
    int $certificate_service_id,
    int $commonname_id,
    array $files
  );
  public function destroy_certificate_by_id(
    int $certificate_id
  );
  
  # certificate service methods
  public function get_certificate_service_list();
  public function get_certificate_service_by_id(int $id);

  # current_certificate methods
  public function update_or_create_current_certificate(
    int $commonname_id,
    int $certificate_id,
    string $is_symlink
  );
}
