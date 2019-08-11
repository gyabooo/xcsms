<?php

namespace App\Services;

class FileSystemService
{
  protected $FileSystemDataAccess;

  public function __construct(FileSystemDataAccess $FileSystemDataAccess)
  {
    $this->FileSystemDataAccess = $FileSystemDataAccess;
  }

  public function get_dirctory_list()
  {
    
  }
}
