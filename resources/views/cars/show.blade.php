@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto">
        <!-- Back Button -->
        <a href="{{ route('dashboard') }}"
            class="inline-flex items-center gap-1 text-gray-500 hover:text-blue-600 text-sm mb-4 transition">
            ← กลับหน้าหลัก
        </a>

        @php
            $refurbCost = $car->refurbishments->sum('amount');
            $totalCost = $car->total_cost;
            $isSold = $car->status == 'sold';
            $displayPrice = $isSold ? $car->sold_price : $car->selling_price;
            $profit = $displayPrice ? ($displayPrice - $totalCost) : 0;
        @endphp

        <!-- Car Header Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-4">
            <!-- Status Bar -->
            <div
                class="px-5 py-2 {{ $isSold ? 'bg-blue-50 border-b border-blue-100' : ($car->is_profit_stock ? 'bg-amber-50 border-b border-amber-100' : 'bg-emerald-50 border-b border-emerald-100') }}">
                <div class="flex items-center justify-between">
                    <span
                        class="text-xs font-bold {{ $isSold ? 'text-blue-600' : ($car->is_profit_stock ? 'text-amber-600' : 'text-emerald-600') }}">
                        {{ $isSold ? '🔵 ขายแล้ว' : ($car->is_profit_stock ? '🟡 ทุนอื่นๆ' : '🟢 อยู่ในสต็อก') }}
                    </span>
                    @if($isSold && $car->sold_date)
                        <span class="text-xs text-gray-500">ขายวันที่ {{ $car->sold_date->format('d/m/Y') }}</span>
                    @endif
                </div>
            </div>

            <div class="p-5">
                <!-- Car Images -->
                @if($car->images->count() > 0)
                    <div class="flex gap-2 overflow-x-auto pb-3 mb-4 -mx-1 px-1">
                        @foreach($car->images as $image)
                            <img src="{{ asset('img/' . $image->path) }}" alt="Car"
                                class="w-24 h-20 object-cover rounded-xl shadow-sm flex-shrink-0">
                        @endforeach
                    </div>
                @endif

                <!-- Car Title -->
                <div class="flex items-start justify-between">
                    <div>
                        <h1 class="text-xl font-bold text-gray-800">{{ $car->brand }} {{ $car->model }}</h1>
                        <div class="flex flex-wrap items-center gap-2 mt-1 text-sm text-gray-500">
                            <span>ปี {{ $car->year }}</span>
                            <span>·</span>
                            <span class="inline-flex items-center gap-1">
                                <span class="w-2.5 h-2.5 rounded-full inline-block border border-gray-200"
                                    style="background: {{ $car->color == 'ขาว' ? '#e5e7eb' : ($car->color == 'ดำ' ? '#374151' : ($car->color == 'เทา' ? '#9ca3af' : ($car->color == 'เงิน' ? '#d1d5db' : ($car->color == 'น้ำเงิน' ? '#3b82f6' : ($car->color == 'แดง' ? '#ef4444' : '#f59e0b'))))) }};"></span>
                                {{ $car->color }}
                            </span>
                            <span>·</span>
                            <span>{{ $car->transmission == 'A' || $car->transmission == 'Auto' ? 'ออโต้' : 'เกียร์ธรรมดา' }}</span>
                        </div>
                        @if($car->license_plate)
                            <div class="text-sm text-blue-500 font-medium mt-1">🔖 {{ $car->license_plate }}</div>
                        @endif
                        @if($car->notes)
                            <div class="text-sm text-amber-600 font-medium mt-1">📝 {{ $car->notes }}</div>
                        @endif
                    </div>
                    @if($car->branch)
                        <span class="px-3 py-1 rounded-full text-xs font-semibold"
                            style="background-color: {{ $car->branch->color }}20; color: {{ $car->branch->color }}">
                            {{ $car->branch->name }}
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Financial Summary -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 mb-4">
            <h2 class="text-sm font-bold text-gray-800 mb-3">💰 สรุปการเงิน</h2>

            <div class="space-y-2">
                <!-- Purchase -->
                <div class="flex justify-between items-center py-2.5 border-b border-gray-50">
                    <span class="text-sm text-gray-600">ราคาซื้อ</span>
                    <span class="text-sm font-bold text-gray-800">฿{{ number_format($car->purchase_price, 0) }}</span>
                </div>

                <!-- Refurb Total -->
                <div class="flex justify-between items-center py-2.5 border-b border-gray-50">
                    <span class="text-sm text-gray-600">ค่าปรับสภาพรวม</span>
                    <span class="text-sm font-bold text-orange-600">฿{{ number_format($refurbCost, 0) }}</span>
                </div>

                <!-- Total Cost (highlighted) -->
                <div class="flex justify-between items-center py-3 bg-slate-50 rounded-xl px-3 -mx-1">
                    <span class="text-sm font-bold text-slate-700">ต้นทุนรวม</span>
                    <span class="text-base font-bold text-slate-800">฿{{ number_format($totalCost, 0) }}</span>
                </div>

                <!-- Selling/Sold Price -->
                <div class="flex justify-between items-center py-2.5 border-b border-gray-50">
                    <span class="text-sm text-gray-600">{{ $isSold ? 'ราคาขายจริง' : 'ราคาตั้งขาย' }}</span>
                    <span
                        class="text-sm font-bold text-blue-600">{{ $displayPrice ? '฿' . number_format($displayPrice, 0) : '-' }}</span>
                </div>

                <!-- Profit (highlighted) -->
                @if($displayPrice)
                    <div
                        class="flex justify-between items-center py-3 {{ $profit >= 0 ? 'bg-emerald-50' : 'bg-red-50' }} rounded-xl px-3 -mx-1">
                        <span class="text-sm font-bold {{ $profit >= 0 ? 'text-emerald-700' : 'text-red-700' }}">
                            {{ $isSold ? 'กำไรจริง' : 'กำไรคาดการณ์' }}
                        </span>
                        <span class="text-base font-bold {{ $profit >= 0 ? 'text-emerald-600' : 'text-red-600' }}">
                            {{ $profit >= 0 ? '+' : '' }}฿{{ number_format($profit, 0) }}
                        </span>
                    </div>
                @endif
            </div>
        </div>

        <!-- Refurbishment Details -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 mb-4">
            <div class="flex items-center justify-between mb-3">
                <h2 class="text-sm font-bold text-gray-800">🔧 รายการปรับสภาพ</h2>
                <span class="text-xs text-gray-400">{{ $car->refurbishments->count() }} รายการ</span>
            </div>

            @if($car->refurbishments->count() > 0)
                <div class="space-y-1">
                    @foreach($car->refurbishments as $index => $item)
                        <div class="flex justify-between items-center py-2.5 {{ !$loop->last ? 'border-b border-gray-50' : '' }}">
                            <div class="flex items-center gap-2">
                                <span
                                    class="w-5 h-5 bg-orange-100 text-orange-600 rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0">{{ $index + 1 }}</span>
                                <span class="text-sm text-gray-700">{{ $item->name }}</span>
                            </div>
                            <span class="text-sm font-medium text-orange-600">฿{{ number_format($item->amount, 0) }}</span>
                        </div>
                    @endforeach
                </div>
                <div class="mt-3 pt-3 border-t border-gray-100 flex justify-between items-center">
                    <span class="text-sm font-bold text-gray-600">รวมค่าปรับสภาพ</span>
                    <span class="text-sm font-bold text-orange-600">฿{{ number_format($refurbCost, 0) }}</span>
                </div>
            @else
                <div class="text-center py-6 text-gray-400 text-sm">
                    ยังไม่มีรายการปรับสภาพ
                </div>
            @endif
        </div>

        <!-- Timeline / Key Dates -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 mb-4">
            <h2 class="text-sm font-bold text-gray-800 mb-3">📅 ไทม์ไลน์</h2>
            <div class="space-y-3">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center text-sm">🛒</div>
                    <div>
                        <div class="text-sm font-medium text-gray-700">ซื้อเข้ามา</div>
                        <div class="text-xs text-gray-400">
                            {{ $car->purchase_date ? $car->purchase_date->format('d/m/Y') : '-' }}</div>
                    </div>
                </div>
                @if($isSold && $car->sold_date)
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-emerald-100 rounded-full flex items-center justify-center text-sm">🤝</div>
                        <div>
                            <div class="text-sm font-medium text-gray-700">ขายออก</div>
                            <div class="text-xs text-gray-400">{{ $car->sold_date->format('d/m/Y') }}</div>
                        </div>
                    </div>
                    @php
                        $daysInStock = $car->purchase_date->diffInDays($car->sold_date);
                    @endphp
                    <div class="text-xs text-gray-400 ml-11">อยู่ในสต็อก {{ $daysInStock }} วัน</div>
                @else
                    @php
                        $daysInStock = $car->purchase_date ? $car->purchase_date->diffInDays(now()) : 0;
                    @endphp
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center text-sm">⏳</div>
                        <div>
                            <div class="text-sm font-medium text-gray-700">อยู่ในสต็อก</div>
                            <div class="text-xs text-gray-400">{{ $daysInStock }} วันแล้ว</div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Action Button -->
        <div class="flex gap-3 mb-6">
            <a href="{{ route('dashboard') }}"
                class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-3 rounded-xl text-center text-sm transition">
                ← กลับ Dashboard
            </a>
        </div>
    </div>
@endsection