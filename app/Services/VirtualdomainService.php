<?php

namespace App\Services;

/**
 * VirtualdomainService class
 * 
 * バーチャルドメインエンティティで利用するクラス
 * 
 * @author seita_matsumoto <gyabooo@gmail.com>
 */
class VirtualdomainService
{
  protected $VirtualdomainDataAccess;

  public function __construct(VirtualdomainDataAccess $VirtualdomainDataAccess)
  {
    $this->VirtualdomainDataAccess = $VirtualdomainDataAccess;
  }

  public function get_all ()
  {
    return $this->VirtualdomainDataAccess->get_all();
  }

}