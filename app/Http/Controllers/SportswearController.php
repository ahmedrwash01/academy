<?php

namespace App\Http\Controllers;

use App\Services\AcademyDataService;
use Illuminate\Http\Request;

class SportswearController extends Controller
{
    public function index()
    {
        $products = AcademyDataService::getSportswear();
        return view('sportswear.index', compact('products'));
    }
}

