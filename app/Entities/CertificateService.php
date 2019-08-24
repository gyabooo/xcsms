<?php

namespace App\Entities;


class CertificateService
{
  private $id;
  private $name;

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

  public function toArray()
  {
    return get_object_vars($this);
  }
}
