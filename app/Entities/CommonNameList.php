<?php

namespace App\Entities;

class CommonNameList implements \IteratorAggregate
{
  private $CommonNameList;

  public function __construct()
  {
    $this->CommonNameList = new \ArrayObject();
  }

  public function add(CommonName $CommonName)
  {
    $this->CommonNameList[] = $CommonName;
  }

  public function getIterator(): \ArrayIterator
  {
    return $this->CommonNameList->getIterator();
  }
}
