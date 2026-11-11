@extends('layouts.admin', ['title' => __('app.nav.users')])

@section('content')
<div class="space-y-6 font-arabic">
    <x-page-header 
        :title="__('app.nav.users')" 
        subtitle="إدارة حسابات المسؤولين، المشرفين، الأجهزة الفنية، ومستويات الصلاحيات والأمان"
        badge="أمان وصلاحيات RBAC"
    >
        <x-slot:actions>
            <button class="inline-flex items-center gap-2 rounded-lg bg-red-600 px-3.5 py-2 text-xs font-bold text-white shadow-xs hover:bg-red-700 transition-colors">
                <i data-lucide="user-plus" class="h-4 w-4"></i>
                <span>إضافة مستخدم إداري جديد</span>
            </button>
        </x-slot:actions>
    </x-page-header>

    <div class="rounded-xl border border-gray-200/80 bg-[var(--surface)] shadow-2xs overflow-hidden">
        <div class="p-4 border-b border-gray-200/80 flex items-center justify-between bg-[var(--surface-subtle)]/50">
            <div>
                <h3 class="text-sm font-bold text-[var(--text-strong)]">سجل حسابات الإدارة المعتمدة</h3>
                <p class="text-xs text-[var(--text-muted)]">حسابات نشطة ومحمية بخاصية المصادقة الثنائية (2FA)</p>
            </div>
            <span class="text-xs font-mono font-bold text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded border border-emerald-100">
                4 حسابات نشطة
            </span>
        </div>

        <table class="w-full text-xs text-start">
            <thead class="bg-[var(--surface-subtle)]/80 text-gray-500 uppercase text-[11px] font-bold border-b border-gray-200/80">
                <tr>
                    <th class="py-3 px-4 text-start">المستخدم</th>
                    <th class="py-3 px-4 text-start">البريد الإلكتروني</th>
                    <th class="py-3 px-4 text-start">الدور الوظيفي</th>
                    <th class="py-3 px-4 text-start">آخر تسجيل دخول</th>
                    <th class="py-3 px-4 text-start">الحالة</th>
                    <th class="py-3 px-4 text-end">إدارة الصلاحيات</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-[var(--text)]">
                @foreach($users as $u)
                    <tr class="hover:bg-[var(--surface-subtle)]/60 transition-colors">
                        <td class="py-3.5 px-4 font-bold text-[var(--text-strong)] flex items-center gap-2.5">
                            <div class="h-8 w-8 rounded-lg bg-[var(--text-strong)] text-[var(--surface)] flex items-center justify-center font-bold text-xs">
                                🦅
                            </div>
                            <span>{{ $u['name_ar'] }}</span>
                        </td>
                        <td class="py-3.5 px-4 text-gray-500 font-mono">{{ $u['email'] }}</td>
                        <td class="py-3.5 px-4">
                            <span class="px-2 py-0.5 rounded text-[11px] font-bold bg-red-50 text-red-700 border border-red-100">
                                {{ $u['role_ar'] }}
                            </span>
                        </td>
                        <td class="py-3.5 px-4 text-[var(--text-muted)] font-mono text-[11px]">{{ $u['last_login'] }}</td>
                        <td class="py-3.5 px-4"><x-status-badge status="active" /></td>
                        <td class="py-3.5 px-4 text-end">
                            <button class="rounded-lg border border-gray-200 bg-[var(--surface)] px-2.5 py-1 text-[11px] font-bold text-[var(--text)] hover:bg-[var(--surface-subtle)] transition-colors">
                                تعديل الصلاحيات
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
