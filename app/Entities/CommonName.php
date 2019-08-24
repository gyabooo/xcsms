<?php

namespace App\Entities;


class Commonname
{
  private $id;
  private $name;
  private $virtualdomain;
  private $expiration_date;
  private $service;
  private $CertificateList;

  public function __construct(int $id, string $name)
  {
    $this->id = $id;
    $this->name = $name;
  }

  public function get_id(): int
  {
    return $this->id;
  }

  public function get_name(): string
  {
    return $this->name;
  }

  public function set_virtualdomain(Virtualdomain $virtualdomain)
  {
    $this->virtualdomain = $virtualdomain;
  }

  public function get_virtualdomain(): Virtualdomain
  {
    return $this->virtualdomain;
  }

  public function set_expiration_date(string $expiration_date)
  {
    $this->expiration_date = $expiration_date;
  }

  public function get_expiration_date()
  {
    return $this->expiration_date;
  }

  public function set_service(string $service)
  {
    $this->service = $service;
  }

  public function set_certificate_list(CertificateList $CertificateList)
  {
    $this->CertificateList = $CertificateList;
  }

  public function get_certificate_list()
  {
    return $this->CertificateList;
  }

  public function toArray()
  {
    return get_object_vars($this);
  }
}
