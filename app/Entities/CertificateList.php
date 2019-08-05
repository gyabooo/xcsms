<?php

namespace App\Entities;

class CertificateList implements \IteratorAggregate
{
  private $CertificateList;

  public function __construct()
  {
    $this->CertificateList = new \ArrayObject();
  }

  public function add(Certificate $Certificate)
  {
    $this->CertificateList[] = $Certificate;
  }

  public function getIterator(): \ArrayIterator
  {
    return $this->CertificateList->getIterator();
  }
}
