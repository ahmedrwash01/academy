<?php

namespace App\Http\Controllers;

use App\Services\AcademyDataService;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $stats = AcademyDataService::getStats();
        $players = AcademyDataService::getPlayers();
        $coaches = AcademyDataService::getCoaches();

        return view('reports.index', compact('stats', 'players', 'coaches'));
    }
}

