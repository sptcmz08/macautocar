<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ลิสประจำวัน - CarStock Master</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <script>
        tailwind.config = {
            theme: { extend: { fontFamily: { sans: ['Sarabun', 'sans-serif'] } } }
        }
    </script>
</head>

<body class="bg-gray-100 min-h-screen font-sans">

    <!-- Top Bar -->
    <div class="bg-white border-b border-gray-200 sticky top-0 z-50 shadow-sm">
        <div class="max-w-2xl mx-auto px-4 py-3 flex items-center justify-between">
            <a href="{{ route('dashboard') }}"
                class="inline-flex items-center gap-2 text-gray-600 hover:text-blue-600 text-sm font-medium transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                กลับ
            </a>
            <h1 class="text-lg font-bold text-gray-800">📋 ลิสประจำวัน</h1>
            <div class="w-12"></div>
        </div>
    </div>

    <div class="max-w-2xl mx-auto px-4 py-5">

        <!-- Date Picker -->
        <div class="bg-white rounded-xl border border-gray-200 p-4 mb-4">
            <div class="flex items-center gap-3 flex-wrap">
                <label class="text-sm font-bold text-gray-700">📅</label>
                <input type="date" id="dateSelect" value="{{ $date }}"
                    class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-400 focus:outline-none flex-1 min-w-[130px]"
                    onchange="window.location.href='/daily-log?date=' + this.value">
                <div class="flex gap-1">
                    <button onclick="changeDate(-1)"
                        class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-2.5 py-2 rounded-lg text-xs font-bold transition">◀</button>
                    <button onclick="changeDate(0)"
                        class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-lg text-xs font-bold transition">วันนี้</button>
                    <button onclick="changeDate(1)"
                        class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-2.5 py-2 rounded-lg text-xs font-bold transition">▶</button>
                </div>
            </div>
        </div>

        <!-- Receipt Card -->
        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm">
            <!-- Header -->
            <div class="bg-gradient-to-r from-slate-800 to-slate-700 text-white p-5 text-center">
                @php
                    $displayDate = \Carbon\Carbon::parse($date)->addYears(543)->format('d/m/Y');
                    $dayName = \Carbon\Carbon::parse($date)->locale('th')->dayName;
                @endphp
                <h2 class="text-xl font-bold">🧾 ลิสประจำวัน</h2>
                <p class="text-white/70 text-sm mt-1">วัน{{ $dayName }}ที่ {{ $displayDate }}</p>
                <div class="mt-3 inline-block bg-white/20 rounded-full px-4 py-1 text-sm font-bold">
                    {{ $totalEntries }} รายการ
                </div>
            </div>

            <!-- Body -->
            <div class="p-5">
                @if($totalEntries === 0)
                    <div class="text-center py-10">
                        <div class="text-4xl mb-3">📭</div>
                        <p class="text-gray-400 text-lg font-medium">ไม่มีรายการในวันนี้</p>
                        <p class="text-gray-300 text-sm mt-1">ลองเลือกวันอื่นดูครับ</p>
                    </div>
                @else
                    @php $itemNo = 0; @endphp

                    {{-- ===== จ่ายออก (Expenses) ===== --}}
                    @if($cars->count() > 0 || $parts->count() > 0 || $capitalExpenses->count() > 0
                        || $capitalChildren->where('transaction_type', 'increase')->count() > 0
                        || $necessaryExpenses->count() > 0 || $refurbishments->count() > 0
                        || $personalTransactions->where('type', 'expense')->count() > 0)
                        <div class="mb-6">
                            <div class="flex items-center gap-2 mb-3">
                                <div class="w-2 h-2 bg-red-500 rounded-full"></div>
                                <h3 class="text-sm font-bold text-red-700 uppercase tracking-wide">💸 จ่ายออก</h3>
                            </div>

                            <div class="space-y-0 divide-y divide-gray-100">
                                {{-- Cars --}}
                                @foreach($cars as $car)
                                    @php $itemNo++; @endphp
                                    <div class="flex items-start gap-3 py-3">
                                        <span class="text-xs text-gray-400 font-bold mt-1 w-5 flex-shrink-0">{{ $itemNo }}.</span>
                                        <div class="flex-1 min-w-0">
                                            <div class="text-sm font-bold text-gray-800">🚗 {{ $car->brand }} {{ $car->model }}</div>
                                            <div class="text-xs text-gray-500">{{ $car->color }} • ปี{{ $car->year }} • {{ $car->license_plate }}</div>
                                        </div>
                                        <div class="text-sm font-bold text-red-600 flex-shrink-0">-฿{{ number_format($car->cost_price, 0) }}</div>
                                    </div>
                                @endforeach

                                {{-- Parts --}}
                                @foreach($parts as $part)
                                    @php $itemNo++; @endphp
                                    <div class="flex items-start gap-3 py-3">
                                        <span class="text-xs text-gray-400 font-bold mt-1 w-5 flex-shrink-0">{{ $itemNo }}.</span>
                                        <div class="flex-1 min-w-0">
                                            <div class="text-sm font-bold text-gray-800">🔧 {{ $part->name }}</div>
                                            <div class="text-xs text-gray-500">จำนวน {{ $part->quantity }} ชิ้น × ฿{{ number_format($part->price, 0) }}</div>
                                        </div>
                                        <div class="text-sm font-bold text-red-600 flex-shrink-0">-฿{{ number_format($part->price * $part->quantity, 0) }}</div>
                                    </div>
                                @endforeach

                                {{-- Capital Expenses (new parent) --}}
                                @foreach($capitalExpenses as $exp)
                                    @php $itemNo++; @endphp
                                    <div class="flex items-start gap-3 py-3">
                                        <span class="text-xs text-gray-400 font-bold mt-1 w-5 flex-shrink-0">{{ $itemNo }}.</span>
                                        <div class="flex-1 min-w-0">
                                            <div class="text-sm font-bold text-gray-800">💰 {{ $exp->name }}</div>
                                            <div class="text-xs text-gray-500">ทุนอื่นๆ (ใหม่)</div>
                                        </div>
                                        <div class="text-sm font-bold text-red-600 flex-shrink-0">-฿{{ number_format($exp->amount, 0) }}</div>
                                    </div>
                                @endforeach

                                {{-- Capital Children: เพิ่มทุน --}}
                                @foreach($capitalChildren->where('transaction_type', 'increase') as $child)
                                    @php $itemNo++; @endphp
                                    <div class="flex items-start gap-3 py-3">
                                        <span class="text-xs text-gray-400 font-bold mt-1 w-5 flex-shrink-0">{{ $itemNo }}.</span>
                                        <div class="flex-1 min-w-0">
                                            <div class="text-sm font-bold text-gray-800">📈 {{ $child->name }}</div>
                                            <div class="text-xs text-gray-500">เพิ่มทุน → {{ $child->parent->name ?? '-' }}</div>
                                        </div>
                                        <div class="text-sm font-bold text-red-600 flex-shrink-0">-฿{{ number_format($child->amount, 0) }}</div>
                                    </div>
                                @endforeach

                                {{-- Refurbishments --}}
                                @foreach($refurbishments as $ref)
                                    @php $itemNo++; @endphp
                                    <div class="flex items-start gap-3 py-3">
                                        <span class="text-xs text-gray-400 font-bold mt-1 w-5 flex-shrink-0">{{ $itemNo }}.</span>
                                        <div class="flex-1 min-w-0">
                                            <div class="text-sm font-bold text-gray-800">🔨 {{ $ref->description ?? 'ปรับสภาพ' }}</div>
                                            <div class="text-xs text-gray-500">รถ: {{ $ref->car->brand ?? '' }} {{ $ref->car->model ?? '' }}</div>
                                        </div>
                                        <div class="text-sm font-bold text-red-600 flex-shrink-0">-฿{{ number_format($ref->cost, 0) }}</div>
                                    </div>
                                @endforeach

                                {{-- Necessary Expenses --}}
                                @foreach($necessaryExpenses as $nec)
                                    @php $itemNo++; @endphp
                                    <div class="flex items-start gap-3 py-3">
                                        <span class="text-xs text-gray-400 font-bold mt-1 w-5 flex-shrink-0">{{ $itemNo }}.</span>
                                        <div class="flex-1 min-w-0">
                                            <div class="text-sm font-bold text-gray-800">🧾 {{ $nec->name }}</div>
                                            @if($nec->description)
                                                <div class="text-xs text-gray-500">{{ $nec->description }}</div>
                                            @endif
                                        </div>
                                        <div class="text-sm font-bold text-red-600 flex-shrink-0">-฿{{ number_format($nec->amount, 0) }}</div>
                                    </div>
                                @endforeach

                                {{-- Personal Expense --}}
                                @foreach($personalTransactions->where('type', 'expense') as $pt)
                                    @php $itemNo++; @endphp
                                    <div class="flex items-start gap-3 py-3">
                                        <span class="text-xs text-gray-400 font-bold mt-1 w-5 flex-shrink-0">{{ $itemNo }}.</span>
                                        <div class="flex-1 min-w-0">
                                            <div class="text-sm font-bold text-gray-800">💳 {{ $pt->description ?? 'ส่วนตัว' }}</div>
                                            <div class="text-xs text-gray-500">บัญชีส่วนตัว (จ่าย)</div>
                                        </div>
                                        <div class="text-sm font-bold text-red-600 flex-shrink-0">-฿{{ number_format($pt->amount, 0) }}</div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Subtotal: จ่ายออก -->
                            <div class="flex justify-between items-center bg-red-50 rounded-lg px-4 py-3 mt-2 border border-red-100">
                                <span class="text-sm font-bold text-red-700">รวมจ่ายออก</span>
                                <span class="text-base font-bold text-red-600">-฿{{ number_format($totalExpense, 0) }}</span>
                            </div>
                        </div>
                    @endif

                    {{-- ===== รับเข้า (Income) ===== --}}
                    @if($soldCars->count() > 0 || $capitalChildren->where('transaction_type', 'decrease')->count() > 0
                        || $personalTransactions->where('type', 'income')->count() > 0)
                        <div class="mb-6">
                            <div class="flex items-center gap-2 mb-3">
                                <div class="w-2 h-2 bg-emerald-500 rounded-full"></div>
                                <h3 class="text-sm font-bold text-emerald-700 uppercase tracking-wide">💰 รับเข้า</h3>
                            </div>

                            <div class="space-y-0 divide-y divide-gray-100">
                                {{-- Sold Cars --}}
                                @foreach($soldCars as $sold)
                                    @php $itemNo++; @endphp
                                    <div class="flex items-start gap-3 py-3">
                                        <span class="text-xs text-gray-400 font-bold mt-1 w-5 flex-shrink-0">{{ $itemNo }}.</span>
                                        <div class="flex-1 min-w-0">
                                            <div class="text-sm font-bold text-gray-800">🚗 ขาย {{ $sold->brand }} {{ $sold->model }}</div>
                                            <div class="text-xs text-gray-500">{{ $sold->license_plate }}</div>
                                        </div>
                                        <div class="text-sm font-bold text-emerald-600 flex-shrink-0">+฿{{ number_format($sold->sold_price, 0) }}</div>
                                    </div>
                                @endforeach

                                {{-- Capital Children: ลดทุน/รับคืน --}}
                                @foreach($capitalChildren->where('transaction_type', 'decrease') as $child)
                                    @php $itemNo++; @endphp
                                    <div class="flex items-start gap-3 py-3">
                                        <span class="text-xs text-gray-400 font-bold mt-1 w-5 flex-shrink-0">{{ $itemNo }}.</span>
                                        <div class="flex-1 min-w-0">
                                            <div class="text-sm font-bold text-gray-800">📉 {{ $child->name }}</div>
                                            <div class="text-xs text-gray-500">ลดทุน/รับคืน ← {{ $child->parent->name ?? '-' }}</div>
                                        </div>
                                        <div class="text-sm font-bold text-emerald-600 flex-shrink-0">+฿{{ number_format($child->amount, 0) }}</div>
                                    </div>
                                @endforeach

                                {{-- Personal Income --}}
                                @foreach($personalTransactions->where('type', 'income') as $pt)
                                    @php $itemNo++; @endphp
                                    <div class="flex items-start gap-3 py-3">
                                        <span class="text-xs text-gray-400 font-bold mt-1 w-5 flex-shrink-0">{{ $itemNo }}.</span>
                                        <div class="flex-1 min-w-0">
                                            <div class="text-sm font-bold text-gray-800">💳 {{ $pt->description ?? 'ส่วนตัว' }}</div>
                                            <div class="text-xs text-gray-500">บัญชีส่วนตัว (รับ)</div>
                                        </div>
                                        <div class="text-sm font-bold text-emerald-600 flex-shrink-0">+฿{{ number_format($pt->amount, 0) }}</div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Subtotal: รับเข้า -->
                            <div class="flex justify-between items-center bg-emerald-50 rounded-lg px-4 py-3 mt-2 border border-emerald-100">
                                <span class="text-sm font-bold text-emerald-700">รวมรับเข้า</span>
                                <span class="text-base font-bold text-emerald-600">+฿{{ number_format($totalIncome, 0) }}</span>
                            </div>
                        </div>
                    @endif

                    {{-- ===== Grand Total ===== --}}
                    <div class="border-t-2 border-dashed border-gray-300 pt-4 mt-2">
                        <div class="bg-gradient-to-r from-slate-800 to-slate-700 rounded-xl p-4 text-white">
                            <div class="grid grid-cols-2 gap-3 text-center mb-3">
                                <div class="bg-red-500/20 rounded-lg py-2 px-3">
                                    <p class="text-xs text-red-200">จ่ายออก</p>
                                    <p class="text-base font-bold text-red-300">-฿{{ number_format($totalExpense, 0) }}</p>
                                </div>
                                <div class="bg-emerald-500/20 rounded-lg py-2 px-3">
                                    <p class="text-xs text-emerald-200">รับเข้า</p>
                                    <p class="text-base font-bold text-emerald-300">+฿{{ number_format($totalIncome, 0) }}</p>
                                </div>
                            </div>
                            @php $netFlow = $totalIncome - $totalExpense; @endphp
                            <div class="text-center border-t border-white/20 pt-3">
                                <p class="text-xs text-white/60">สุทธิวันนี้</p>
                                <p class="text-2xl font-bold {{ $netFlow >= 0 ? 'text-emerald-300' : 'text-red-300' }}">
                                    {{ $netFlow >= 0 ? '+' : '' }}฿{{ number_format($netFlow, 0) }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Back Button -->
        <div class="mt-5 mb-8">
            <a href="{{ route('dashboard') }}"
                class="block bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium py-3 rounded-xl text-center text-sm transition">
                ← กลับ Dashboard
            </a>
        </div>
    </div>

    <script>
        function changeDate(offset) {
            const input = document.getElementById('dateSelect');
            if (offset === 0) {
                const today = new Date();
                input.value = today.toISOString().split('T')[0];
            } else {
                let d = new Date(input.value);
                d.setDate(d.getDate() + offset);
                input.value = d.toISOString().split('T')[0];
            }
            window.location.href = '/daily-log?date=' + input.value;
        }
    </script>

</body>

</html>
