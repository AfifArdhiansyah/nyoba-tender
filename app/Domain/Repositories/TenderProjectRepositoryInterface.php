<?php

namespace App\Domain\Repositories;

interface TenderProjectRepositoryInterface
{
    public function getAllTenderProjects();
    public function getTenderProjectById($id);
    public function createTenderProject(array $data);
}
