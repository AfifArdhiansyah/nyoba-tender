<?php

namespace App\Domain\Services;

use App\Domain\Repositories\OfficeRepositoryInterface;

class OfficeService
{
    protected $officeRepo;

    public function __construct(OfficeRepositoryInterface $officeRepo)
    {
        $this->officeRepo = $officeRepo;
    }

    public function getAllOffices()
    {
        return $this->officeRepo->getAllOffices();
    }

    public function getOfficeById($id)
    {
        return $this->officeRepo->getOfficeById($id);
    }
}
