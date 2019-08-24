<?php

namespace App\Entities;

class CertificateServiceList implements \IteratorAggregate
{
  private $CertificateServiceList;

  public function __construct()
  {
    $this->CertificateServiceList = new \ArrayObject();
  }

  public function add(CertificateService $CertificateService)
  {
    $this->CertificateServiceList[] = $CertificateService;
  }

  public function getIterator(): \ArrayIterator
  {
    return $this->CertificateServiceList->getIterator();
  }
}
