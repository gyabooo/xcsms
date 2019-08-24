<?php

namespace App\Entities;

class CommonnameList implements \IteratorAggregate
{
  private $CommonnameList;

  public function __construct()
  {
    $this->CommonnameList = new \ArrayObject();
  }

  public function add(Commonname $Commonname)
  {
    $this->CommonnameList[] = $Commonname;
  }

  public function getIterator(): \ArrayIterator
  {
    return $this->CommonnameList->getIterator();
  }
}
