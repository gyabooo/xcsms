<?php

namespace App\Entities;

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
    string $expiration_date,
    string $save_dir_path,
    string $csr,
    string $crt,
    string $cacert,
    string $key,
    string $service,
    bool $symlink = false
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

  public function get_expiration_date(): string
  {
    return $this->expiration_date;
  }

  public function get_save_dir_path(): string
  {
    return $this->save_dir_path;
  }

  public function get_csr(): string
  {
    return $this->csr;
  }

  public function get_crt(): string
  {
    return $this->crt;
  }

  public function get_key(): string
  {
    return $this->key;
  }

  public function get_cacert(): string
  {
    return $this->cacert;
  }

  public function get_service(): string
  {
    return $this->service;
  }

  public function get_symlink(): bool
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
    return get_object_vars($this);
  }
}