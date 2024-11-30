<?php

namespace App\Domain\Repositories;

interface OfficeRepositoryInterface
{
    public function getAllOffices();
    public function getOfficeById($id);
    public function createOffice(array $data);
}
