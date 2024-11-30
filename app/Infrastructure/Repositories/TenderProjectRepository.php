<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Repositories\TenderProjectRepositoryInterface;
use App\Models\TenderProject;

class TenderProjectRepository implements TenderProjectRepositoryInterface
{
    public function getAllTenderProjects()
    {
        return TenderProject::orderBy("status", "desc")->get();
    }

    public function getTenderProjectById($id)
    {
        return TenderProject::find($id);
    }

    public function createTenderProject(array $data)
    {
        return TenderProject::create($data);
    }
}

