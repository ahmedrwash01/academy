@extends('layouts.admin', ['title' => 'إيصال سداد معتمد - ' . $txn['receipt_no']])

@section('content')
<div class="space-y-6 max-w-3xl mx-auto font-arabic">
    <!-- Non-printable top action bar -->
    <div class="no-print flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 pb-2 border-b border-[var(--border)]">
        <div>
            <div class="flex items-center gap-1.5 text-xs text-[var(--text-muted)] mb-1">
                <a href="{{ route('dashboard') }}" class="hover:text-[var(--text-strong)] transition-colors">لوحة القيادة</a>
                <span class="text-[var(--text-muted)]">/</span>
                <a href="{{ route('payments.transactions') }}" class="hover:text-[var(--text-strong)] transition-colors">العمليات المالية</a>
                <span class="text-[var(--text-muted)]">/</span>
                <span class="text-[var(--text-strong)] font-medium">{{ $txn['receipt_no'] }}</span>
            </div>
            <h1 class="text-2xl font-bold text-[var(--text-strong)] tracking-tight">إيصال تحصيل رسمي معتمد</h1>
        </div>

        <div class="flex items-center gap-2">
            <button onclick="window.print()" class="inline-flex items-center gap-1.5 rounded-lg bg-[var(--text-strong)] px-3.5 py-1.5 text-xs font-bold text-[var(--surface)] hover:opacity-90 transition-opacity shadow-sm cursor-pointer">
                <i data-lucide="printer" class="h-3.5 w-3.5"></i>
                <span>طباعة الإيصال (Print)</span>
            </button>
            <a href="{{ route('payments.transactions') }}" class="inline-flex items-center gap-1.5 rounded-lg border border-[var(--border)] bg-[var(--surface)] px-3 py-1.5 text-xs font-medium text-[var(--text-strong)] hover:bg-[var(--surface-subtle)] transition-colors shadow-2xs">
                <i data-lucide="arrow-right" class="h-3.5 w-3.5"></i>
                <span>العودة للعمليات</span>
            </a>
        </div>
    </div>

    <!-- Official Printable Receipt Card -->
    <div class="print-area rounded-xl border border-[var(--border)] bg-[var(--surface)] p-8 sm:p-10 shadow-2xs relative">
        <!-- Receipt Header -->
        <div class="flex flex-col sm:flex-row items-center justify-between gap-6 border-b border-[var(--border)] pb-6">
            <div class="flex items-center gap-4 text-center sm:text-start">
                <img src="{{ asset('images/academy-logo.png') }}" alt="Academy Logo" class="h-16 w-16 object-contain">
                <div>
                    <h2 class="text-lg font-bold text-[var(--text-strong)] tracking-tight">{{ __('app.academy_name') }}</h2>
                    <p class="text-xs font-medium text-[var(--text-muted)] tracking-wider uppercase font-mono mt-0.5">EAGLE'S SC FOOTBALL ACADEMY</p>
                    <p class="text-[11px] text-[var(--text-muted)] mt-1">القاهرة الجديدة - التجمع الخامس • هاتف: +20 100 111 2233</p>
                </div>
            </div>

            <div class="text-center sm:text-end space-y-1">
                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded text-[11px] font-medium bg-[var(--success-bg)] text-[var(--success-text)] border border-[var(--success-border)]">
                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-600"></span>
                    إيصال مسدد ومعتمد رسمياً
                </span>
                <p class="text-xs font-mono font-bold text-[var(--text-strong)] mt-2">رقم الإيصال: {{ $txn['receipt_no'] }}</p>
                <p class="text-[11px] font-mono text-[var(--text-muted)]">الرقم المرجعي: {{ $txn['id'] }}</p>
            </div>
        </div>

        <!-- Transaction Core Info Grid -->
        <div class="mt-6 grid grid-cols-2 sm:grid-cols-4 gap-4 bg-[var(--surface-subtle)] p-4 rounded-xl border border-[var(--border)] text-xs">
            <div>
                <span class="text-[var(--text-muted)] block text-[11px]">تاريخ ووقت المعاملة:</span>
                <span class="font-mono text-[var(--text-strong)] block mt-0.5">{{ $txn['date'] }}</span>
            </div>
            <div>
                <span class="text-[var(--text-muted)] block text-[11px]">طريقة السداد:</span>
                <span class="font-medium text-[var(--text-strong)] block mt-0.5">{{ $txn['method_label_ar'] }}</span>
            </div>
            <div>
                <span class="text-[var(--text-muted)] block text-[11px]">كود التحقق البنكي:</span>
                <span class="font-mono font-bold text-[var(--text-strong)] block mt-0.5">{{ $txn['reference'] }}</span>
            </div>
            <div>
                <span class="text-[var(--text-muted)] block text-[11px]">مسؤول التحصيل:</span>
                <span class="font-medium text-[var(--text-strong)] block mt-0.5">الخزينة الإلكترونية المعتمدة</span>
            </div>
        </div>

        <!-- Player & Guardian Dossier -->
        <div class="mt-6 space-y-4">
            <h3 class="text-xs font-semibold uppercase tracking-wider text-[var(--text-muted)] border-b border-[var(--border)] pb-2">بيانات المشترك والرسوم</h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                <div>
                    <span class="text-[var(--text-muted)] block text-[11px]">اسم اللاعب:</span>
                    <span class="text-sm font-bold text-[var(--text-strong)] mt-0.5 block">{{ $txn['player_name_ar'] }}</span>
                </div>
                <div>
                    <span class="text-[var(--text-muted)] block text-[11px]">اسم ولي الأمر:</span>
                    <span class="text-sm font-medium text-[var(--text-strong)] mt-0.5 block">{{ $txn['parent_name_ar'] }}</span>
                </div>
            </div>

            <!-- Receipt Breakdown Table -->
            <div class="border rounded-xl border-[var(--border)] overflow-hidden mt-4">
                <table class="w-full text-xs text-start">
                    <thead class="bg-[var(--surface-subtle)] text-[var(--text-muted)] font-medium border-b border-[var(--border)]">
                        <tr>
                            <th class="py-2.5 px-4 text-start">البند والتوصيف</th>
                            <th class="py-2.5 px-4 text-center">الفترة</th>
                            <th class="py-2.5 px-4 text-end">المبلغ المسدد</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[var(--border-subtle)] text-[var(--text-strong)]">
                        <tr>
                            <td class="py-3 px-4">
                                <span class="font-bold text-[var(--text-strong)] block">{{ $txn['package_ar'] ?? 'باقة التدريب الرسمية' }}</span>
                                <span class="text-[11px] text-[var(--text-muted)]">اشتراك تدريبي رسمي متضمن الرعاية والتأهيل</span>
                            </td>
                            <td class="py-3 px-4 text-center font-mono text-[var(--text-muted)]">مارس 2026</td>
                            <td class="py-3 px-4 text-end font-mono font-bold text-[var(--text-strong)]">{{ number_format($txn['amount']) }} ج.م</td>
                        </tr>
                    </tbody>
                    <tfoot class="border-t border-[var(--border)] bg-[var(--surface-subtle)] font-bold">
                        <tr>
                            <td colspan="2" class="py-3 px-4 text-end text-[var(--text-muted)]">الإجمالي المسدد فعلياً:</td>
                            <td class="py-3 px-4 text-end font-mono text-base text-[var(--text-strong)]">{{ number_format($txn['amount']) }} ج.م</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <!-- Official Footer / Signatures -->
        <div class="mt-8 pt-6 border-t border-[var(--border)] flex flex-col sm:flex-row items-center justify-between gap-6 text-xs text-[var(--text-muted)]">
            <div>
                <p>تم استخراج هذا الإيصال إلكترونياً ولا يحتاج إلى توقيع خطي إضافي.</p>
                <p class="text-[10px] text-[var(--text-muted)] mt-0.5">أكاديمية النسور لكرة القدم — سجل تجاري رقم 448102</p>
            </div>
            <div class="border border-[var(--border)] p-3 rounded-xl text-center w-36 bg-[var(--surface-subtle)]">
                <span class="block text-[10px] text-[var(--text-muted)]">خاتم الإدارة المالية</span>
                <span class="block text-xs font-bold text-[var(--text-strong)] mt-1 font-mono">EAGLES SC VERIFIED</span>
            </div>
        </div>
    </div>
</div>
@endsection
