<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สรุปต้นทุนรถ - {{ $car->brand }} {{ $car->model }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        * {
            font-family: 'Sarabun', sans-serif;
        }

        @media print {
            .no-print {
                display: none !important;
            }

            body {
                background: white;
                padding: 0;
                margin: 0;
            }

            .print-container {
                box-shadow: none !important;
                border: none !important;
                max-width: 100% !important;
                padding: 20px !important;
            }

            .section-card {
                break-inside: avoid;
                border: 1px solid #e5e7eb !important;
            }

            @page {
                margin: 15mm;
            }
        }
    </style>
</head>

<body class="bg-gray-100 min-h-screen">

    <!-- Top Bar (no print) -->
    <div class="no-print bg-white border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-3xl mx-auto px-4 py-3 flex items-center justify-between">
            <a href="{{ route('dashboard') }}"
                class="inline-flex items-center gap-2 text-gray-600 hover:text-blue-600 text-sm font-medium transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                กลับหน้าหลัก
            </a>
            <button onclick="window.print()"
                class="inline-flex items-center gap-2 bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                </svg>
                พิมพ์
            </button>
        </div>
    </div>

    @php
        $refurbCost = $car->refurbishments->sum('amount');
        $totalCost = $car->total_cost;
        $isSold = $car->status == 'sold';
        $soldPrice = $isSold ? $car->sold_price : null;
        $sellingPrice = $car->selling_price;
        $displayPrice = $isSold ? $soldPrice : $sellingPrice;
        $profit = $displayPrice ? ($displayPrice - $totalCost) : 0;
    @endphp

    <div class="max-w-3xl mx-auto px-4 py-6 print-container">

        <!-- Document Header -->
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">สรุปต้นทุนรถมือสอง 1 คัน</h1>
            <div class="w-16 h-1 bg-indigo-500 mx-auto mt-2 rounded-full"></div>
        </div>

        <!-- Car Info -->
        <div class="bg-white rounded-xl border border-gray-200 p-5 mb-5 section-card">
            <div class="flex items-start gap-4">
                @if($car->images->count() > 0)
                    <img src="{{ asset('img/' . $car->images->first()->path) }}" alt="Car"
                        class="w-20 h-16 object-cover rounded-lg flex-shrink-0">
                @endif
                <div class="flex-1">
                    <div class="text-lg font-bold text-gray-800">{{ $car->brand }} {{ $car->model }}</div>
                    <div class="text-sm text-gray-600 mt-1 space-y-0.5">
                        <div><strong>ปี:</strong> {{ $car->year }}</div>
                        <div><strong>สี:</strong> {{ $car->color }} · <strong>เกียร์:</strong>
                            {{ $car->transmission == 'A' || $car->transmission == 'Auto' ? 'ออโต้ (AT)' : 'ธรรมดา (MT)' }}
                        </div>
                        @if($car->license_plate)
                            <div><strong>ทะเบียน:</strong> {{ $car->license_plate }}</div>
                        @endif
                        <div><strong>วันที่ซื้อ:</strong>
                            {{ $car->purchase_date ? $car->purchase_date->format('d/m/Y') : '-' }}</div>
                        @if($car->notes)
                            <div><strong>หมายเหตุ:</strong> {{ $car->notes }}</div>
                        @endif
                    </div>
                </div>
                <div class="flex-shrink-0">
                    @if($isSold)
                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-700">ขายแล้ว</span>
                    @else
                        <span
                            class="px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700">อยู่ในสต็อก</span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Section 1: ราคาซื้อรถ -->
        <div class="bg-white rounded-xl border border-gray-200 p-5 mb-5 section-card">
            <h2 class="text-lg font-bold text-gray-800 mb-3">1. ราคาซื้อรถ</h2>
            <div class="border-t border-gray-100 pt-3">
                <div class="flex justify-between items-center py-2">
                    <span class="text-sm text-gray-600">• ราคารับซื้อรถจากเจ้าของเดิม</span>
                    <span class="text-sm font-bold text-gray-800">{{ number_format($car->purchase_price, 0) }}
                        บาท</span>
                </div>
            </div>
        </div>

        <!-- Section 2: ค่าปรับสภาพรถ -->
        <div class="bg-white rounded-xl border border-gray-200 p-5 mb-5 section-card">
            <h2 class="text-lg font-bold text-gray-800 mb-3">2. ค่าปรับสภาพรถ</h2>

            @if($car->refurbishments->count() > 0)
                <table class="w-full">
                    <thead>
                        <tr class="border-b-2 border-gray-200">
                            <th class="text-left text-sm font-semibold text-gray-600 py-2 w-10">ลำดับ</th>
                            <th class="text-left text-sm font-semibold text-gray-600 py-2">รายการ</th>
                            <th class="text-right text-sm font-semibold text-gray-600 py-2">ค่าใช้จ่าย</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($car->refurbishments as $index => $item)
                            <tr class="border-b border-gray-50">
                                <td class="text-sm text-gray-500 py-2.5">{{ $index + 1 }}</td>
                                <td class="text-sm text-gray-700 py-2.5">{{ $item->name }}</td>
                                <td class="text-sm text-gray-800 py-2.5 text-right">{{ number_format($item->amount, 0) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="border-t-2 border-gray-200">
                            <td colspan="2" class="text-sm font-bold text-gray-800 py-3">รวมค่าปรับสภาพ</td>
                            <td class="text-sm font-bold text-orange-600 py-3 text-right">
                                {{ number_format($refurbCost, 0) }} บาท
                            </td>
                        </tr>
                    </tfoot>
                </table>
            @else
                <p class="text-sm text-gray-400 py-3">— ไม่มีรายการปรับสภาพ —</p>
            @endif
        </div>

        <!-- Section 3: ต้นทุนรวม -->
        <div class="bg-white rounded-xl border border-gray-200 p-5 mb-5 section-card">
            <h2 class="text-lg font-bold text-gray-800 mb-3">3. ต้นทุนรวม</h2>
            <div class="space-y-2 border-t border-gray-100 pt-3">
                <div class="flex justify-between items-center py-1.5">
                    <span class="text-sm text-gray-600">• ราคาซื้อรถ</span>
                    <span class="text-sm text-gray-800">= {{ number_format($car->purchase_price, 0) }}</span>
                </div>
                <div class="flex justify-between items-center py-1.5">
                    <span class="text-sm text-gray-600">• ค่าปรับสภาพ</span>
                    <span class="text-sm text-gray-800">= {{ number_format($refurbCost, 0) }}</span>
                </div>
                <div class="flex justify-between items-center py-3 bg-slate-50 rounded-lg px-3 -mx-1 mt-2">
                    <span class="text-base font-bold text-gray-800">ต้นทุนรวม</span>
                    <span class="text-base font-bold text-gray-800">= {{ number_format($totalCost, 0) }} บาท</span>
                </div>
            </div>
        </div>

        <!-- Section 4: ราคาขาย -->
        <div class="bg-white rounded-xl border border-gray-200 p-5 mb-5 section-card">
            <h2 class="text-lg font-bold text-gray-800 mb-3">4. ราคาขาย</h2>
            <div class="border-t border-gray-100 pt-3 space-y-2">
                @if($sellingPrice)
                    <div class="flex justify-between items-center py-1.5">
                        <span class="text-sm text-gray-600">• ราคาตั้งขาย</span>
                        <span class="text-sm text-gray-800">= {{ number_format($sellingPrice, 0) }} บาท</span>
                    </div>
                @endif
                @if($isSold && $soldPrice)
                    <div class="flex justify-between items-center py-1.5">
                        <span class="text-sm text-gray-600">• ราคาขายจริง</span>
                        <span class="text-sm font-bold text-blue-600">= {{ number_format($soldPrice, 0) }} บาท</span>
                    </div>
                    <div class="text-xs text-gray-400 mt-1">ขายวันที่
                        {{ $car->sold_date ? $car->sold_date->format('d/m/Y') : '-' }}
                    </div>
                @elseif(!$sellingPrice)
                    <p class="text-sm text-gray-400 py-1.5">— ยังไม่ได้ตั้งราคาขาย —</p>
                @endif
            </div>
        </div>

        <!-- Section 5: สรุปกำไร -->
        <div
            class="bg-white rounded-xl border-2 {{ $profit >= 0 ? 'border-green-200' : 'border-red-200' }} p-5 mb-5 section-card">
            <h2 class="text-lg font-bold text-gray-800 mb-3">5. สรุปกำไร</h2>
            <div class="border-t border-gray-100 pt-3 space-y-2">
                @if($displayPrice)
                    <div class="flex justify-between items-center py-1.5">
                        <span class="text-sm text-gray-600">• {{ $isSold ? 'ราคาขาย' : 'ราคาตั้งขาย' }}</span>
                        <span class="text-sm text-gray-800">{{ number_format($displayPrice, 0) }}</span>
                    </div>
                    <div class="flex justify-between items-center py-1.5">
                        <span class="text-sm text-gray-600">• ต้นทุนรวม</span>
                        <span class="text-sm text-gray-800">{{ number_format($totalCost, 0) }}</span>
                    </div>
                    <div
                        class="flex justify-between items-center py-4 {{ $profit >= 0 ? 'bg-green-50' : 'bg-red-50' }} rounded-lg px-4 -mx-1 mt-3">
                        <span class="text-lg font-bold {{ $profit >= 0 ? 'text-green-700' : 'text-red-700' }}">
                            {{ $isSold ? 'กำไร' : 'กำไรคงเหลือจริง' }}
                        </span>
                        <span class="text-xl font-bold {{ $profit >= 0 ? 'text-green-600' : 'text-red-600' }}">
                            = {{ $profit >= 0 ? '+' : '' }}{{ number_format($profit, 0) }} บาท
                        </span>
                    </div>
                @else
                    <p class="text-sm text-gray-400 py-3">— ยังไม่สามารถคำนวณได้ (ยังไม่ตั้งราคาขาย) —</p>
                @endif
            </div>
        </div>

        <!-- Section 6: สรุป -->
        <div class="bg-white rounded-xl border border-gray-200 p-5 mb-5 section-card">
            <h2 class="text-lg font-bold text-gray-800 mb-3">✅ สรุป:</h2>
            <div class="space-y-2 text-sm text-gray-700">
                <div>• ต้นทุนรวม = <strong>{{ number_format($totalCost, 0) }}</strong> บาท</div>
                @if($displayPrice)
                    <div>• {{ $isSold ? 'ขาย' : 'ตั้งขาย' }} = <strong>{{ number_format($displayPrice, 0) }}</strong> บาท
                    </div>
                    <div>• {{ $isSold ? 'กำไร' : 'กำไรคงเหลือจริง' }} = <strong
                            class="{{ $profit >= 0 ? 'text-green-600' : 'text-red-600' }}">{{ $profit >= 0 ? '+' : '' }}{{ number_format($profit, 0) }}</strong>
                        บาท / คัน</div>
                @endif
            </div>
        </div>

        <!-- Timeline -->
        <div class="bg-white rounded-xl border border-gray-200 p-5 mb-5 section-card">
            <h2 class="text-lg font-bold text-gray-800 mb-3">📅 ไทม์ไลน์</h2>
            <div class="space-y-3 border-t border-gray-100 pt-3">
                <div class="flex items-center gap-3">
                    <div
                        class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center text-sm flex-shrink-0">
                        🛒</div>
                    <div>
                        <div class="text-sm font-medium text-gray-700">ซื้อเข้ามา</div>
                        <div class="text-xs text-gray-400">
                            {{ $car->purchase_date ? $car->purchase_date->format('d/m/Y') : '-' }}
                        </div>
                    </div>
                </div>
                @if($isSold && $car->sold_date)
                    <div class="flex items-center gap-3">
                        <div
                            class="w-8 h-8 bg-emerald-100 rounded-full flex items-center justify-center text-sm flex-shrink-0">
                            🤝</div>
                        <div>
                            <div class="text-sm font-medium text-gray-700">ขายออก</div>
                            <div class="text-xs text-gray-400">{{ $car->sold_date->format('d/m/Y') }}</div>
                        </div>
                    </div>
                    <div class="text-xs text-gray-400 ml-11">อยู่ในสต็อก
                        {{ (int) $car->purchase_date->diffInDays($car->sold_date) }} วัน
                    </div>
                @else
                    <div class="flex items-center gap-3">
                        <div
                            class="w-8 h-8 bg-amber-100 rounded-full flex items-center justify-center text-sm flex-shrink-0">
                            ⏳</div>
                        <div>
                            <div class="text-sm font-medium text-gray-700">อยู่ในสต็อก</div>
                            <div class="text-xs text-gray-400">
                                {{ $car->purchase_date ? (int) $car->purchase_date->diffInDays(now()) : 0 }} วันแล้ว
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center text-xs text-gray-400 py-4">
            พิมพ์จากระบบ CarStock Master — {{ now()->format('d/m/Y H:i') }}
        </div>

        <!-- Back Button (no print) -->
        <div class="no-print flex gap-3 mb-6">
            <a href="{{ route('dashboard') }}"
                class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium py-3 rounded-xl text-center text-sm transition">
                ← กลับ Dashboard
            </a>
            <button onclick="window.print()"
                class="flex-1 bg-indigo-500 hover:bg-indigo-600 text-white font-medium py-3 rounded-xl text-center text-sm transition">
                🖨️ พิมพ์
            </button>
        </div>
    </div>

</body>

</html>