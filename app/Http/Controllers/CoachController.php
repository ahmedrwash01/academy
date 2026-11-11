<?php

namespace App\Http\Controllers;

use App\Services\AcademyDataService;
use Illuminate\Http\Request;

class CoachController extends Controller
{
    public function index()
    {
        $coaches = AcademyDataService::getCoaches();

        // Technical CPD Workshops for Coaches (ورش العمل للمدربين)
        $workshops = [
            [
                'id' => 1,
                'title_ar' => 'ورشة التحليل التكتيكي الرقمي وقراءة بيانات GPS للاعبين',
                'instructor' => 'د. أحمد ممدوح (محلل أداء معتمد CAF & Catapult)',
                'date' => 'السبت 21 مارس 2026',
                'time' => '10:00 - 14:00',
                'location' => 'قاعة المحاضرات الرئيسية — ستاد النسور',
                'topics' => 'تحليل خرائط الحرارة Heatmaps، قياس شدة الركض، وربط الفيديو بالبيانات الإحصائية',
                'status' => 'مؤكدة ومعتمدة',
                'registered_coaches' => 14,
            ],
            [
                'id' => 2,
                'title_ar' => 'التهيئة الذهنية وإدارة الضغوط التنافسية لقطاع البراعم',
                'instructor' => 'د. تامر فاروق (أخصائي الإعداد النفسي الرياضي)',
                'date' => 'الخميس 26 مارس 2026',
                'time' => '17:00 - 19:30',
                'location' => 'مركز المؤتمرات الرياضي',
                'topics' => 'تطوير الثبات الانفعالي، تقبل قرارات الحكام، ودعم اللاعبين بعد الخسارة',
                'status' => 'مفتوحة للتسجيل',
                'registered_coaches' => 11,
            ],
            [
                'id' => 3,
                'title_ar' => 'فلسفة بناء اللعب من الخلف والتمركز التكتيكي الحديث',
                'instructor' => 'كابتن إبراهيم فؤاد (المدير الفني العام للأكاديمية)',
                'date' => 'الثلاثاء 31 مارس 2026',
                'time' => '18:00 - 20:30',
                'location' => 'الملعب الرئيسي A (تطبيق عملي ميداني)',
                'topics' => 'خلق التفوق العددي 3v2 ضد الضغط العالي، وتحركات حارس المرمى كلاعب ليبرو',
                'status' => 'إلزامية لكافة الأجهزة',
                'registered_coaches' => 16,
            ],
            [
                'id' => 4,
                'title_ar' => 'الإسعافات الأولية في الملاعب والتعامل الفوري مع بلع اللسان والإصابات',
                'instructor' => 'د. هشام عبد الجواد (استشاري جراحة العظام والطب الرياضي)',
                'date' => 'الجمعة 10 أبريل 2026',
                'time' => '09:30 - 12:30',
                'location' => 'الوحدة الطبية المركزية',
                'topics' => 'إنعاش القلب CPR، تثبيت الكسور الميدانية، وبروتوكول الارتجاج الدماغي Concussion',
                'status' => 'شهادة حضور معتمدة',
                'registered_coaches' => 16,
            ],
        ];

        return view('coaches.index', compact('coaches', 'workshops'));
    }

    public function show($id)
    {
        $coaches = AcademyDataService::getCoaches();
        $coach = collect($coaches)->firstWhere('id', (int)$id) ?? $coaches[0];
        $trainingSessions = collect(AcademyDataService::getTrainingSessions())->where('coach_ar', $coach['name_ar'])->values()->all();

        return view('coaches.show', compact('coach', 'trainingSessions'));
    }

    public function create()
    {
        $teams = AcademyDataService::getTeams();
        return view('coaches.create', compact('teams'));
    }

    public function store(Request $request)
    {
        return redirect()->route('coaches.index')->with('success', 'تم تسجيل المدرب بنجاح وتعيينه ضمن الكادر الفني للأكاديمية!');
    }
}
