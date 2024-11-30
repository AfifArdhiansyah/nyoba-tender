<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Repositories\OfficeRepositoryInterface;
use App\Models\Office;

class OfficeRepository implements OfficeRepositoryInterface
{
    public function getAllOffices()
    {
        return Office::all();
    }

    public function getOfficeById($id)
    {
        return Office::find($id);
    }

    public function createOffice(array $data)
    {
        return Office::create($data);
    }
}

