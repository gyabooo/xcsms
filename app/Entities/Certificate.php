<?php

namespace App\Entities;

// use App\Services\CertificateService;

class Certificate
{
  private $id;
  private $expiration_date;
  private $save_dir_path;
  private $csr;
  private $crt;
  private $cacert;
  private $key;
  private $service;
  private $symlink;
  private $certificate;
  private $virtualdomain;

  public function __construct(
    int $id,
    ?string $expiration_date,
    ?string $save_dir_path,
    ?string $csr,
    ?string $crt,
    ?string $cacert,
    ?string $key,
    ?CertificateService $service,
    ?bool $symlink = false
  )
  {
    $this->id = $id;
    $this->expiration_date = $expiration_date;
    $this->save_dir_path = $save_dir_path;
    $this->csr = $csr;
    $this->crt = $crt;
    $this->key = $key;
    $this->cacert = $cacert;
    $this->service = $service;
    $this->symlink = $symlink;
  }

  public function get_id(): int
  {
    return $this->id;
  }

  public function get_expiration_date()
  {
    return $this->expiration_date;
  }

  public function get_save_dir_path()
  {
    return $this->save_dir_path;
  }

  public function get_csr()
  {
    return $this->csr;
  }

  public function get_crt()
  {
    return $this->crt;
  }

  public function get_key()
  {
    return $this->key;
  }

  public function get_cacert()
  {
    return $this->cacert;
  }

  public function set_service(CertificateService $certificate_service)
  {
    $this->service = $certificate_service;
  }

  public function get_service(): ?CertificateService
  {
    return $this->service;
  }

  public function get_symlink(): ?bool
  {
    return $this->symlink;
  }

  public function set_commonname(CommonName $commonname)
  {
    $this->commonname = $commonname;
  }

  public function get_commonname(): CommonName
  {
    return $this->commonname;
  }

  public function set_virtualdomain(Virtualdomain $virtualdomain)
  {
    $this->virtualdomain = $virtualdomain;
  }

  public function get_virtualdomain(): Virtualdomain
  {
    return $this->virtualdomain;
  }

  public function toArray()
  {
    // $virtualdomain_array = $this->get_virtualdomain()->toArray();
    // $commonname_array = $this->get_commonname()->toArray();
    $certificate_array = get_object_vars($this);

    // $certificate_array['virtualdomain'] = $virtualdomain_array;
    // $certificate_array['commonname'] = $commonname_array;

    return $certificate_array;
  }
}