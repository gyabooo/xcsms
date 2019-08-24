<?php

namespace App\Entities;

class Virtualdomain
{
  private $id;
  private $name;
  private $CommonnameList;

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

  public function set_commonname_list(CommonnameList $CommonnameList)
  {
    $this->CommonnameList = $CommonnameList;
  }

  public function get_commonname_list()
  {
    return $this->CommonnameList;
  }

  public function toArray()
  {
    // $commonname_list = $this->get_commonname_list()->getIterator()->toArray();
    $virtualdomain_array = get_object_vars($this);
    // $virtualdomain_array['CommonnameList'] = $commonname_list;
    return $virtualdomain_array;
  }
}
