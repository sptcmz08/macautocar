<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สรุปรายการทุนอื่นๆ - {{ $expense->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <script>
        tailwind.config = {
            theme: { extend: { fontFamily: { sans: ['Sarabun', 'sans-serif'] } } }
        }
    </script>
    <style>
        @media print {
            .no-print { display: none !important; }
            body { background: white; padding: 0; margin: 0; }
            .print-container { box-shadow: none !important; border: none !important; max-width: 100% !important; padding: 20px !important; }
            .section-card { break-inside: avoid; border: 1px solid #e5e7eb !important; }
            @page { margin: 15mm; }
        }
    </style>
</head>

<body class="bg-gray-100 min-h-screen font-sans">

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
        $isSold = ($expense->status ?? 'active') === 'sold';
        $decreases = $expense->decreases;
        $decreasesSum = $decreases->sum('amount');
        $remaining = $expense->amount - $decreasesSum;
        $soldPrice = $expense->sold_price ?? 0;
        $profit = $isSold ? ($soldPrice - $remaining) : 0;
    @endphp

    <div class="max-w-3xl mx-auto px-4 py-6 print-container">

        <!-- Document Header -->
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">สรุปรายการทุนอื่นๆ</h1>
            <div class="w-16 h-1 bg-orange-500 mx-auto mt-2 rounded-full"></div>
        </div>

        <!-- Expense Info -->
        <div class="bg-white rounded-xl border border-gray-200 p-5 mb-5 section-card">
            <div class="flex items-start gap-4">
                @if($expense->image)
                    <img src="{{ '/img/' . $expense->image }}" alt="{{ $expense->name }}"
                        class="w-20 h-20 object-cover rounded-lg flex-shrink-0 border">
                @else
                    <div class="w-20 h-20 bg-orange-50 rounded-lg flex-shrink-0 flex items-center justify-center">
                        <span class="text-3xl">💰</span>
                    </div>
                @endif
                <div class="flex-1">
                    <div class="text-lg font-bold text-gray-800">{{ $expense->name }}</div>
                    <div class="text-sm text-gray-600 mt-1 space-y-0.5">
                        <div><strong>วันที่:</strong> {{ \Carbon\Carbon::parse($expense->date)->addYears(543)->format('d/m/Y') }}</div>
                        <div><strong>ประเภท:</strong> {{ $expense->transaction_type == 'increase' ? '📈 เพิ่มทุน' : '📉 ลดทุน' }}</div>
                        @if($expense->description)
                            <div><strong>รายละเอียด:</strong> {{ $expense->description }}</div>
                        @endif
                    </div>
                </div>
                <div class="flex-shrink-0">
                    @if($isSold)
                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-purple-100 text-purple-700">ปิดขายแล้ว</span>
                    @else
                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700">ยังไม่ปิดขาย</span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Section 1: ทุนตั้งต้น -->
        <div class="bg-white rounded-xl border border-gray-200 p-5 mb-5 section-card">
            <h2 class="text-lg font-bold text-gray-800 mb-3">1. ทุนตั้งต้น</h2>
            <div class="border-t border-gray-100 pt-3">
                <div class="flex justify-between items-center py-2">
                    <span class="text-sm text-gray-600">• จำนวนเงินลงทุน</span>
                    <span class="text-sm font-bold text-orange-600">฿{{ number_format($expense->amount, 0) }}</span>
                </div>
            </div>
        </div>

        <!-- Section 2: รายการรับคืน -->
        <div class="bg-white rounded-xl border border-gray-200 p-5 mb-5 section-card">
            <h2 class="text-lg font-bold text-gray-800 mb-3">2. รายการรับคืน (ลดทุน)</h2>

            @if($decreases->count() > 0)
                <table class="w-full">
                    <thead>
                        <tr class="border-b-2 border-gray-200">
                            <th class="text-left text-sm font-semibold text-gray-600 py-2 w-10">ลำดับ</th>
                            <th class="text-left text-sm font-semibold text-gray-600 py-2">วันที่</th>
                            <th class="text-left text-sm font-semibold text-gray-600 py-2">รายการ</th>
                            <th class="text-right text-sm font-semibold text-gray-600 py-2">จำนวนเงิน</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($decreases as $index => $decrease)
                            <tr class="border-b border-gray-50">
                                <td class="text-sm text-gray-500 py-2.5">{{ $index + 1 }}</td>
                                <td class="text-sm text-gray-500 py-2.5">{{ \Carbon\Carbon::parse($decrease->date)->addYears(543)->format('d/m/Y') }}</td>
                                <td class="text-sm text-gray-700 py-2.5">{{ $decrease->name }}</td>
                                <td class="text-sm text-emerald-600 font-bold py-2.5 text-right">฿{{ number_format($decrease->amount, 0) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="border-t-2 border-gray-200">
                            <td colspan="3" class="text-sm font-bold text-gray-800 py-3">รวมรับคืน</td>
                            <td class="text-sm font-bold text-emerald-600 py-3 text-right">
                                ฿{{ number_format($decreasesSum, 0) }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            @else
                <p class="text-sm text-gray-400 py-3 border-t border-gray-100">— ยังไม่มีรายการรับคืน —</p>
            @endif
        </div>

        <!-- Section 3: ทุนคงเหลือ -->
        <div class="bg-white rounded-xl border border-gray-200 p-5 mb-5 section-card">
            <h2 class="text-lg font-bold text-gray-800 mb-3">3. ทุนคงเหลือ</h2>
            <div class="space-y-2 border-t border-gray-100 pt-3">
                <div class="flex justify-between items-center py-1.5">
                    <span class="text-sm text-gray-600">• ทุนตั้งต้น</span>
                    <span class="text-sm text-gray-800">฿{{ number_format($expense->amount, 0) }}</span>
                </div>
                <div class="flex justify-between items-center py-1.5">
                    <span class="text-sm text-gray-600">• หัก: รับคืนแล้ว</span>
                    <span class="text-sm text-emerald-600">- ฿{{ number_format($decreasesSum, 0) }}</span>
                </div>
                <div class="flex justify-between items-center py-3 bg-slate-50 rounded-lg px-3 -mx-1 mt-2">
                    <span class="text-base font-bold text-gray-800">ทุนคงเหลือ</span>
                    <span class="text-base font-bold text-blue-600">= ฿{{ number_format($remaining, 0) }}</span>
                </div>
            </div>
        </div>

        @if($isSold)
            <!-- Section 4: การปิดขาย -->
            <div class="bg-white rounded-xl border border-gray-200 p-5 mb-5 section-card">
                <h2 class="text-lg font-bold text-gray-800 mb-3">4. การปิดขาย</h2>
                <div class="border-t border-gray-100 pt-3 space-y-2">
                    <div class="flex justify-between items-center py-1.5">
                        <span class="text-sm text-gray-600">• ราคาขาย</span>
                        <span class="text-sm font-bold text-purple-600">฿{{ number_format($soldPrice, 0) }}</span>
                    </div>
                    @if($expense->sold_date)
                        <div class="text-xs text-gray-400 mt-1">ปิดขายวันที่
                            {{ \Carbon\Carbon::parse($expense->sold_date)->addYears(543)->format('d/m/Y') }}
                        </div>
                    @endif
                </div>
            </div>

            <!-- Section 5: สรุปกำไร -->
            <div class="bg-white rounded-xl border-2 {{ $profit >= 0 ? 'border-green-200' : 'border-red-200' }} p-5 mb-5 section-card">
                <h2 class="text-lg font-bold text-gray-800 mb-3">5. สรุปกำไร/ขาดทุน</h2>
                <div class="border-t border-gray-100 pt-3 space-y-2">
                    <div class="flex justify-between items-center py-1.5">
                        <span class="text-sm text-gray-600">• ราคาขาย</span>
                        <span class="text-sm text-gray-800">฿{{ number_format($soldPrice, 0) }}</span>
                    </div>
                    <div class="flex justify-between items-center py-1.5">
                        <span class="text-sm text-gray-600">• ทุนคงเหลือ (ตอนขาย)</span>
                        <span class="text-sm text-gray-800">฿{{ number_format($remaining, 0) }}</span>
                    </div>
                    <div class="flex justify-between items-center py-4 {{ $profit >= 0 ? 'bg-green-50' : 'bg-red-50' }} rounded-lg px-4 -mx-1 mt-3">
                        <span class="text-lg font-bold {{ $profit >= 0 ? 'text-green-700' : 'text-red-700' }}">
                            {{ $profit >= 0 ? 'กำไร' : 'ขาดทุน' }}
                        </span>
                        <span class="text-xl font-bold {{ $profit >= 0 ? 'text-green-600' : 'text-red-600' }}">
                            = {{ $profit >= 0 ? '+' : '' }}฿{{ number_format($profit, 0) }}
                        </span>
                    </div>
                </div>
            </div>
        @endif

        <!-- สรุป -->
        <div class="bg-white rounded-xl border border-gray-200 p-5 mb-5 section-card">
            <h2 class="text-lg font-bold text-gray-800 mb-3">✅ สรุป:</h2>
            <div class="space-y-2 text-sm text-gray-700">
                <div>• ทุนตั้งต้น = <strong>฿{{ number_format($expense->amount, 0) }}</strong></div>
                <div>• รับคืนแล้ว = <strong class="text-emerald-600">฿{{ number_format($decreasesSum, 0) }}</strong></div>
                <div>• ทุนคงเหลือ = <strong class="text-blue-600">฿{{ number_format($remaining, 0) }}</strong></div>
                @if($isSold)
                    <div>• ราคาขาย = <strong class="text-purple-600">฿{{ number_format($soldPrice, 0) }}</strong></div>
                    <div>• {{ $profit >= 0 ? 'กำไร' : 'ขาดทุน' }} = <strong class="{{ $profit >= 0 ? 'text-green-600' : 'text-red-600' }}">{{ $profit >= 0 ? '+' : '' }}฿{{ number_format($profit, 0) }}</strong></div>
                @endif
            </div>
        </div>

        <!-- Timeline -->
        <div class="bg-white rounded-xl border border-gray-200 p-5 mb-5 section-card">
            <h2 class="text-lg font-bold text-gray-800 mb-3">📅 ไทม์ไลน์</h2>
            <div class="space-y-3 border-t border-gray-100 pt-3">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center text-sm flex-shrink-0">💰</div>
                    <div>
                        <div class="text-sm font-medium text-gray-700">ลงทุน ฿{{ number_format($expense->amount, 0) }}</div>
                        <div class="text-xs text-gray-400">{{ \Carbon\Carbon::parse($expense->date)->addYears(543)->format('d/m/Y') }}</div>
                    </div>
                </div>
                @foreach($decreases->sortBy('date') as $decrease)
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-emerald-100 rounded-full flex items-center justify-center text-sm flex-shrink-0">💵</div>
                        <div>
                            <div class="text-sm font-medium text-gray-700">รับคืน: {{ $decrease->name }} — ฿{{ number_format($decrease->amount, 0) }}</div>
                            <div class="text-xs text-gray-400">{{ \Carbon\Carbon::parse($decrease->date)->addYears(543)->format('d/m/Y') }}</div>
                        </div>
                    </div>
                @endforeach
                @if($isSold)
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center text-sm flex-shrink-0">🤝</div>
                        <div>
                            <div class="text-sm font-medium text-gray-700">ปิดขาย ฿{{ number_format($soldPrice, 0) }}</div>
                            <div class="text-xs text-gray-400">{{ $expense->sold_date ? \Carbon\Carbon::parse($expense->sold_date)->addYears(543)->format('d/m/Y') : '-' }}</div>
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
