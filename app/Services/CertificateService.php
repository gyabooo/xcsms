<?php

namespace App\Services;

/**
 * CertificateService class
 * 
 * 証明書関連で利用するメソッド
 * 
 * @author seita_matsumoto <gyabooo@gmail.com>
 */
class CertificateService
{
  protected $CertificateDataAccess;

  public function __construct(CertificateDataAccess $CertificateDataAccess)
  {
    $this->CertificateDataAccess = $CertificateDataAccess;
  }

  # commonname method 
  public function get_commonname_list()
  {
    return $this->CertificateDataAccess->get_commonname_list();
  }

  public function get_commonname_by_id(int $id)
  {
    return $this->CertificateDataAccess->get_commonname_by_id($id);
  }

  public function store_commonname(string $commonname, int $virtualdomain_id)
  {
    return $this->CertificateDataAccess->store_commonname($commonname, $virtualdomain_id);
  }

  public function update_commonname(int $commonname_id, int $virtualdomain_id, string $commonname)
  {
    $this->CertificateDataAccess->update_commonname($commonname_id, $virtualdomain_id, $commonname);
  }

  public function destroy_commonname_by_id(int $commonname_id)
  {
    $this->CertificateDataAccess->destroy_commonname_by_id($commonname_id);
  }

  # certificate method 
  public function get_certificate_by_id(int $id)
  {
    $certificate = $this->CertificateDataAccess->get_certificate_by_id($id);
    
    return $this->CertificateDataAccess->get_certificate_by_id($id);
  }

  public function store_certificate(
    string $is_symlink = null,
    string $expiration_date = null,
    string $csr = null,
    string $crt = null,
    string $cacert = null,
    string $key = null,
    string $save_dir_path = null,
    int $certificate_service_id = null,
    int $commonname_id = null
  )
  {
    return $this->CertificateDataAccess->store_certificate(
      $is_symlink,
      $expiration_date,
      $csr,
      $crt,
      $cacert,
      $key,
      $save_dir_path,
      $certificate_service_id,
      $commonname_id
    );
  }

  public function store_certificate_with_files(
    int $certificate_service_id,
    int $commonname_id,
    ?array $files
  )
  {
    return $this->CertificateDataAccess->store_certificate_with_files(
      $certificate_service_id,
      $commonname_id,
      $files
    );
  }

  public function update_certificate_with_files(
    int $certificate_id,
    int $certificate_service_id,
    int $commonname_id,
    ?array $files
  ) 
  {
    return $this->CertificateDataAccess->update_certificate_with_files(
      $certificate_id,
      $certificate_service_id,
      $commonname_id,
      $files
    );
  }

  public function destroy_certificate_by_id(int $certificate_id)
  {
    $this->CertificateDataAccess->destroy_certificate_by_id($certificate_id);
  }

  # virtualdomain method
  public function get_virtualdomain_list()
  {
    return $this->CertificateDataAccess->get_virtualdomain_list();
  }

  public function get_virtualdomain_by_id(int $id)
  {
    return $this->CertificateDataAccess->get_virtualdomain_by_id($id);
  }

  public function get_virtualdomain_list_with_selected(int $id)
  {
    $new_list = array();
    $list = $this->get_virtualdomain_list();
    $select = $this->get_virtualdomain_by_id($id);

    foreach ($list as $data) {
      if ($data->get_id() === $select->get_id()) {
        $new_list[] = ['selected' => true, 'value' => $data];
      } else {
        $new_list[] = ['selected' => false, 'value' => $data];
      }
    }
    return $new_list;
  }

  # certificate_service method
  public function get_certificate_service_list()
  {
    return $this->CertificateDataAccess->get_certificate_service_list();
  }

  public function get_certificate_service_list_with_selected(int $id)
  {
    $new_list = array();
    $list = $this->get_certificate_service_list();
    $select = $this->get_certificate_service_by_id($id);

    foreach ($list as $data) {
      if ($data->get_id() === $select->get_id()) {
        $new_list[] = ['selected' => true, 'service' => $data];
      }
      else {
        $new_list[] = ['selected' => false, 'service' => $data];
      }
    }
    return $new_list;
  }

  public function get_certificate_service_by_id(int $id)
  {
    return $this->CertificateDataAccess->get_certificate_service_by_id($id);
  }

  # current_service methods
  public function update_or_create_current_certificate(
    int $commonname_id,
    int $certificate_id,
    string $is_symlink
  )
  {
    $this->CertificateDataAccess->update_or_create_current_certificate($commonname_id, $certificate_id, $is_symlink);
  }

}
