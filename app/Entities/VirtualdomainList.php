<?php

namespace App\Entities;

class VirtualdomainList implements \IteratorAggregate
{
  private $VirtualdomainList;

  public function __construct()
  {
    $this->VirtualdomainList = new \ArrayObject();
  }

  public function add(Virtualdomain $Virtualdomain)
  {
    $this->VirtualdomainList[] = $Virtualdomain;
  }

  public function getIterator(): \ArrayIterator
  {
    return $this->VirtualdomainList->getIterator();
  }
}
