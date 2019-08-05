<?php

namespace App\Entities;

use ArrayObject;

class Virtualdomain
{
  private $id;
  private $name;
  private $CommonNameList;

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

  public function set_commonname_list(CommonNameList $CommonNameList)
  {
    $this->CommonNameList = $CommonNameList;
  }

  public function get_commonname_list()
  {
    return $this->CommonNameList;
  }
}
