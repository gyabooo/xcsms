<?php

namespace App\Repositories;

use App\Services\VirtualdomainDataAccess;
use App\Models\Virtualdomain as VirtualdomainModel;
use App\Entities\Virtualdomain as VirtualdomainEntity;
use App\Entities\VirtualdomainList as VirtualdomainListEntity;
use Illuminate\Support\Facades\Schema;

class VirtualdomainRepository implements VirtualdomainDataAccess
{
  protected $VirtualdomainModel;
  protected $VirtualdomainListEntity;

  private $connection = 'mysql';

  public function __construct(
    VirtualdomainModel $VirtualdomainModel,
    VirtualdomainListEntity $VirtualdomainListEntity
  )
  {
    $this->VirtualdomainModel = $VirtualdomainModel;
    $this->VirtualdomainListEntity = $VirtualdomainListEntity;
  }

  public function get_all()
  {
    $virtualdomain_models = $this->VirtualdomainModel::on($this->connection)
                                  ->with(['commonnames'])
                                  ->get();

    foreach ($virtualdomain_models as $virtualdomain_model) {

      $virtualdomain_entity = new VirtualdomainEntity(
        $virtualdomain_model->id,
        $virtualdomain_model->name
      );

      $this->VirtualdomainListEntity->add($virtualdomain_entity);
    }

    return $this->VirtualdomainListEntity;
  }

  public function get(int $id)
  {
    return 'test';
  }

  public function store(...$data)
  {
    return '';
  }

  public function update(...$data)
  {
    return '';
  }

  public function destroy(int $id)
  {
    return 'test';
  }
}
