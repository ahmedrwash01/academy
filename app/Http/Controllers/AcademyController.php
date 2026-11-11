<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AcademyDataService;

class AcademyController extends Controller
{
    public function cms()
    {
        $candidates = AcademyDataService::getScoutingCandidates();
        return view('academy.cms', compact('candidates'));
    }

    public function media()
    {
        $trophies = [
            ['title' => 'بطولة الجمهورية للأكاديميات المعتمدة 2025', 'category' => 'فئة U-15', 'date' => 'مايو 2025'],
            ['title' => 'كأس سوبر منطقة القاهرة للناشئين', 'category' => 'فئة U-17', 'date' => 'نوفمبر 2024'],
            ['title' => 'درع التميز الفني لأفضل قطاع حراس مرمى واعد', 'category' => 'أكاديمية الحراس', 'date' => 'سبتمبر 2024'],
        ];

        return view('media.index', compact('trophies'));
    }
}

