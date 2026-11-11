<?php

namespace App\Http\Controllers;

use App\Services\AcademyDataService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = AcademyDataService::getUsers();
        return view('users.index', compact('users'));
    }
}

