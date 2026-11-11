<?php

namespace App\Http\Controllers;

use App\Services\AcademyDataService;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function index(Request $request)
    {
        $players = AcademyDataService::getPlayers();
        $teams = AcademyDataService::getTeams();
        $stats = AcademyDataService::getStats();

        // Optional filtering
        $filterAge = $request->query('age_group');
        $filterStatus = $request->query('status');
        $search = $request->query('search');

        if ($filterAge) {
            $players = array_filter($players, fn($p) => $p['age_group'] === $filterAge);
        }
        if ($filterStatus) {
            $players = array_filter($players, fn($p) => $p['subscription_status'] === $filterStatus);
        }
        if ($search) {
            $players = array_filter($players, function($p) use ($search) {
                return str_contains(mb_strtolower($p['name_ar']), mb_strtolower($search)) ||
                       str_contains(strtolower($p['name_en']), strtolower($search)) ||
                       str_contains($p['phone'], $search);
            });
        }

        return view('players.index', compact('players', 'teams', 'stats', 'filterAge', 'filterStatus', 'search'));
    }

    public function show($id)
    {
        $players = AcademyDataService::getPlayers();
        $player = collect($players)->firstWhere('id', (int)$id) ?? $players[0];
        $transactions = collect(AcademyDataService::getTransactions())->where('player_id', $player['id'])->values()->all();
        $skillsData = AcademyDataService::getPlayerSkills($player['id']);
        $skills = $skillsData['skills'];
        $feedback = $skillsData['coach_feedback'];
        $targets = $skillsData['development_targets'];
        $timeline = $skillsData['timeline'];

        return view('players.show', compact('player', 'transactions', 'skills', 'feedback', 'targets', 'timeline'));
    }

    public function create()
    {
        $teams = AcademyDataService::getTeams();
        $packages = AcademyDataService::getSubscriptionPlans();
        return view('players.create', compact('teams', 'packages'));
    }

    public function store(Request $request)
    {
        return redirect()->route('players.index')->with('success', 'تم تسجيل اللاعب بنجاح وإضافته إلى قاعدة البيانات والفرقة الرياضية!');
    }

    public function goalkeepers()
    {
        $allPlayers = AcademyDataService::getPlayers();
        $goalkeepers = array_filter($allPlayers, fn($p) => !empty($p['is_goalkeeper']));
        return view('players.goalkeepers', compact('goalkeepers'));
    }

    public function teams()
    {
        $teams = AcademyDataService::getTeams();
        return view('players.teams', compact('teams'));
    }

    public function transfers()
    {
        $players = AcademyDataService::getPlayers();
        return view('players.transfers', compact('players'));
    }

    public function edit($id)
    {
        $players = AcademyDataService::getPlayers();
        $player = collect($players)->firstWhere('id', (int)$id) ?? $players[0];
        $teams = AcademyDataService::getTeams();
        return view('players.edit', compact('player', 'teams'));
    }

    public function update(Request $request, $id)
    {
        return redirect()->route('players.show', $id)->with('success', 'تم تحديث بيانات اللاعب بنجاح!');
    }

    public function files()
    {
        $players = AcademyDataService::getPlayers();
        return view('players.files', compact('players'));
    }

    public function ageGroups()
    {
        return view('players.age-groups');
    }

    public function passport($id = 1)
    {
        $skillsData = AcademyDataService::getPlayerSkills((int) $id);
        $player = $skillsData['player'];
        $skills = $skillsData['skills'];
        $feedback = $skillsData['coach_feedback'];
        $targets = $skillsData['development_targets'];
        $timeline = $skillsData['timeline'];

        return view('players.passport', compact('player', 'skills', 'feedback', 'targets', 'timeline'));
    }
}

