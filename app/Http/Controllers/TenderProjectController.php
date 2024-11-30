<?php

namespace App\Http\Controllers;

use App\Domain\Services\TenderProjectService;
use Illuminate\Http\Request;

class TenderProjectController extends Controller
{
    protected $tenderProjectService;

    public function __construct(TenderProjectService $tenderProjectService)
    {
        $this->tenderProjectService = $tenderProjectService;
    }

    public function index()
    {
        $tenderProjects = $this->tenderProjectService->getAllTenderProjects();
        return response()->json($tenderProjects);
    }

    public function show($id)
    {
        $tenderProject = $this->tenderProjectService->getTenderProjectById($id);
        return response()->json($tenderProject);
    }
}
