<?php

namespace App\Http\Controllers;

use App\Services\AcademyDataService;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function index()
    {
        $complaints = AcademyDataService::getComplaints();
        return view('complaints.index', compact('complaints'));
    }
}

