<?php

namespace App\Http\Controllers;

use App\Services\AcademyDataService;
use Illuminate\Http\Request;

class SponsorController extends Controller
{
    public function index()
    {
        $sponsors = AcademyDataService::getSponsors();
        return view('sponsors.index', compact('sponsors'));
    }
}

