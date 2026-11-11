<?php

namespace App\Http\Controllers;

use App\Services\AcademyDataService;
use Illuminate\Http\Request;

class ScoutingController extends Controller
{
    public function index()
    {
        $scouting = AcademyDataService::getScouting();
        $candidates = AcademyDataService::getScoutingCandidates();
        return view('scouting.index', compact('scouting', 'candidates'));
    }
}

