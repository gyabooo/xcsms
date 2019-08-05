<?php

namespace App\Repositories;

use App\Services\CertificateDataAccess;
use App\Models\CommonName as CommonNameModel;
use App\Models\Certificate as CertificateModel;
use App\Entities\Certificate;
use App\Entities\CertificateList;
use App\Entities\CommonName;
use App\Entities\CommonNameList;
use App\Entities\Virtualdomain;

class CertificateRepository implements CertificateDataAccess
{
  protected $CommonNameModel;
  protected $CertificateModel;
  protected $CommonNameList;

  private $connection = 'mysql';


  public function __construct(
    CommonNameModel $CommonNameModel,
    CertificateModel $CertificateModel,
    CommonNameList $CommonNameList
  )
  {
    $this->CommonNameModel = $CommonNameModel;
    $this->CertificateModel = $CertificateModel;
    $this->CommonNameList = $CommonNameList;
  }


  public function get_commonname_list()
  {
    $commonname_models = $this->CommonNameModel::on($this->connection)
                          ->with(['virtualdomain', 'current_certificate.certificate.certificate_service.vendor'])
                          ->get();

    foreach ($commonname_models as $commonname_model) {
      $commonname = new CommonName(
        $commonname_model->id,
        $commonname_model->name
      );

      $commonname->set_virtualdomain(new Virtualdomain(
        $commonname_model->virtualdomain->id,
        $commonname_model->virtualdomain->name
      ));

      if($commonname_model->current_certificate)
      {
        $cert_model = $commonname_model->current_certificate->certificate;
        $cert_entity = $this->get_cert_entity($cert_model);
        $cert_entity->set_virtualdomain($commonname->get_virtualdomain());
        $CertificateList = new CertificateList();
        $CertificateList->add($cert_entity);
        $commonname->set_certificate_list($CertificateList);
        $commonname->set_expiration_date($cert_entity->get_expiration_date());
        $commonname->set_service($cert_entity->get_service());
      }
      else{
        $commonname->set_expiration_date('設定されていません');
        $commonname->set_service('設定されていません');
      }

      $this->CommonNameList->add($commonname);
    }

    return $this->CommonNameList;
  }


  public function get_commonname_by_id(int $id)
  {
    $commonname_model = $this->CommonNameModel::on($this->connection)
      ->with(['virtualdomain', 'certificates.certificate_service.vendor'])
      ->find($id);

    $commonname = new CommonName(
      $commonname_model->id,
      $commonname_model->name,
    );

    $commonname->set_virtualdomain(new Virtualdomain(
      $commonname_model->virtualdomain->id,
      $commonname_model->virtualdomain->name
    ));

    $CertificateList = new CertificateList();

    foreach($commonname_model->certificates as $cert_model)
    {
      $cert_entity = $this->get_cert_entity($cert_model);
      $cert_entity->set_virtualdomain($commonname->get_virtualdomain());
      $CertificateList->add($cert_entity);
    }

    $commonname->set_certificate_list($CertificateList);

    return $commonname;
  }


  public function get_certificate_by_id(int $id)
  {
    $certificate_model = $this->CertificateModel::on($this->connection)
      ->with(['common_name.virtualdomain', 'certificate_service.vendor'])
      ->find($id);

    $cert_entity = $this->get_cert_entity($certificate_model);
    $cert_entity->set_commonname(new CommonName(
      $certificate_model->common_name->id,
      $certificate_model->common_name->name
    ));
    $cert_entity->set_virtualdomain(new Virtualdomain(
      $certificate_model->common_name->virtualdomain->id,
      $certificate_model->common_name->virtualdomain->name
    ));

    return $cert_entity;
  }

  /**
   * Undocumented function
   *
   * @param integer $id
   * @return boolean
   * @author seita_matsumoto <gyabooo@gmail.com>
   */
  private function is_symlink_cert_by_id(int $id)
  {
    $data = $this->CommonNameModel::on($this->connection)
      ->whereHas('current_certificate.certificate', function ($q) use ($id) {
        $q->where('id', $id);
      })->get();

    return collect($data)->isNotEmpty();
  }

  /**
   * CommonNameエンティティに証明書情報を追加
   * 
   * @access private
   * @param CommonName $CommonNameEntity
   * @param CertificateModel $CertificateModel
   * @return void
   * @author seita_matsumoto <gyabooo@gmail.com>
   */
  private function set_cert_to_commonname(
    CommonName $CommonNameEntity,
    CertificateModel $CertificateModel
  )
  {
    $certificate_entity = $this->get_cert_entity($CertificateModel);

    if ($certificate_entity->get_symlink()) {
      $CommonNameEntity->set_expiration_date($CertificateModel->expiration_date);
      $CommonNameEntity->set_service($certificate_entity->get_servise());
    }

    $CommonNameEntity->add_certificate($certificate_entity);
  }

  /**
   * Undocumented function
   *
   * @param CertificateModel $CertificateModel
   * @return Certificate
   * @author seita_matsumoto <gyabooo@gmail.com>
   */
  private function get_cert_entity(CertificateModel $CertificateModel)
  {
    $format = '%s (%s)';
    $service = sprintf(
      $format,
      $CertificateModel->certificate_service->name,
      $CertificateModel->certificate_service->vendor->name
    );

    return new Certificate(
      $CertificateModel->id,
      $CertificateModel->expiration_date,
      $CertificateModel->save_dir_path,
      $CertificateModel->csr,
      $CertificateModel->crt,
      $CertificateModel->cacert,
      $CertificateModel->key,
      $service,
      $this->is_symlink_cert_by_id($CertificateModel->id)
    );
  }
}
