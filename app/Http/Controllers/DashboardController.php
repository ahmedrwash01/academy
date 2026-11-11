<?php

namespace App\Http\Controllers;

use App\Services\AcademyDataService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = AcademyDataService::getStats();
        $players = AcademyDataService::getPlayers();
        $coaches = AcademyDataService::getCoaches();
        $teams = AcademyDataService::getTeams();
        $trainingSessions = AcademyDataService::getTrainingSessions();
        $matches = AcademyDataService::getMatches();
        $transactions = AcademyDataService::getTransactions();
        $scouting = AcademyDataService::getScouting();
        $activityTimeline = AcademyDataService::getActivityTimeline();
        $insights = AcademyDataService::getPerformanceInsights();
        $decisionAlerts = AcademyDataService::getDecisionAlerts();
        $leagueStandings = AcademyDataService::getLeagueStandings();

        return view('dashboard.index', compact(
            'stats',
            'players',
            'coaches',
            'teams',
            'trainingSessions',
            'matches',
            'transactions',
            'scouting',
            'activityTimeline',
            'insights',
            'decisionAlerts',
            'leagueStandings'
        ));
    }

    public function intelligence()
    {
        $stats = AcademyDataService::getStats();
        $insights = AcademyDataService::getPerformanceInsights();
        $players = AcademyDataService::getPlayers();
        $teams = AcademyDataService::getTeams();
        $trainingSessions = AcademyDataService::getTrainingSessions();

        return view('intelligence.index', compact('stats', 'insights', 'players', 'teams', 'trainingSessions'));
    }
}

