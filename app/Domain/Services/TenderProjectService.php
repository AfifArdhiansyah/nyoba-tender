<?php

namespace App\Domain\Services;

use App\Domain\Repositories\TenderProjectRepositoryInterface;

class TenderProjectService
{
    protected $tenderProjectRepo;

    public function __construct(TenderProjectRepositoryInterface $tenderProjectRepo)
    {
        $this->tenderProjectRepo = $tenderProjectRepo;
    }

    public function getAllTenderProjects()
    {
        return $this->tenderProjectRepo->getAllTenderProjects();
    }

    public function getTenderProjectById($id)
    {
        return $this->tenderProjectRepo->getTenderProjectById($id);
    }
}
