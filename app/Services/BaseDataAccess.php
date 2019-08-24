<?php

namespace App\Services;

interface BaseDataAccess
{
  public function get_all();
  public function get(int $id);
  public function store(...$data);
  public function update(...$data);
  public function destroy(int $id);
}
