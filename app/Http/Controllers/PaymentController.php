<?php

namespace App\Http\Controllers;

use App\Services\AcademyDataService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $stats = AcademyDataService::getStats();
        $transactions = AcademyDataService::getTransactions();
        $players = AcademyDataService::getPlayers();

        $dues = collect($players)->where('sub_remaining', '>', 0)->map(function($p) {
            return [
                'player_name_ar' => $p['name_ar'],
                'team' => $p['age_group'],
                'plan_ar' => $p['package_ar'] ?? 'باقة النخبة',
                'amount_due' => $p['sub_remaining'],
                'due_date' => '2026-03-25',
                'parent_name' => $p['parent_name_ar'],
                'phone' => $p['parent_phone'],
            ];
        })->values()->all();

        return view('payments.index', compact('stats', 'transactions', 'players', 'dues'));
    }

    public function transactions(Request $request)
    {
        $transactions = AcademyDataService::getTransactions();
        $status = $request->query('status');
        $method = $request->query('method');
        $search = $request->query('search');

        if ($status) {
            $transactions = array_filter($transactions, fn($t) => $t['status'] === $status);
        }
        if ($method) {
            $transactions = array_filter($transactions, fn($t) => $t['method'] === $method);
        }
        if ($search) {
            $transactions = array_filter($transactions, function($t) use ($search) {
                return str_contains($t['id'], $search) || 
                       str_contains(mb_strtolower($t['player_name_ar']), mb_strtolower($search));
            });
        }

        return view('payments.transactions', compact('transactions', 'status', 'method', 'search'));
    }

    public function checkout(Request $request)
    {
        $players = AcademyDataService::getPlayers();
        $unpaidPlayers = collect($players)->where('sub_remaining', '>', 0)->values()->all();
        $selectedPlayerId = $request->query('player_id', $unpaidPlayers[0]['id'] ?? 1);
        $selectedPlayer = collect($players)->firstWhere('id', (int)$selectedPlayerId) ?? ($unpaidPlayers[0] ?? $players[0]);

        return view('payments.checkout', compact('unpaidPlayers', 'selectedPlayer', 'selectedPlayerId'));
    }

    public function receipt(Request $request, $id = null)
    {
        $id = $id ?? $request->query('id', 'TXN-2026-8901');
        $transactions = AcademyDataService::getTransactions();
        $txn = collect($transactions)->firstWhere('id', $id);

        if (!$txn) {
            // Simulated fallback transaction from checkout
            $txn = [
                'id' => $id,
                'receipt_no' => 'RCP-' . rand(8000, 9999),
                'player_id' => 3,
                'player_name_ar' => $request->query('player_name', 'يوسف إبراهيم مصطفى'),
                'parent_name_ar' => 'إبراهيم مصطفى عبد العزيز',
                'package_ar' => $request->query('package', 'الباقة الذهبية الشهرية'),
                'amount' => (int)($request->query('amount', 800)),
                'method' => $request->query('method', 'card'),
                'method_label_ar' => 'بطاقة بنكية / فيزا',
                'date' => date('Y-m-d H:i'),
                'status' => 'successful',
                'reference' => 'AUTH-' . rand(100000, 999999),
                'note' => 'تم الدفع الإلكتروني بنجاح',
            ];
        }

        return view('payments.receipt', compact('txn'));
    }

    public function methods()
    {
        return view('payments.methods');
    }

    public function refunds()
    {
        $transactions = collect(AcademyDataService::getTransactions())->where('status', 'refunded')->values()->all();
        return view('payments.refunds', compact('transactions'));
    }

    public function subscriptions()
    {
        $plans = AcademyDataService::getSubscriptionPlans();
        $players = AcademyDataService::getPlayers();
        $stats = AcademyDataService::getStats();

        return view('subscriptions.index', compact('plans', 'players', 'stats'));
    }
}

