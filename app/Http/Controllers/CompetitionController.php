<?php

namespace App\Http\Controllers;

use App\Services\AcademyDataService;
use Illuminate\Http\Request;

class CompetitionController extends Controller
{
    public function index()
    {
        $matches = AcademyDataService::getMatches();
        $teams = AcademyDataService::getTeams();

        $standings = [
            ['pos' => 1, 'team' => 'أكاديمية النسور U-15', 'played' => 14, 'won' => 12, 'drawn' => 2, 'lost' => 0, 'gf' => 38, 'ga' => 8, 'pts' => 38, 'is_eagles' => true],
            ['pos' => 2, 'team' => 'نادي إنبي للناشئين', 'played' => 14, 'won' => 11, 'drawn' => 1, 'lost' => 2, 'gf' => 31, 'ga' => 12, 'pts' => 34, 'is_eagles' => false],
            ['pos' => 3, 'team' => 'أكاديمية المقاولون العرب', 'played' => 14, 'won' => 9, 'drawn' => 3, 'lost' => 2, 'gf' => 28, 'ga' => 14, 'pts' => 30, 'is_eagles' => false],
            ['pos' => 4, 'team' => 'نادي سيراميكا كليوباترا', 'played' => 14, 'won' => 8, 'drawn' => 2, 'lost' => 4, 'gf' => 22, 'ga' => 16, 'pts' => 26, 'is_eagles' => false],
            ['pos' => 5, 'team' => 'نادي وادي دجلة', 'played' => 14, 'won' => 7, 'drawn' => 3, 'lost' => 4, 'gf' => 24, 'ga' => 19, 'pts' => 24, 'is_eagles' => false],
        ];

        // Trophy Cabinet & Achievements
        $trophies = [
            [
                'id' => 1,
                'title_ar' => 'كأس بطولة الجمهورية للبراعم U-13',
                'season' => '2024 / 2025',
                'organizer' => 'الاتحاد المصري لكرة القدم (EFA)',
                'medal' => 'المركز الأول والميدالية الذهبية',
                'badge' => 'كأس ذهبي',
                'top_scorer' => 'يوسف إبراهيم (14 هدفاً)',
                'date' => 'مايو 2025',
            ],
            [
                'id' => 2,
                'title_ar' => 'درع دوري سوبر القاهرة للناشئين U-15',
                'season' => '2023 / 2024',
                'organizer' => 'فرع القاهرة لكرة القدم',
                'medal' => 'بطل الدوري بدون هزيمة',
                'badge' => 'درع التفوق',
                'top_scorer' => 'عمر شريف حسن (19 هدفاً)',
                'date' => 'أبريل 2024',
            ],
            [
                'id' => 3,
                'title_ar' => 'كأس بطولة زد الودية الدولية للأكاديميات',
                'season' => '2025',
                'organizer' => 'نادي ZED الرياضي',
                'medal' => 'الميدالية الفضية (الوصيف)',
                'badge' => 'كأس الفضة',
                'top_scorer' => 'كريم عصام زهران',
                'date' => 'أكتوبر 2025',
            ],
            [
                'id' => 4,
                'title_ar' => 'جائزة أفضل أكاديمية كروية واعدة في مصر',
                'season' => '2025',
                'organizer' => 'رابطة الأندية المصرية المحترفة',
                'medal' => 'الدرع الماسي للتميز المؤسسي',
                'badge' => 'جائزة تميز',
                'top_scorer' => 'إشراف كابتن إبراهيم فؤاد',
                'date' => 'ديسمبر 2025',
            ],
        ];

        // Active Tournaments
        $tournaments = [
            [
                'name_ar' => 'دوري سوبر منطقة القاهرة U-15',
                'teams_count' => 16,
                'current_stage' => 'الجولة 15 (إياب)',
                'standing' => 'متصدر المركز الأول',
                'next_match' => 'السبت 14 مارس ضد وادي دجلة',
            ],
            [
                'name_ar' => 'كأس النخبة للأكاديميات المعتمدة U-13',
                'teams_count' => 24,
                'current_stage' => 'الدور ربع النهائي',
                'standing' => 'تأهل مباشر',
                'next_match' => 'الأحد 22 مارس ضد نادي الصيد',
            ],
            [
                'name_ar' => 'مهرجان براعم الجيزة والشيخ زايد U-11',
                'teams_count' => 12,
                'current_stage' => 'دور المجموعات',
                'standing' => 'المركز الثاني',
                'next_match' => 'الجمعة 20 مارس ضد نادي 6 أكتوبر',
            ],
        ];

        return view('competitions.index', compact('matches', 'teams', 'standings', 'trophies', 'tournaments'));
    }
}
