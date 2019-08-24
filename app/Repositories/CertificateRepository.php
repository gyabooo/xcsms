<?php

namespace App\Repositories;

use App\Services\CertificateDataAccess;
use App\Models\Commonname as CommonnameModel;
use App\Models\Certificate as CertificateModel;
use App\Models\CertificateService as CertificateServiceModel;
use App\Models\CurrentCertificate as CurrentCertificateModel;
use App\Models\Virtualdomain as VirtualdomainModel;
use App\Entities\Certificate;
use App\Entities\CertificateList;
use App\Entities\Commonname;
use App\Entities\CommonnameList;
use App\Entities\Virtualdomain;
use App\Entities\VirtualdomainList;
use App\Entities\CertificateService as CertificateServiceEntity;
use App\Entities\CertificateServiceList;
use Illuminate\Support\Facades\Schema;

class CertificateRepository implements CertificateDataAccess
{
  protected $CommonnameModel;
  protected $CertificateModel;
  protected $VirtualdomainModel;
  protected $CommonnameList;

  private $connection = 'mysql';


  public function __construct(
    CommonnameModel $CommonnameModel,
    CertificateModel $CertificateModel,
    VirtualdomainModel $VirtualdomainModel,
    CertificateServiceModel $CertificateServiceModel,
    CommonNameList $CommonnameList
  )
  {
    $this->CommonnameModel = $CommonnameModel;
    $this->CertificateModel = $CertificateModel;
    $this->VirtualdomainModel = $VirtualdomainModel;
    $this->CertificateServiceModel = $CertificateServiceModel;
    $this->CommonnameList = $CommonnameList;
  }

  public function get_certificate_service_list()
  {
    $certificate_service_models = $this->CertificateServiceModel::on($this->connection)
      ->with(['vendor'])->get();

    $format = '%s (%s)';
    $CertificateServiceList = new CertificateServiceList;
    $CertificateServiceList->add(new CertificateServiceEntity(0, 'なし'));

    foreach ($certificate_service_models as $certificate_service_model) {
      $service_name = sprintf(
        $format,
        $certificate_service_model->name,
        $certificate_service_model->vendor->name
      );

      $certificate_service = new CertificateServiceEntity(
        $certificate_service_model->id,
        $service_name
      );

      $CertificateServiceList->add($certificate_service);
    }

    return $CertificateServiceList;
  }

  public function get_certificate_service_by_id(int $service_id)
  {
    $certificate_service_model = $this->CertificateServiceModel::on($this->connection)
      ->with(['vendor'])
      ->find($service_id);

      // dd($certificate_service_model);
    if ($certificate_service_model) {
      $id = $service_id;
      $format = '%s (%s)';
      $service_name = sprintf(
        $format,
        $certificate_service_model->name,
        $certificate_service_model->vendor->name
      );
    }
    else {
      $id = 0;
      $service_name = '設定されていません';
    }

    // $certificate_service = new CertificateServiceEntity($id, $service_name);

    return new CertificateServiceEntity($id, $service_name);
  }

  public function get_commonname_list()
  {
    $commonname_models = $this->CommonnameModel::on($this->connection)
      ->with(['virtualdomain', 'current_certificate.certificate.certificate_service.vendor'])
      ->get();

    foreach ($commonname_models as $commonname_model) {
      $commonname = new Commonname(
        $commonname_model->id,
        $commonname_model->name
      );

      if ($commonname_model->virtualdomain) {
        $commonname->set_virtualdomain(new Virtualdomain(
          $commonname_model->virtualdomain->id,
          $commonname_model->virtualdomain->name
        ));
      } else {
        $commonname->set_virtualdomain(new Virtualdomain(
          0,
          '設定されていません'
        ));
      }

      if($commonname_model->current_certificate && $commonname_model->current_certificate->certificate_id)
      {
        $cert_model = $commonname_model->current_certificate->certificate;
        $cert_entity = $this->get_cert_entity($cert_model);
        $cert_entity->set_virtualdomain($commonname->get_virtualdomain());
        $CertificateList = new CertificateList();
        $CertificateList->add($cert_entity);
        $commonname->set_certificate_list($CertificateList);
        $commonname->set_expiration_date($cert_entity->get_expiration_date());
        $commonname->set_service($cert_entity->get_service()->get_name());
      }
      else{
        $commonname->set_expiration_date('設定されていません');
        $commonname->set_service('設定されていません');
      }

      $this->CommonnameList->add($commonname);
    }

    return $this->CommonnameList;
  }


  public function get_commonname_by_id(int $id)
  {
    $commonname_model = $this->CommonnameModel::on($this->connection)
      ->with(['virtualdomain', 'certificates.certificate_service.vendor'])
      ->find($id);

    $commonname = new Commonname(
      $commonname_model->id,
      $commonname_model->name,
    );

    if($commonname_model->virtualdomain) {
      $commonname->set_virtualdomain(new Virtualdomain(
        $commonname_model->virtualdomain->id,
        $commonname_model->virtualdomain->name
      ));
    }
    else {
      $commonname->set_virtualdomain(new Virtualdomain(
        0,
        '設定されていません'
      ));
    }

    $CertificateList = new CertificateList();

    foreach($commonname_model->certificates as $cert_model) {
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
      ->with(['commonname.virtualdomain', 'certificate_service.vendor'])
      ->find($id);
    // dd($certificate_model);

    $cert_entity = $this->get_cert_entity($certificate_model);
    // dd($cert_entity);
    $cert_entity->set_commonname(new Commonname(
      $certificate_model->commonname->id,
      $certificate_model->commonname->name
    ));

    if ($certificate_model->commonname->virtualdomain) {
      $cert_entity->set_virtualdomain(new Virtualdomain(
        $certificate_model->commonname->virtualdomain->id,
        $certificate_model->commonname->virtualdomain->name
      ));
    }
    else {
      $cert_entity->set_virtualdomain(new Virtualdomain(
        0,
        '設定されていません'
      ));
    }

    return $cert_entity;
  }

  public function store_certificate(
    string $is_symlink = null,
    string $expiration_date = null,
    string $csr = null,
    string $crt = null,
    string $cacert = null,
    string $key = null,
    int $certificate_service_id = null,
    int $commonname_id = null
  )
  {
    $column_names = Schema::getColumnListing('certificates');
    foreach ($column_names as $column_name) {
      if (${$column_name}) {
        $Certificate->${$column_name} = ${$column_name};
      }
    }
    $Certificate->save();

    if ($is_symlink === 'true') {
      $CurrentCertificate = CurrentCertificateModel::updateOrCreate(
        [
          'commonname_id' => $commonname_id,
        ],
        [
          'commonname_id' => $commonname_id,
          'certificate_id' => $certificate_id,
        ]
      );
    }
    else {
      $CurrentCertificate = CurrentCertificateModel::whereRaw(
        'commonname_id = ? and certificate_id = ?',
        [$commonname_id, $certificate_id]
      )->first();

      if ($CurrentCertificate) {
        $CurrentCertificate->delete();
      }
    }

    return $this->get_certificate_by_id($Certificate->id);
  }


  public function destroy_certificate_by_id(int $certificate_id)
  {
    if ($CurrentCertificate = CurrentCertificateModel::where('certificate_id', $certificate_id)->first()) {
      $CurrentCertificate->certificate()->dissociate()->save();
    }
    CertificateModel::destroy($certificate_id);
  }


  public function get_virtualdomain_list()
  {
    $virtualdomain_models = $this->VirtualdomainModel::on($this->connection)
      ->with('commonnames')
      ->get();

    $VirtualdomainList = new VirtualdomainList();
    
    foreach($virtualdomain_models as $virtualdomain_model) {
      $virtualdomain = new Virtualdomain(
        $virtualdomain_model->id,
        $virtualdomain_model->name
      );

      $VirtualdomainList->add($virtualdomain);
    }

    return $VirtualdomainList;
  }

  public function get_virtualdomain_by_id(int $id)
  {
    // dd($id);
    $virtualdomain_model = $this->VirtualdomainModel::on($this->connection)
      ->with(['commonnames'])
      ->find($id);

    // dd($virtualdomain_model);

    if($virtualdomain_model) {
      $Virtualdomain = new Virtualdomain(
        $virtualdomain_model->id,
        $virtualdomain_model->name
      );
    }
    else {
      return new Virtualdomain(
        $id,
        '設定されていません'
      );
    }
    
    $CommonnameList = new CommonnameList();

    foreach ($virtualdomain_model->commonnames as $commonname_model) {
      $commonname = $this->get_commonname_by_id($commonname_model->id);
      $CommonnameList->add($commonname);
    }

    $Virtualdomain->set_commonname_list($CommonnameList);

    // dd($Virtualdomain);
    return $Virtualdomain;
  }

  public function store_commonname(string $commonname, int $virtualdomain_id)
  {
    $commonname_data = [];

    if($virtualdomain_id !== 0) {
      $commonname_data['virtualdomain_id'] = $virtualdomain_id;
    }
    else {
      $commonname_data['virtualdomain_id'] = null;
    }

    $commonname_data['name'] = $commonname;
    $commonname_model = CommonnameModel::create($commonname_data);
    // $commonname_model->save();

    $commonname_entity = $this->get_commonname_by_id($commonname_model->id);
    // dd($commonname_entity);
    return $commonname_entity;
  }

  public function update_commonname(int $commonname_id, int $virtualdomain_id, string $commonname)
  {
    $commonname_data = array();
    if ($virtualdomain_id !== 0) {
      $commonname_data['virtualdomain_id'] = $virtualdomain_id;
    } else {
      $commonname_data['virtualdomain_id'] = null;
    }
    $commonname_data['name'] = $commonname;

    $commonname_model = CommonnameModel::find($commonname_id)->update($commonname_data);
  }

  public function destroy_commonname_by_id(int $commonname_id)
  {
    CommonnameModel::destroy($commonname_id);
  }

  public function store_certificate_with_files(
    int $certificate_service_id,
    int $commonname_id,
    ?array $files
  )
  {
    $Certificate = new CertificateModel;
    $csr = $crt = $cacert = $key = '';
    $expiration_date = null;

    $disk = \Storage::disk('public');
    $save_dir_relative_path = 'certificates/' . $commonname_id . '/' . date("Ymd-His");
    $save_dir_path = $disk->path($save_dir_relative_path);


    if($files) {
      foreach ($files as $file) {
        if ($file->isValid()) {
          $filename = $file->getClientOriginalName();
          $extention = $file->getClientOriginalExtension();

          if ($extention === 'pem') {
            $cacert = $filename;
          } else {
            ${$extention} = $filename;
          }

          if ($extention === 'crt') {
            $content = file_get_contents($file->path());
            $expiration_date = date("Y-m-d H:i:s", openssl_x509_parse($content)['validTo_time_t']);
          }

          $file->storeAs($save_dir_relative_path, $filename, 'public');
        }
      }
    }

    $Certificate->expiration_date = $expiration_date ;
    $Certificate->csr = $csr;
    $Certificate->cacert = $cacert;
    $Certificate->crt = $crt;
    $Certificate->key = $key;
    $Certificate->save_dir_path = $save_dir_path;
    $Certificate->certificate_service_id = (bool) $certificate_service_id ? $certificate_service_id : null;
    $Certificate->commonname_id = $commonname_id;
    $Certificate->save();

    return $this->get_certificate_by_id($Certificate->id);
  }

  public function update_certificate_with_files(
    int $certificate_id,
    int $certificate_service_id,
    int $commonname_id,
    ?array $files
  )
  {
    $Certificate = CertificateModel::find($certificate_id);
    $csr = $crt = $cacert = $key = null;
    $expiration_date = null;

    $disk = \Storage::disk('public');
    $save_dir_path = $Certificate->save_dir_path;
    $save_dir_relative_path = str_replace($disk->path(''), '', $save_dir_path);

    if($files) {
      foreach ($files as $file) {
        if ($file->isValid()) {
          $filename = $file->getClientOriginalName();
          $extention = $file->getClientOriginalExtension();

          if ($extention === 'pem') {
            $cacert = $filename;
          } else {
            ${$extention} = $filename;
          }

          if ($extention === 'crt') {
            $content = file_get_contents($file->path());
            $expiration_date = date("Y-m-d H:i:s", openssl_x509_parse($content)['validTo_time_t']);
          }

          $file->storeAs($save_dir_relative_path, $filename, 'public');
        }
      }
    }


    $column_names = Schema::getColumnListing('certificates');
    $column_names = array_diff($column_names, array('id', 'created_at', 'updated_at'));

    $update_columns = [];
    foreach ($column_names as $column_name) {
      if (${$column_name}) {
        $update_columns[$column_name] = ${$column_name};
      }
    }

    $Certificate->update($update_columns);

    return $this->get_certificate_by_id($certificate_id);
  }

  public function update_or_create_current_certificate(
    int $commonname_id,
    int $certificate_id,
    string $is_symlink
  )
  {
    if ($is_symlink === 'true') {
      $CurrentCertificate = CurrentCertificateModel::updateOrCreate(
        [
          'commonname_id' => $commonname_id,
        ],
        [
          'commonname_id' => $commonname_id,
          'certificate_id' => $certificate_id,
        ]
      );
    } else {
      $CurrentCertificate = CurrentCertificateModel::whereRaw(
        'commonname_id = ? and certificate_id = ?',
        [$commonname_id, $certificate_id]
      )->first();
      if ($CurrentCertificate) {
        $CurrentCertificate->delete();
      }
    }
  }

  
  /**
   * Undocumented function
   *
   * @param integer $id
   * @return boolean
   * @author seita_matsumoto <gyabooo@gmail.com>
   */
  private function is_symlink_by_cert_id(int $certificate_id)
  {
    $data = $this->CommonnameModel::on($this->connection)
      ->whereHas('current_certificate.certificate', function ($q) use ($certificate_id) {
        $q->where('id', $certificate_id);
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
    if ($CertificateModel->certificate_service){
      $id = $CertificateModel->certificate_service->id;
      $format = '%s (%s)';
      $service = sprintf(
        $format,
        $CertificateModel->certificate_service->name,
        $CertificateModel->certificate_service->vendor->name
      );
    }
    else {
      $id = 0;
      $service = '設定されていません';
    }

    $certificate_service = new CertificateServiceEntity($id, $service);

    return new Certificate(
      $CertificateModel->id,
      $CertificateModel->expiration_date,
      $CertificateModel->save_dir_path,
      $CertificateModel->csr,
      $CertificateModel->crt,
      $CertificateModel->cacert,
      $CertificateModel->key,
      $certificate_service,
      $this->is_symlink_by_cert_id($CertificateModel->id)
    );
  }
}
