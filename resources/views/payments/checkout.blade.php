@extends('layouts.admin', ['title' => 'بوابة السداد والتحصيل التجريبي — EAGLE CHECKOUT'])

@section('content')
<div class="space-y-6 font-arabic" x-data="{
    unpaidPlayers: {{ json_encode($unpaidPlayers) }},
    selectedPlayerId: {{ $selectedPlayerId }},
    selectedPlayer: {{ json_encode($selectedPlayer) }},
    paymentMethod: 'instapay', // 'instapay', 'card', 'cash', 'bank'
    promoCode: '',
    discountPercent: 0,
    discountAmount: 0,
    promoApplied: false,
    promoError: '',
    cardData: { number: '4123 4567 8901 2345', expiry: '08/28', cvv: '789', name: 'كابتن / ولي الأمر' },
    instapayRef: 'IPN-' + Math.floor(100000 + Math.random() * 900000),
    cashierName: 'أحمد وجدي (أمين الخزينة)',
    isProcessing: false,
    isSuccess: false,
    generatedReceipt: null,

    init() {
        this.syncPlayer();
    },

    syncPlayer() {
        const p = this.unpaidPlayers.find(item => item.id == this.selectedPlayerId);
        if (p) {
            this.selectedPlayer = p;
            this.calculateTotal();
        }
    },

    applyPromo() {
        const code = this.promoCode.trim().toUpperCase();
        this.promoError = '';
        if (code === 'EAGLE10') {
            this.discountPercent = 10;
            this.promoApplied = true;
            window.$toast?.success('تم تطبيق خصم 10% (منحة التفوق الكروي)', 'كوبون الخصم');
        } else if (code === 'SC2026') {
            this.discountPercent = 15;
            this.promoApplied = true;
            window.$toast?.success('تم تطبيق خصم 15% (كوبون افتتاح الموسم 2026)', 'كوبون الخصم');
        } else if (code === 'CAPTAIN') {
            this.discountPercent = 0;
            this.discountAmount = 100;
            this.promoApplied = true;
            window.$toast?.success('تم تطبيق خصم 100 ج.م (حافز كابتن الفريق)', 'كوبون الخصم');
        } else {
            this.promoError = 'كود الخصم غير صحيح. جرّب: EAGLE10 أو SC2026';
            this.promoApplied = false;
            this.discountPercent = 0;
            this.discountAmount = 0;
        }
        this.calculateTotal();
    },

    getBaseAmount() {
        return this.selectedPlayer?.sub_remaining || 1800;
    },

    getDiscountValue() {
        if (this.discountAmount > 0) return this.discountAmount;
        if (this.discountPercent > 0) return Math.round((this.getBaseAmount() * this.discountPercent) / 100);
        return 0;
    },

    getTotal() {
        return Math.max(0, this.getBaseAmount() - this.getDiscountValue());
    },

    calculateTotal() {
        // Trigger reactive recalculation
    },

    processPayment() {
        this.isProcessing = true;
        setTimeout(() => {
            this.isProcessing = false;
            const rcpNo = 'RCP-2026-' + Math.floor(1000 + Math.random() * 9000);
            const txnNo = 'TXN-2026-' + Math.floor(8000 + Math.random() * 2000);
            this.generatedReceipt = {
                receiptNo: rcpNo,
                txnNo: txnNo,
                player_name: this.selectedPlayer.name_ar,
                package: this.selectedPlayer.package_ar || 'اشتراك شهري معتمد',
                amount: this.getTotal(),
                method: this.paymentMethod,
                methodLabel: this.getMethodLabel(),
                date: new Date().toLocaleDateString('ar-EG', { year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' })
            };
            this.isSuccess = true;
            window.$toast?.success('تم تسجيل السداد وإصدار الإيصال المالي رقم ' + rcpNo, 'التحصيل المالي');
        }, 1200);
    },

    getMethodLabel() {
        switch(this.paymentMethod) {
            case 'instapay': return 'شبكة المدفوعات اللحظية (InstaPay)';
            case 'card': return 'بطاقة بنكية (فيزا / ماستركارد)';
            case 'cash': return 'خزينة الأكاديمية (نقدي)';
            case 'bank': return 'تحويل مصرفي مباشر (CIB)';
            default: return 'سداد إلكتروني';
        }
    }
}">

    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 pb-1 border-b border-[var(--border)]">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded text-[11px] font-bold bg-[#E3131B]/10 text-[#E3131B] border border-[#E3131B]/20">
                    <i data-lucide="shield-check" class="w-3.5 h-3.5"></i>
                    <span>EAGLE FINANCIAL DESK</span>
                </span>
                <span class="text-xs font-bold text-[var(--text-muted)]">محاكاة تدقيق مالي تجريبي معتمد</span>
            </div>
            <h1 class="text-2xl font-black text-[var(--text-strong)] tracking-tight">بوابة التحصيل المالي وإصدار الإيصالات الرسمية</h1>
            <p class="text-xs text-[var(--text-muted)] mt-0.5">تسوية مستحقات الاشتراكات الشهرية، رسوم المعسكرات، واختبارات المعايشة</p>
        </div>

        <div class="flex items-center gap-2">
            <a href="{{ route('payments.index') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-[var(--surface)] border border-[var(--border)] hover:bg-[var(--surface-subtle)] rounded-lg text-xs font-bold text-[var(--text-strong)] shadow-2xs transition-colors">
                <i data-lucide="arrow-right" class="w-3.5 h-3.5 rtl:rotate-0 ltr:rotate-180 text-[var(--text-muted)]"></i>
                <span>العودة للمتابعة المالية</span>
            </a>
            <a href="{{ route('payments.transactions') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-[var(--text-strong)] hover:opacity-90 rounded-lg text-xs font-bold text-[var(--surface)] shadow-2xs transition-opacity">
                <i data-lucide="list-ordered" class="w-3.5 h-3.5"></i>
                <span>سجل المقبوضات</span>
            </a>
        </div>
    </div>

    <!-- Safety Disclaimer Notice Banner -->
    <div class="rounded-xl border border-amber-200 bg-amber-50/70 p-3.5 flex items-start gap-3">
        <i data-lucide="info" class="w-5 h-5 text-amber-700 shrink-0 mt-0.5"></i>
        <div class="text-xs text-amber-900 leading-relaxed">
            <strong class="font-black block mb-0.5">إشعار نظام المحاكاة المالية المعتمد:</strong>
            هذه الشاشة مخصصة للعرض التقديمي وتدقيق الإجراءات المحاسبية للأكاديمية. لا تتم أي خصومات بنكية فعلية أو تحويلات نقدية حقيقية عبر هذه المنظومة التجريبية.
        </div>
    </div>

    <!-- Main Checkout Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start" x-show="!isSuccess">
        
        <!-- Left 2 Cols: Invoice Selection & Payment Channel -->
        <div class="lg:col-span-2 space-y-6">

            <!-- 1. Invoice & Player Selection -->
            <div class="bg-[var(--surface)] rounded-xl border border-[var(--border)] p-5 shadow-2xs space-y-4">
                <div class="flex items-center justify-between pb-3 border-b border-[var(--border)]">
                    <div class="flex items-center gap-2">
                        <span class="w-6 h-6 rounded-full bg-[var(--text-strong)] text-[var(--surface)] text-xs font-black flex items-center justify-center">1</span>
                        <h3 class="text-sm font-bold text-[var(--text-strong)]">تحديد الفاتورة ومستحقات اللاعب</h3>
                    </div>
                    <span class="text-[11px] font-mono text-[var(--text-muted)]" x-text="unpaidPlayers.length + ' فواتير معلقة'"></span>
                </div>

                <!-- Selector Dropdown -->
                <div>
                    <label class="text-xs font-bold text-[var(--text-muted)] block mb-1.5">اختر حساب اللاعب المطلوب تسوية اشتراكه:</label>
                    <select 
                        x-model="selectedPlayerId" 
                        @change="syncPlayer()" 
                        class="w-full p-2.5 rounded-lg border border-[var(--border)] bg-[var(--surface-subtle)] text-xs font-bold text-[var(--text-strong)] focus:bg-[var(--surface)] focus:outline-none focus:border-[#E3131B]"
                    >
                        <template x-for="p in unpaidPlayers" :key="p.id">
                            <option :value="p.id" x-text="p.name_ar + ' (' + p.age_group + ') — المتبقي: ' + p.sub_remaining + ' ج.م'"></option>
                        </template>
                    </select>
                </div>

                <!-- Selected Player Info Card -->
                <div class="bg-[var(--surface-subtle)] rounded-xl border border-[var(--border)] p-4 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-xl bg-[var(--surface)] border border-[var(--border)] flex items-center justify-center text-sm font-black text-[#E3131B]">
                            <span x-text="selectedPlayer?.name_ar ? selectedPlayer.name_ar.substring(0, 2) : 'نس'"></span>
                        </div>
                        <div>
                            <h4 class="text-sm font-black text-[var(--text-strong)]" x-text="selectedPlayer?.name_ar"></h4>
                            <p class="text-xs text-[var(--text-muted)] mt-0.5">
                                الفريق: <span class="font-bold text-[var(--text-strong)]" x-text="selectedPlayer?.age_group"></span> • 
                                ولي الأمر: <span class="font-medium text-[var(--text-strong)]" x-text="selectedPlayer?.parent_name_ar"></span>
                            </p>
                            <p class="text-[11px] text-[var(--text-muted)] font-mono mt-0.5" x-text="selectedPlayer?.parent_phone"></p>
                        </div>
                    </div>

                    <div class="text-start sm:text-end sm:border-s border-gray-200 sm:ps-5">
                        <span class="text-[11px] text-[var(--text-muted)] block font-bold">المستحق الحالي المطلوب:</span>
                        <div class="flex items-baseline gap-1 mt-0.5">
                            <span class="text-2xl font-black text-[#E3131B] font-mono" x-text="getBaseAmount().toLocaleString()"></span>
                            <span class="text-xs font-bold text-[var(--text-muted)]">ج.م</span>
                        </div>
                        <span class="text-[10px] text-amber-700 font-semibold block mt-0.5">استحقاق اشتراك مارس 2026</span>
                    </div>
                </div>
            </div>

            <!-- 2. Payment Method Selector -->
            <div class="bg-[var(--surface)] rounded-xl border border-[var(--border)] p-5 shadow-2xs space-y-4">
                <div class="flex items-center justify-between pb-3 border-b border-[var(--border)]">
                    <div class="flex items-center gap-2">
                        <span class="w-6 h-6 rounded-full bg-[var(--text-strong)] text-[var(--surface)] text-xs font-black flex items-center justify-center">2</span>
                        <h3 class="text-sm font-bold text-[var(--text-strong)]">قناة التحصيل وطريقة الدفع</h3>
                    </div>
                    <span class="text-[11px] font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded">بوابات متعددة معتمدة</span>
                </div>

                <!-- Methods Grid Tabs -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                    <!-- InstaPay -->
                    <button 
                        type="button"
                        @click="paymentMethod = 'instapay'"
                        :class="paymentMethod === 'instapay' ? 'border-[#E3131B] bg-red-50/30 text-[var(--text-strong)] ring-1 ring-[#E3131B]' : 'border-[var(--border)] bg-[var(--surface)] text-[var(--text-muted)] hover:border-gray-300'"
                        class="p-3.5 rounded-xl border text-center transition-all flex flex-col items-center gap-2"
                    >
                        <div class="w-8 h-8 rounded-lg bg-[var(--surface)] border border-[var(--border)] flex items-center justify-center text-[#E3131B] font-black text-xs shadow-2xs">
                            ⚡
                        </div>
                        <span class="text-xs font-black">إنستاباي (InstaPay)</span>
                        <span class="text-[10px] text-[var(--text-muted)]">تحويل فوري لحظي</span>
                    </button>

                    <!-- Credit / Debit Card -->
                    <button 
                        type="button"
                        @click="paymentMethod = 'card'"
                        :class="paymentMethod === 'card' ? 'border-[#E3131B] bg-red-50/30 text-[var(--text-strong)] ring-1 ring-[#E3131B]' : 'border-[var(--border)] bg-[var(--surface)] text-[var(--text-muted)] hover:border-gray-300'"
                        class="p-3.5 rounded-xl border text-center transition-all flex flex-col items-center gap-2"
                    >
                        <i data-lucide="credit-card" class="w-8 h-8 text-[var(--text-strong)]"></i>
                        <span class="text-xs font-black">بطاقة بنكية (فيزا)</span>
                        <span class="text-[10px] text-[var(--text-muted)]">Visa / Mastercard</span>
                    </button>

                    <!-- Cash Treasury -->
                    <button 
                        type="button"
                        @click="paymentMethod = 'cash'"
                        :class="paymentMethod === 'cash' ? 'border-[#E3131B] bg-red-50/30 text-[var(--text-strong)] ring-1 ring-[#E3131B]' : 'border-[var(--border)] bg-[var(--surface)] text-[var(--text-muted)] hover:border-gray-300'"
                        class="p-3.5 rounded-xl border text-center transition-all flex flex-col items-center gap-2"
                    >
                        <i data-lucide="banknote" class="w-8 h-8 text-emerald-600"></i>
                        <span class="text-xs font-black">خزينة الأكاديمية</span>
                        <span class="text-[10px] text-[var(--text-muted)]">توريد نقدي فوري</span>
                    </button>

                    <!-- Bank Wire -->
                    <button 
                        type="button"
                        @click="paymentMethod = 'bank'"
                        :class="paymentMethod === 'bank' ? 'border-[#E3131B] bg-red-50/30 text-[var(--text-strong)] ring-1 ring-[#E3131B]' : 'border-[var(--border)] bg-[var(--surface)] text-[var(--text-muted)] hover:border-gray-300'"
                        class="p-3.5 rounded-xl border text-center transition-all flex flex-col items-center gap-2"
                    >
                        <i data-lucide="building-2" class="w-8 h-8 text-sky-700"></i>
                        <span class="text-xs font-black">تحويل مصرفي</span>
                        <span class="text-[10px] text-[var(--text-muted)]">CIB / الأهلي</span>
                    </button>
                </div>

                <!-- Channel Specific Input Details -->
                <div class="pt-3">
                    <!-- 1. InstaPay Channel Details -->
                    <div x-show="paymentMethod === 'instapay'" class="bg-[var(--surface-subtle)] rounded-xl border border-[var(--border)] p-4 space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold text-[var(--text-strong)]">بيانات التحويل عبر InstaPay IPA:</span>
                            <span class="text-xs font-mono font-black text-[#E3131B] bg-red-50 px-2 py-0.5 rounded border border-red-200">eagles.sc@instapay</span>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs">
                            <div>
                                <label class="text-[11px] font-bold text-[var(--text-muted)] block mb-1">اسم الحساب المستلم:</label>
                                <input type="text" readonly value="أكاديمية النسور الرياضية EAGLE'S SC" class="w-full p-2 bg-[var(--surface)] rounded border border-[var(--border)] font-bold text-[var(--text)]">
                            </div>
                            <div>
                                <label class="text-[11px] font-bold text-[var(--text-muted)] block mb-1">رقم مرجع التحويل (IPN Reference):</label>
                                <input type="text" x-model="instapayRef" class="w-full p-2 bg-[var(--surface)] rounded border border-[var(--border)] font-mono font-bold text-[var(--text-strong)]">
                            </div>
                        </div>
                    </div>

                    <!-- 2. Card Channel Details -->
                    <div x-show="paymentMethod === 'card'" class="bg-[var(--surface-subtle)] rounded-xl border border-[var(--border)] p-4 space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold text-[var(--text-strong)]">بيانات بطاقة السداد الإلكتروني:</span>
                            <span class="text-[11px] text-emerald-600 font-bold flex items-center gap-1">
                                <i data-lucide="lock" class="w-3 h-3"></i>
                                <span>تشفير تجريبي آمن 256-bit</span>
                            </span>
                        </div>
                        <div class="space-y-3 text-xs">
                            <div>
                                <label class="text-[11px] font-bold text-[var(--text-muted)] block mb-1">رقم البطاقة:</label>
                                <input type="text" x-model="cardData.number" class="w-full p-2 bg-[var(--surface)] rounded border border-[var(--border)] font-mono font-bold text-[var(--text-strong)] text-start" dir="ltr">
                            </div>
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="text-[11px] font-bold text-[var(--text-muted)] block mb-1">تاريخ الصلاحية (MM/YY):</label>
                                    <input type="text" x-model="cardData.expiry" class="w-full p-2 bg-[var(--surface)] rounded border border-[var(--border)] font-mono font-bold text-[var(--text-strong)] text-center" dir="ltr">
                                </div>
                                <div>
                                    <label class="text-[11px] font-bold text-[var(--text-muted)] block mb-1">رمز الأمان (CVV):</label>
                                    <input type="password" maxlength="3" value="•••" class="w-full p-2 bg-[var(--surface)] rounded border border-[var(--border)] font-mono font-bold text-[var(--text-strong)] text-center" dir="ltr">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 3. Cash Treasury Details -->
                    <div x-show="paymentMethod === 'cash'" class="bg-[var(--surface-subtle)] rounded-xl border border-[var(--border)] p-4 space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold text-[var(--text-strong)]">اعتماد توريد الخزينة بمقر الأكاديمية:</span>
                            <span class="text-xs font-bold text-[var(--text-muted)]">خزينة الفرع الرئيسي - استاد النسور</span>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs">
                            <div>
                                <label class="text-[11px] font-bold text-[var(--text-muted)] block mb-1">أمين الخزينة المسؤول:</label>
                                <input type="text" x-model="cashierName" class="w-full p-2 bg-[var(--surface)] rounded border border-[var(--border)] font-bold text-gray-800">
                            </div>
                            <div>
                                <label class="text-[11px] font-bold text-[var(--text-muted)] block mb-1">رقم سند القبض الورقي:</label>
                                <input type="text" readonly value="BND-2026-449" class="w-full p-2 bg-[var(--surface)] rounded border border-[var(--border)] font-mono font-bold text-[var(--text)]">
                            </div>
                        </div>
                    </div>

                    <!-- 4. Bank Wire Details -->
                    <div x-show="paymentMethod === 'bank'" class="bg-[var(--surface-subtle)] rounded-xl border border-[var(--border)] p-4 space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold text-[var(--text-strong)]">حساب البنك التجاري الدولي (CIB):</span>
                            <span class="text-xs font-mono font-bold text-[var(--text-strong)]">CIB - فرع الدقي</span>
                        </div>
                        <div class="space-y-1.5 text-xs">
                            <div class="flex items-center justify-between bg-[var(--surface)] p-2 rounded border border-[var(--border)]">
                                <span class="text-gray-500 font-bold">رقم الحساب:</span>
                                <span class="font-mono font-bold text-[var(--text-strong)]">1000 4892 0184</span>
                            </div>
                            <div class="flex items-center justify-between bg-[var(--surface)] p-2 rounded border border-[var(--border)]">
                                <span class="text-gray-500 font-bold">رقم الآيبان (IBAN):</span>
                                <span class="font-mono font-bold text-[var(--text-strong)]" dir="ltr">EG38 0002 0001 0000 0012 3456 7890</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Right Col: Promo Code & Fee Calculation Breakdown Ledger -->
        <div class="space-y-6">
            
            <!-- Promo Code Card -->
            <div class="bg-[var(--surface)] rounded-xl border border-[var(--border)] p-5 shadow-2xs space-y-3">
                <h3 class="text-sm font-bold text-[var(--text-strong)] flex items-center gap-1.5">
                    <i data-lucide="tag" class="w-4 h-4 text-[#E3131B]"></i>
                    <span>كوبون الخصم أو منحة التفوق</span>
                </h3>
                <div class="flex items-center gap-2">
                    <input 
                        type="text" 
                        x-model="promoCode" 
                        placeholder="جرب: EAGLE10 أو SC2026" 
                        class="flex-1 p-2 text-xs font-mono uppercase rounded-lg border border-[var(--border)] bg-[var(--surface-subtle)] focus:bg-[var(--surface)] focus:outline-none focus:border-[#E3131B]"
                    >
                    <button 
                        type="button" 
                        @click="applyPromo()"
                        class="px-3.5 py-2 bg-[var(--text-strong)] hover:opacity-90 text-[var(--surface)] text-xs font-bold rounded-lg transition-opacity cursor-pointer"
                    >
                        تطبيق
                    </button>
                </div>
                <template x-if="promoApplied">
                    <div class="text-[11px] font-bold text-emerald-700 bg-emerald-50 p-2 rounded border border-emerald-200 flex items-center justify-between">
                        <span>تم تفعيل الكوبون بنجاح</span>
                        <span x-text="discountPercent > 0 ? discountPercent + '% خصم' : discountAmount + ' ج.م'"></span>
                    </div>
                </template>
                <template x-if="promoError">
                    <div class="text-[11px] font-semibold text-rose-700 bg-rose-50 p-2 rounded border border-rose-200" x-text="promoError"></div>
                </template>
            </div>

            <!-- Ledger Summary -->
            <div class="bg-[var(--surface)] rounded-xl border border-[var(--border)] p-5 shadow-2xs space-y-4">
                <h3 class="text-sm font-bold text-[var(--text-strong)] pb-2 border-b border-[var(--border)]">بيان التسوية والحساب المالي</h3>

                <div class="space-y-2.5 text-xs text-[var(--text-muted)]">
                    <div class="flex items-center justify-between">
                        <span>المبلغ المستحق الأصلي:</span>
                        <span class="font-mono font-bold text-[var(--text-strong)]" x-text="getBaseAmount().toLocaleString() + ' ج.م'"></span>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <span>رسوم التشغيل الإداري:</span>
                        <span class="font-bold text-emerald-600">مجانية (0.00 ج.م)</span>
                    </div>

                    <template x-if="getDiscountValue() > 0">
                        <div class="flex items-center justify-between text-emerald-700 font-bold">
                            <span>قيمة الخصم المعتمد:</span>
                            <span class="font-mono" x-text="'- ' + getDiscountValue().toLocaleString() + ' ج.م'"></span>
                        </div>
                    </template>

                    <div class="pt-3 border-t border-[var(--border)] flex items-baseline justify-between">
                        <div>
                            <span class="text-xs font-black text-[var(--text-strong)] block">صافي المبلغ المطلوب:</span>
                            <span class="text-[10px] text-[var(--text-muted)]">شامل ضريبة القيمة المضافة</span>
                        </div>
                        <div class="flex items-baseline gap-1">
                            <span class="text-3xl font-black text-[#E3131B] font-mono" x-text="getTotal().toLocaleString()"></span>
                            <span class="text-xs font-bold text-[var(--text-strong)]">ج.م</span>
                        </div>
                    </div>
                </div>

                <!-- Submit Action Button -->
                <button 
                    type="button" 
                    @click="processPayment()"
                    :disabled="isProcessing"
                    class="w-full py-3.5 bg-[#E3131B] hover:bg-[#c00f16] disabled:bg-gray-400 text-white text-xs font-black rounded-xl shadow-xs transition-all flex items-center justify-center gap-2"
                >
                    <template x-if="!isProcessing">
                        <span class="flex items-center gap-2">
                            <i data-lucide="check-circle-2" class="w-4 h-4"></i>
                            <span>تأكيد السداد التجريبي وإصدار الإيصال</span>
                        </span>
                    </template>
                    <template x-if="isProcessing">
                        <span class="flex items-center gap-2">
                            <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                            </svg>
                            <span>جارٍ قيد العملية بالدفتر المالي...</span>
                        </span>
                    </template>
                </button>

                <p class="text-[10px] text-center text-[var(--text-muted)]">
                    بإتمام العملية سيتم توليد إيصال رسمي رقمي قابل للطباعة والحفظ
                </p>
            </div>

        </div>

    </div>

    <!-- SUCCESS CONFIRMATION STATE MODAL / HERO -->
    <div x-show="isSuccess" x-cloak class="max-w-2xl mx-auto bg-[var(--surface)] rounded-2xl border border-[var(--border)] p-8 shadow-xl text-center space-y-6">
        <div class="w-16 h-16 rounded-full bg-emerald-50 border border-emerald-200 text-emerald-600 flex items-center justify-center mx-auto">
            <i data-lucide="check" class="w-8 h-8 stroke-[3]"></i>
        </div>

        <div>
            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded text-[11px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 mb-2">
                <span>تم السداد وقيد الإيصال بنجاح</span>
            </span>
            <h2 class="text-2xl font-black text-[var(--text-strong)]">تمت عملية التحصيل المالي المعتمدة</h2>
            <p class="text-xs text-[var(--text-muted)] mt-1">تم توثيق العملية بالدفتر المحاسبي للأكاديمية وتحديث موقف اللاعب</p>
        </div>

        <!-- Receipt Summary Box -->
        <div class="bg-[var(--surface-subtle)] rounded-xl border border-[var(--border)] p-5 text-start space-y-2.5 text-xs">
            <div class="flex items-center justify-between pb-2 border-b border-gray-200">
                <span class="text-[var(--text-muted)]">رقم الإيصال الرسمي:</span>
                <span class="font-mono font-black text-[#E3131B]" x-text="generatedReceipt?.receiptNo"></span>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-[var(--text-muted)]">رقم المعاملة (Txn ID):</span>
                <span class="font-mono font-bold text-[var(--text-strong)]" x-text="generatedReceipt?.txnNo"></span>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-[var(--text-muted)]">اللاعب المسدد عنه:</span>
                <span class="font-black text-[var(--text-strong)]" x-text="generatedReceipt?.player_name"></span>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-[var(--text-muted)]">الباقة / نوع السداد:</span>
                <span class="text-[var(--text-strong)]" x-text="generatedReceipt?.package"></span>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-[var(--text-muted)]">طريقة التحصيل:</span>
                <span class="font-bold text-[var(--text-strong)]" x-text="generatedReceipt?.methodLabel"></span>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-[var(--text-muted)]">التاريخ والوقت:</span>
                <span class="font-mono text-gray-600" x-text="generatedReceipt?.date"></span>
            </div>
            <div class="pt-2 border-t border-gray-200 flex items-center justify-between">
                <span class="font-bold text-[var(--text-strong)]">المبلغ المحصّل:</span>
                <span class="text-xl font-black font-mono text-emerald-700" x-text="generatedReceipt?.amount?.toLocaleString() + ' ج.م'"></span>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex flex-col sm:flex-row items-center justify-center gap-3 pt-2">
            <a 
                :href="'{{ route('payments.receipt') }}?id=' + (generatedReceipt?.txnNo || 'TXN-2026-8901') + '&player_name=' + encodeURIComponent(generatedReceipt?.player_name || '') + '&amount=' + (generatedReceipt?.amount || 0)"
                class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-[#E3131B] hover:bg-[#c00f16] text-white text-xs font-bold rounded-lg shadow-xs transition-colors"
            >
                <i data-lucide="printer" class="w-4 h-4"></i>
                <span>عرض وطباعة الإيصال الرسمي</span>
            </a>
            <button 
                @click="isSuccess = false; promoApplied = false; promoCode = '';"
                class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-[var(--surface)] border border-[var(--border)] hover:bg-[var(--surface-subtle)] text-xs font-bold text-[var(--text-strong)] rounded-lg transition-colors"
            >
                <i data-lucide="plus" class="w-4 h-4 text-gray-500"></i>
                <span>تسجيل عملية سداد جديدة</span>
            </button>
        </div>
    </div>

</div>
@endsection

