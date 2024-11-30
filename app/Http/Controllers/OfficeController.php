<?php

namespace App\Http\Controllers;

use App\Domain\Services\OfficeService;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
    protected $officeService;

    public function __construct(OfficeService $officeService)
    {
        $this->officeService = $officeService;
    }

    public function index()
    {
        $offices = $this->officeService->getAllOffices();
        return response()->json($offices);
    }

    public function show($id)
    {
        $office = $this->officeService->getOfficeById($id);
        return response()->json($office);
    }
}
