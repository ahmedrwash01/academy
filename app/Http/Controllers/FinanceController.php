<?php

namespace App\Http\Controllers;

use App\Services\AcademyDataService;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    public function index()
    {
        $stats = AcademyDataService::getStats();
        $transactions = AcademyDataService::getTransactions();

        // High-Precision Monthly & Annual Financial Data
        $financialSummary = [
            'monthly' => [
                'revenue' => 385000,
                'expenses' => 224000,
                'net_profit' => 161000,
                'margin' => 41.8,
                'label' => 'شهر مارس 2026',
            ],
            'annual' => [
                'revenue' => 4620000,
                'expenses' => 2688000,
                'net_profit' => 1932000,
                'margin' => 41.8,
                'label' => 'الموسم الرياضي 2025 / 2026',
            ],
        ];

        // Revenue Streams Breakdown (Monthly & Annual)
        $revenueCategories = [
            [
                'name' => 'اشتراكات اللاعبين والباقات التدريبية',
                'monthly_amount' => 315700,
                'annual_amount' => 3788400,
                'percent' => 82,
                'icon' => 'users',
                'trend' => '+14.2%',
            ],
            [
                'name' => 'عقود الرعاية والشراكات التجارية الاستراتيجية',
                'monthly_amount' => 37500,
                'annual_amount' => 450000,
                'percent' => 10,
                'icon' => 'handshake',
                'trend' => '+25.0%',
            ],
            [
                'name' => 'مبيعات المتجر، الزي الرسمي، والمهمات الرياضية',
                'monthly_amount' => 20000,
                'annual_amount' => 240000,
                'percent' => 5,
                'icon' => 'shopping-bag',
                'trend' => '+8.5%',
            ],
            [
                'name' => 'رسوم المعسكرات التدريبية، الرحلات، والتدريبات الخاصة (Private)',
                'monthly_amount' => 11800,
                'annual_amount' => 141600,
                'percent' => 3,
                'icon' => 'compass',
                'trend' => '+18.0%',
            ],
        ];

        // Expense Streams Breakdown (Monthly & Annual)
        $expenseCategories = [
            [
                'name' => 'رواتب ومكافآت الأجهزة الفنية، المدربين، والأطقم الطبية',
                'monthly_amount' => 116480,
                'annual_amount' => 1397760,
                'percent' => 52,
                'icon' => 'award',
                'status' => 'ضمن الميزانية المعتمدة',
            ],
            [
                'name' => 'إيجار الملاعب، الصيانة، فواتير الكهرباء والإضاءة الليلية',
                'monthly_amount' => 53760,
                'annual_amount' => 645120,
                'percent' => 24,
                'icon' => 'map-pin',
                'status' => 'ثابت تعاقدياً',
            ],
            [
                'name' => 'شراء الكرات، الشواخص، وتجهيزات التدريب والأطقم',
                'monthly_amount' => 26880,
                'annual_amount' => 322560,
                'percent' => 12,
                'icon' => 'package',
                'status' => 'مشتريات موسمية',
            ],
            [
                'name' => 'رسوم قيد المسابقات، الحكام، الانتقالات، وبطولات الدوري',
                'monthly_amount' => 26880,
                'annual_amount' => 322560,
                'percent' => 12,
                'icon' => 'trophy',
                'status' => 'مخصصات نشاط',
            ],
        ];

        // 12-Month Audited Flow Trend (EGP)
        $monthlyTrend = [
            'months' => ['أبريل', 'مايو', 'يونيو', 'يوليو', 'أغسطس', 'سبتمبر', 'أكتوبر', 'نوفمبر', 'ديسمبر', 'يناير', 'فبراير', 'مارس'],
            'revenue' => [320000, 345000, 410000, 430000, 450000, 390000, 380000, 375000, 360000, 370000, 380000, 385000],
            'expenses' => [210000, 215000, 240000, 250000, 255000, 230000, 220000, 220000, 215000, 218000, 220000, 224000],
        ];

        return view('finance.index', compact(
            'stats',
            'transactions',
            'financialSummary',
            'revenueCategories',
            'expenseCategories',
            'monthlyTrend'
        ));
    }
}
