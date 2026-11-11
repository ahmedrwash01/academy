<?php

namespace App\Http\Controllers;

use App\Services\AcademyDataService;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    public function index()
    {
        $sessions = AcademyDataService::getTrainingSessions();
        $teams = AcademyDataService::getTeams();
        $coaches = AcademyDataService::getCoaches();

        // Facilities & Pitches
        $facilities = [
            [
                'id' => 1,
                'name_ar' => 'الملعب الرئيسي A — ستاد النسور الدولي',
                'surface' => 'نجيل طبيعي هجين قانوني (Hybrid Grass)',
                'dimensions' => '105م × 68م (معايير FIFA Pro)',
                'lighting' => 'إضاءة كاشفة ليلية LED متطورة 1200 Lux',
                'status' => 'متاح وجاهز',
                'capacity' => 'مدرجات 1,200 متفرج',
                'current_booking' => 'تكتيكي U-15 • 18:00 - 20:00',
            ],
            [
                'id' => 2,
                'name_ar' => 'الملعب التدريبي B — ملعب النجيل الصناعي 4G',
                'surface' => 'ترتان صناعي جيل رابع معتمد دولياً',
                'dimensions' => '90م × 55م',
                'lighting' => 'إضاءة ليلية متكاملة 800 Lux',
                'status' => 'متاح وجاهز',
                'capacity' => 'مقاعد بدلاء وكاميرات تحليل علوية',
                'current_booking' => 'مدرسة الكرة U-11 • 16:30 - 18:00',
            ],
            [
                'id' => 3,
                'name_ar' => 'صالة الإعداد البدني والمركز الطبي (Performance Gym)',
                'surface' => 'أرضيات مطاطية ممتصة للصدمات',
                'dimensions' => '350 متر مربع مجهز بأجهزة Technogym',
                'lighting' => 'تكييف مركزي وأنظمة رصد معدل نبضات القلب',
                'status' => 'جلسات استشفاء نشطة',
                'capacity' => 'أحواض استشفاء ثلجي (Ice Baths) وساونا',
                'current_booking' => 'تأهيل بدني ووقاية من الإصابات',
            ],
        ];

        // 1-on-1 Private Sessions (التدريبات الفردية الخاصة)
        $privateSessions = [
            [
                'id' => 1,
                'player_name_ar' => 'يوسف إبراهيم مصطفى',
                'position_ar' => 'صانع ألعاب / وسط هجومي',
                'coach_name_ar' => 'كابتن عادل هيكل',
                'focus_area' => 'تطوير دقة التمرير البيني والإنهاء أمام المرمى',
                'date' => 'الخميس 12 مارس 2026',
                'time' => '15:30 - 16:30',
                'pitch' => 'ملعب تدريبي B (قطاع خاص)',
                'status' => 'مؤكد',
            ],
            [
                'id' => 2,
                'player_name_ar' => 'بلال حسام بدر',
                'position_ar' => 'حراسة مرمى واعدة',
                'coach_name_ar' => 'كابتن طارق السروجي',
                'focus_area' => 'تمركز في الكرات العرضية وسرعة رد الفعل الانفرادي',
                'date' => 'الجمعة 13 مارس 2026',
                'time' => '09:00 - 10:30',
                'pitch' => 'منطقة مرمى استاد النسور A',
                'status' => 'مؤكد',
            ],
            [
                'id' => 3,
                'player_name_ar' => 'عمر شريف حسن',
                'position_ar' => 'مهاجم صريح',
                'coach_name_ar' => 'كابتن أحمد حسام',
                'focus_area' => 'التسديد من لمسة واحدة بالقدمين والارتقاء الهوائي',
                'date' => 'السبت 14 مارس 2026',
                'time' => '16:00 - 17:00',
                'pitch' => 'ملعب تدريبي B',
                'status' => 'مؤكد',
            ],
        ];

        // Curricula & Training Programs (البرامج التدريبية المعتمدة)
        $curricula = [
            [
                'title_ar' => 'برنامج التأسيس المهاري والتحكم بالكرة (Ball Mastery)',
                'target_age' => 'U-9 حتى U-12',
                'weeks' => 12,
                'description' => 'التركيز على التوافق العضلي العصبي، مهارات الاستلام والتسليم بالقدمين، والمراوغة في المساحات الضيقة.',
                'sessions_per_week' => '3 حصص أسبوعياً',
            ],
            [
                'title_ar' => 'برنامج الفهم التكتيكي وسرعة التحول (Tactical Transition)',
                'target_age' => 'U-13 حتى U-15',
                'weeks' => 16,
                'description' => 'تطوير التمركز والضغط العالي، التدرج بالكرة من الخلف، وسرعة الارتداد الدفاعي والهجومي المنظم.',
                'sessions_per_week' => '4 حصص أسبوعياً + مباراة ودية',
            ],
            [
                'title_ar' => 'برنامج النخبة والإعداد للاحتراف (Elite Pro Pathway)',
                'target_age' => 'U-17 حتى الفريق الأول',
                'weeks' => 24,
                'description' => 'محاكاة لبيئة أندية الدوري الممتاز: تحليل بالفيديو، إعداد بدني عالي الشدة، وخطط لعب مركبة.',
                'sessions_per_week' => '5 حصص أسبوعياً + صالة لياقة',
            ],
        ];

        // Training Camps & Recreational Trips (المعسكرات التدريبية والرحلات)
        $camps = [
            [
                'title_ar' => 'معسكر الإعداد الشتوي المغلق — الإسكندرية 2026',
                'type' => 'معسكر تدريبي مكثف',
                'location' => 'الأكاديمية البحرية، أبو قير، الإسكندرية',
                'duration' => '7 أيام (18 - 25 مارس 2026)',
                'target_teams' => 'فريقي U-15 و U-17',
                'features' => 'مباريات ودية مع ناديي سموحة والاتحاد السكندري + تدريبات شاطئية',
                'status' => 'مكتمل الحجز بنسبة 95%',
            ],
            [
                'title_ar' => 'رحلة اليوم الترفيهي وبطولة الشواطئ — السخنة',
                'type' => 'رحلة ترفيهية ودمج اجتماعي',
                'location' => 'العين السخنة، منتجع بورتو',
                'duration' => 'يوم كامل (الجمعة 3 أبريل 2026)',
                'target_teams' => 'براعم U-9 و U-11 مع أولياء الأمور',
                'features' => 'أنشطة ترفيهية، كرة قدم شاطئية، وجوائز تشجيعية',
                'status' => 'التسجيل مفتوح',
            ],
            [
                'title_ar' => 'معسكر النخبة الصيفي الدولي — الغردقة 2026',
                'type' => 'معسكر صيفي احترافي',
                'location' => 'مدينة الغردقة، مجمع ستادات الجونة',
                'duration' => '10 أيام (يوليو 2026)',
                'target_teams' => 'مشروع الـ 500 موهبة والفريق الأول',
                'features' => 'مشاركة كشافين من أندية أوروبية ومصرية + قياسات استشفاء متقدمة',
                'status' => 'قيد التنسيق الإداري',
            ],
        ];

        return view('training.index', compact(
            'sessions',
            'teams',
            'coaches',
            'facilities',
            'privateSessions',
            'curricula',
            'camps'
        ));
    }

    public function attendance()
    {
        $players = AcademyDataService::getPlayers();
        $sessions = AcademyDataService::getTrainingSessions();
        $stats = AcademyDataService::getStats();

        return view('attendance.index', compact('players', 'sessions', 'stats'));
    }

    public function tactics()
    {
        $tacticalPresets = AcademyDataService::getTacticalPresets();
        $players = AcademyDataService::getPlayers();
        $teams = AcademyDataService::getTeams();

        return view('tactics.index', compact('tacticalPresets', 'players', 'teams'));
    }
}
