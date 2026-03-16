<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายการประจำวัน - CarStock Master</title>
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
    <div class="bg-white border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-4xl mx-auto px-4 py-3 flex items-center justify-between">
            <a href="{{ route('dashboard') }}"
                class="inline-flex items-center gap-2 text-gray-600 hover:text-blue-600 text-sm font-medium transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                กลับหน้าหลัก
            </a>
            <h1 class="text-lg font-bold text-gray-800">📋 รายการประจำวัน</h1>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 py-6">

        <!-- Date Picker -->
        <div class="bg-white rounded-xl border border-gray-200 p-4 mb-5 flex items-center gap-4 flex-wrap">
            <label class="text-sm font-bold text-gray-700">📅 เลือกวันที่:</label>
            <input type="date" id="dateSelect" value="{{ $date }}"
                class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-400 focus:outline-none"
                onchange="window.location.href='/daily-log?date=' + this.value">
            <div class="flex gap-2">
                <button onclick="changeDate(-1)"
                    class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-3 py-2 rounded-lg text-sm font-medium transition">← ก่อนหน้า</button>
                <button onclick="changeDate(0)"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-lg text-sm font-medium transition">วันนี้</button>
                <button onclick="changeDate(1)"
                    class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-3 py-2 rounded-lg text-sm font-medium transition">ถัดไป →</button>
            </div>
            <div class="ml-auto">
                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-bold">
                    {{ $totalEntries }} รายการ
                </span>
            </div>
        </div>

        <!-- Date Title -->
        <div class="text-center mb-5">
            @php
                $displayDate = \Carbon\Carbon::parse($date)->addYears(543)->format('d/m/Y');
                $dayName = \Carbon\Carbon::parse($date)->locale('th')->dayName;
            @endphp
            <h2 class="text-xl font-bold text-gray-800">วัน{{ $dayName }}ที่ {{ $displayDate }}</h2>
            <div class="w-16 h-1 bg-blue-500 mx-auto mt-2 rounded-full"></div>
        </div>

        @if($totalEntries === 0)
            <div class="bg-white rounded-xl border border-gray-200 p-10 text-center">
                <div class="text-4xl mb-3">📭</div>
                <p class="text-gray-500 text-lg font-medium">ไม่มีรายการในวันนี้</p>
                <p class="text-gray-400 text-sm mt-1">ลองเลือกวันอื่นดูครับ</p>
            </div>
        @endif

        <!-- 🚗 Cars -->
        @if($cars->count() > 0)
        <div class="bg-white rounded-xl border border-gray-200 p-5 mb-4">
            <h3 class="text-lg font-bold text-blue-700 mb-3 flex items-center gap-2">
                🚗 รถยนต์ <span class="bg-blue-100 text-blue-800 text-xs px-2 py-0.5 rounded-full">{{ $cars->count() }}</span>
            </h3>
            <div class="space-y-3">
                @foreach($cars as $car)
                <div class="flex items-center gap-3 p-3 bg-blue-50/50 rounded-lg border border-blue-100">
                    @if($car->images->first())
                        <img src="{{ '/img/' . $car->images->first()->path }}" alt=""
                            class="w-14 h-14 object-contain bg-gray-50 rounded-lg border flex-shrink-0">
                    @else
                        <div class="w-14 h-14 bg-gray-100 rounded-lg flex items-center justify-center text-2xl flex-shrink-0">🚗</div>
                    @endif
                    <div class="flex-1 min-w-0">
                        <div class="text-sm font-bold text-gray-800 truncate">{{ $car->brand }} {{ $car->model }}</div>
                        <div class="text-xs text-gray-500">{{ $car->color }} • {{ $car->year }} • {{ $car->license_plate }}</div>
                    </div>
                    <div class="text-right flex-shrink-0">
                        <div class="text-sm font-bold text-blue-600">฿{{ number_format($car->cost_price, 0) }}</div>
                        <span class="text-xs px-2 py-0.5 rounded-full font-bold
                            {{ $car->status === 'stock' ? 'bg-green-100 text-green-700' : 'bg-purple-100 text-purple-700' }}">
                            {{ $car->status === 'stock' ? 'สต็อก' : 'ขายแล้ว' }}
                        </span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- 🔧 Parts -->
        @if($parts->count() > 0)
        <div class="bg-white rounded-xl border border-gray-200 p-5 mb-4">
            <h3 class="text-lg font-bold text-cyan-700 mb-3 flex items-center gap-2">
                🔧 อะไหล่ <span class="bg-cyan-100 text-cyan-800 text-xs px-2 py-0.5 rounded-full">{{ $parts->count() }}</span>
            </h3>
            <div class="space-y-3">
                @foreach($parts as $part)
                <div class="flex items-center gap-3 p-3 bg-cyan-50/50 rounded-lg border border-cyan-100">
                    <div class="w-10 h-10 bg-cyan-100 rounded-lg flex items-center justify-center text-xl flex-shrink-0">🔧</div>
                    <div class="flex-1 min-w-0">
                        <div class="text-sm font-bold text-gray-800 truncate">{{ $part->name }}</div>
                        <div class="text-xs text-gray-500">จำนวน {{ $part->quantity }} ชิ้น</div>
                    </div>
                    <div class="text-sm font-bold text-cyan-600">฿{{ number_format($part->price * $part->quantity, 0) }}</div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- 💰 Capital Expenses -->
        @if($capitalExpenses->count() > 0)
        <div class="bg-white rounded-xl border border-gray-200 p-5 mb-4">
            <h3 class="text-lg font-bold text-orange-700 mb-3 flex items-center gap-2">
                💰 ทุนอื่นๆ <span class="bg-orange-100 text-orange-800 text-xs px-2 py-0.5 rounded-full">{{ $capitalExpenses->count() }}</span>
            </h3>
            <div class="space-y-3">
                @foreach($capitalExpenses as $exp)
                <div class="flex items-center gap-3 p-3 bg-orange-50/50 rounded-lg border border-orange-100">
                    <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center text-xl flex-shrink-0">💰</div>
                    <div class="flex-1 min-w-0">
                        <div class="text-sm font-bold text-gray-800 truncate">{{ $exp->name }}</div>
                        <div class="text-xs text-gray-500">
                            {{ $exp->transaction_type === 'increase' ? '📈 เพิ่มทุน' : '📉 ลดทุน' }}
                            @if($exp->description) • {{ $exp->description }} @endif
                        </div>
                    </div>
                    <div class="text-sm font-bold text-orange-600">฿{{ number_format($exp->amount, 0) }}</div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- 💰 Capital Children (เพิ่ม/ลดทุน) -->
        @if($capitalChildren->count() > 0)
        <div class="bg-white rounded-xl border border-gray-200 p-5 mb-4">
            <h3 class="text-lg font-bold text-amber-700 mb-3 flex items-center gap-2">
                📊 เพิ่ม/ลดทุน <span class="bg-amber-100 text-amber-800 text-xs px-2 py-0.5 rounded-full">{{ $capitalChildren->count() }}</span>
            </h3>
            <div class="space-y-3">
                @foreach($capitalChildren as $child)
                <div class="flex items-center gap-3 p-3 bg-amber-50/50 rounded-lg border border-amber-100">
                    <div class="w-10 h-10 rounded-lg flex items-center justify-center text-xl flex-shrink-0
                        {{ $child->transaction_type === 'increase' ? 'bg-blue-100' : 'bg-emerald-100' }}">
                        {{ $child->transaction_type === 'increase' ? '📈' : '📉' }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="text-sm font-bold text-gray-800 truncate">{{ $child->name }}</div>
                        <div class="text-xs text-gray-500">
                            <span class="px-1.5 py-0.5 rounded-full text-xs font-bold
                                {{ $child->transaction_type === 'increase' ? 'bg-blue-100 text-blue-700' : 'bg-emerald-100 text-emerald-700' }}">
                                {{ $child->transaction_type === 'increase' ? 'เพิ่มทุน' : 'ลดทุน' }}
                            </span>
                            → {{ $child->parent->name ?? '-' }}
                        </div>
                    </div>
                    <div class="text-sm font-bold {{ $child->transaction_type === 'increase' ? 'text-blue-600' : 'text-emerald-600' }}">
                        {{ $child->transaction_type === 'increase' ? '+' : '-' }}฿{{ number_format($child->amount, 0) }}
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- 🧾 Necessary Expenses -->
        @if($necessaryExpenses->count() > 0)
        <div class="bg-white rounded-xl border border-gray-200 p-5 mb-4">
            <h3 class="text-lg font-bold text-red-700 mb-3 flex items-center gap-2">
                🧾 ค่าใช้จ่ายที่จำเป็น <span class="bg-red-100 text-red-800 text-xs px-2 py-0.5 rounded-full">{{ $necessaryExpenses->count() }}</span>
            </h3>
            <div class="space-y-3">
                @foreach($necessaryExpenses as $nec)
                <div class="flex items-center gap-3 p-3 bg-red-50/50 rounded-lg border border-red-100">
                    <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center text-xl flex-shrink-0">🧾</div>
                    <div class="flex-1 min-w-0">
                        <div class="text-sm font-bold text-gray-800 truncate">{{ $nec->name }}</div>
                        @if($nec->description)
                            <div class="text-xs text-gray-500">{{ $nec->description }}</div>
                        @endif
                    </div>
                    <div class="text-sm font-bold text-red-600">-฿{{ number_format($nec->amount, 0) }}</div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Back Button -->
        <div class="flex gap-3 mb-6 mt-6">
            <a href="{{ route('dashboard') }}"
                class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium py-3 rounded-xl text-center text-sm transition">
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
