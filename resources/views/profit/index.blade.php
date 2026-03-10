<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายละเอียดกำไร - CarStock Master</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --primary: #3b82f6;
            --primary-dark: #1e40af;
            --accent: #f59e0b;
        }

        body {
            font-family: 'Sarabun', sans-serif;
            background: linear-gradient(135deg, #f0f4f8 0%, #e2e8f0 100%);
            min-height: 100vh;
        }

        .glass {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .premium-header {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 50%, #1e293b 100%);
            position: relative;
            overflow: hidden;
        }

        .premium-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(139, 92, 246, 0.1) 0%, transparent 50%);
            animation: pulse-bg 15s ease-in-out infinite;
        }

        @keyframes pulse-bg {

            0%,
            100% {
                transform: translate(0, 0) scale(1);
            }

            50% {
                transform: translate(-10%, -10%) scale(1.1);
            }
        }

        .glow-text {
            text-shadow: 0 0 20px rgba(139, 92, 246, 0.5);
        }

        .stat-card {
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.95) 0%, rgba(248, 250, 252, 0.95) 100%);
            border-radius: 20px;
            padding: 24px;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.2);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, var(--primary), var(--accent));
            border-radius: 20px 20px 0 0;
        }

        .premium-shadow {
            box-shadow: 0 10px 40px -10px rgba(0, 0, 0, 0.15);
        }

        .chart-container {
            background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
            border-radius: 20px;
            padding: 24px;
        }

        .progress-ring {
            animation: progress-fill 2s ease-out forwards;
        }

        @keyframes progress-fill {
            from {
                stroke-dashoffset: 283;
            }
        }
    </style>
</head>

<body class="p-4 md:p-8">

    <!-- Premium Header -->
    <div class="premium-header rounded-3xl text-white p-6 md:p-8 mb-6 relative">
        <div class="relative z-10">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                <div>
                    <a href="{{ route('dashboard') }}"
                        class="inline-flex items-center gap-2 text-sm text-white/60 hover:text-white mb-3 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                        </svg>
                        กลับหน้าหลัก
                    </a>
                    <h1 class="text-2xl md:text-3xl font-bold glow-text">📊 สรุปผลกำไร</h1>
                    <p class="text-sm text-purple-300/70 mt-1">Accumulated Profit Report</p>
                </div>
                <div class="glass rounded-2xl px-6 py-4 text-center">
                    <p class="text-xs text-gray-600 mb-1">กำไรสุทธิรวม</p>
                    <p class="text-3xl md:text-4xl font-bold text-emerald-600">฿{{ number_format($totalProfit, 0) }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto">
        <!-- KPI Cards -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
            <div class="stat-card premium-shadow" style="--primary: #3b82f6;">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                        <span class="text-xl">🚗</span>
                    </div>
                    <p class="text-sm text-gray-500">ขายได้</p>
                </div>
                <p class="text-3xl font-bold text-blue-600">{{ $soldCars->count() }}</p>
                <p class="text-xs text-gray-400">คัน</p>
            </div>

            <div class="stat-card premium-shadow" style="--primary: #10b981;">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-10 h-10 bg-emerald-100 rounded-xl flex items-center justify-center">
                        <span class="text-xl">💰</span>
                    </div>
                    <p class="text-sm text-gray-500">กำไรสุทธิ</p>
                </div>
                <p class="text-2xl font-bold text-emerald-600">฿{{ number_format($totalProfit, 0) }}</p>
            </div>

            <div class="stat-card premium-shadow" style="--primary: #f59e0b;">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-10 h-10 bg-amber-100 rounded-xl flex items-center justify-center">
                        <span class="text-xl">📈</span>
                    </div>
                    <p class="text-sm text-gray-500">เฉลี่ย/คัน</p>
                </div>
                <p class="text-2xl font-bold text-amber-600">฿{{ number_format($avgProfit, 0) }}</p>
            </div>

            <div class="stat-card premium-shadow relative" style="--primary: #8b5cf6;">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-10 h-10 bg-purple-100 rounded-xl flex items-center justify-center">
                        <span class="text-xl">🎯</span>
                    </div>
                    <p class="text-sm text-gray-500">เป้าหมาย</p>
                </div>
                <p class="text-2xl font-bold text-purple-600">{{ number_format(min($progressPercent, 100), 1) }}%</p>
                <div class="mt-2 h-2 bg-gray-100 rounded-full overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-purple-500 to-pink-500 rounded-full transition-all duration-1000"
                        style="width: {{ min($progressPercent, 100) }}%"></div>
                </div>
                <p class="text-[10px] text-gray-400 mt-1">เป้า: ฿{{ number_format($targetProfit / 1000000, 1) }}M</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left: Chart & Simulation -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Monthly Profit Chart -->
                <div class="chart-container premium-shadow">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <span class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center text-sm">📊</span>
                        กราฟกำไรรายเดือน
                    </h3>
                    <div class="h-64 md:h-72">
                        <canvas id="profitChart"></canvas>
                    </div>
                </div>


            </div>

            <!-- Right: Sold Cars List (Full Width) -->
            <div class="lg:col-span-3">
                <div class="bg-white rounded-3xl premium-shadow overflow-hidden flex flex-col">
                    <div class="p-5 border-b bg-gradient-to-r from-gray-50 to-white">
                        <h3 class="font-bold text-gray-700 flex items-center gap-2">
                            <span
                                class="w-6 h-6 bg-blue-100 rounded-lg flex items-center justify-center text-xs">📋</span>
                            รายการรถที่ขายแล้ว
                        </h3>
                    </div>
                    <div class="overflow-x-auto flex-1">
                        <table class="w-full text-sm">
                            <thead class="text-xs text-gray-500 uppercase bg-gray-50 sticky top-0 z-10">
                                <tr>
                                    <th class="px-4 py-3 text-center w-10">#</th>
                                    <th class="px-4 py-3 text-left">วันที่ขาย</th>
                                    <th class="px-4 py-3 text-left">รถรุ่น</th>
                                    <th class="px-4 py-3 text-right">ทุนซื้อ</th>
                                    <th class="px-4 py-3 text-right">ปรับสภาพ</th>
                                    <th class="px-4 py-3 text-right">ต้นทุนรวม</th>
                                    <th class="px-4 py-3 text-right">ราคาขาย</th>
                                    <th class="px-4 py-3 text-right">กำไร</th>
                                    <th class="px-3 py-3 text-center">สรุป</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @php
                                    $groupedCars = $soldCars->groupBy(function($car) {
                                        return $car->sold_date ? \Carbon\Carbon::parse($car->sold_date)->format('F Y') : 'Unknown';
                                    });
                                    $globalIndex = 1;
                                @endphp

                                @forelse($groupedCars as $month => $cars)
                                    @php
                                        $monthlyProfit = $cars->sum(function($car) {
                                            return $car->sold_price - $car->total_cost;
                                        });
                                        $monthlyRevenue = $cars->sum('sold_price');
                                        $monthlyCost = $cars->sum(function($car) {
                                            return $car->total_cost;
                                        });
                                    @endphp
                                    
                                    <!-- Monthly Header -->
                                    <tr class="bg-gray-50">
                                        <td colspan="9" class="px-4 py-3 border-y border-gray-200">
                                            <div class="flex justify-between items-center font-bold text-gray-700">
                                                <span>{{ $month }} ({{ $cars->count() }} คัน)</span>
                                                <div class="flex items-center gap-4 text-xs">
                                                    <span class="text-gray-500">ขาย ฿{{ number_format($monthlyRevenue, 0) }}</span>
                                                    <span class="text-gray-500">ทุน ฿{{ number_format($monthlyCost, 0) }}</span>
                                                    <span class="text-emerald-600 text-sm font-bold">กำไร +฿{{ number_format($monthlyProfit, 0) }}</span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    @foreach($cars as $car)
                                        @php
                                            $refurbCost = $car->refurbishments->sum('amount');
                                            $carTotalCost = $car->total_cost;
                                            $profit = $car->sold_price - $carTotalCost;
                                        @endphp
                                        <tr class="hover:bg-blue-50/50 transition-colors">
                                            <td class="px-4 py-3 text-center text-gray-400 text-xs">
                                                {{ $globalIndex++ }}
                                            </td>
                                            <td class="px-4 py-3 whitespace-nowrap">
                                                <div class="text-gray-600">{{ $car->sold_date ? \Carbon\Carbon::parse($car->sold_date)->format('d/m/Y') : '-' }}</div>
                                            </td>
                                            <td class="px-4 py-3">
                                                <div class="font-medium text-gray-800">{{ $car->brand }} {{ $car->model }}</div>
                                                <div class="text-xs text-gray-400">{{ $car->license_plate }}</div>
                                            </td>
                                            <td class="px-4 py-3 text-right whitespace-nowrap text-gray-700">
                                                ฿{{ number_format($car->purchase_price, 0) }}
                                            </td>
                                            <td class="px-4 py-3 text-right whitespace-nowrap text-gray-500">
                                                {{ $refurbCost > 0 ? '฿' . number_format($refurbCost, 0) : '-' }}
                                            </td>
                                            <td class="px-4 py-3 text-right whitespace-nowrap font-semibold text-gray-800">
                                                ฿{{ number_format($carTotalCost, 0) }}
                                            </td>
                                            <td class="px-4 py-3 text-right whitespace-nowrap font-semibold text-blue-600">
                                                ฿{{ number_format($car->sold_price, 0) }}
                                            </td>
                                            <td class="px-4 py-3 text-right whitespace-nowrap">
                                                <span class="font-bold {{ $profit >= 0 ? 'text-emerald-600' : 'text-red-500' }}">
                                                    {{ $profit >= 0 ? '+' : '' }}฿{{ number_format($profit, 0) }}
                                                </span>
                                            </td>
                                            <td class="px-3 py-3 text-center whitespace-nowrap">
                                                <div class="flex items-center justify-center gap-1">
                                                    <a href="{{ route('cars.show', $car) }}"
                                                        class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-indigo-50 hover:bg-indigo-100 text-indigo-500 hover:text-indigo-700 transition-all"
                                                        title="สรุปรายการ">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                            stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                                        </svg>
                                                    </a>
                                                    <form action="{{ route('cars.revertSold', $car) }}" method="POST"
                                                        onsubmit="return confirm('ยกเลิกการขาย {{ $car->brand }} {{ $car->model }}?\nรถจะกลับไปอยู่ในสต็อก')">
                                                        @csrf
                                                        <button type="submit"
                                                            class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-amber-50 hover:bg-amber-100 text-amber-500 hover:text-amber-700 transition-all"
                                                            title="ยกเลิกการขาย (กลับสต็อก)">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('cars.destroy', $car) }}" method="POST"
                                                        onsubmit="return confirm('ลบรถ {{ $car->brand }} {{ $car->model }} ออกจากระบบ?\n⚠️ ข้อมูลจะถูกย้ายไปถังขยะ')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-red-50 hover:bg-red-100 text-red-400 hover:text-red-600 transition-all"
                                                            title="ลบรายการ">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @empty
                                    <tr>
                                        <td colspan="9" class="px-5 py-10 text-center text-gray-400">
                                            <div class="flex flex-col items-center gap-2">
                                                <span class="text-3xl">📭</span>
                                                <span>ยังไม่มีข้อมูลการขาย</span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Summary Footer -->
                    @if($soldCount > 0)
                        <div class="border-t-2 border-gray-200 bg-gradient-to-r from-slate-50 to-gray-50 p-5">
                            <h4 class="text-sm font-bold text-gray-700 mb-3 flex items-center gap-2">
                                📊 สรุปรวมรถที่ขาย ({{ $soldCount }} คัน)
                            </h4>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                                <div class="bg-white rounded-xl p-3 border border-gray-100">
                                    <span class="block text-gray-400 text-xs mb-1">ยอดขายรวม</span>
                                    <span class="font-bold text-blue-600 text-lg">฿{{ number_format($totalRevenue, 0) }}</span>
                                </div>
                                <div class="bg-white rounded-xl p-3 border border-gray-100">
                                    <span class="block text-gray-400 text-xs mb-1">ต้นทุนรวม</span>
                                    <span class="font-bold text-gray-800 text-lg">฿{{ number_format($totalCost, 0) }}</span>
                                </div>
                                <div class="bg-white rounded-xl p-3 border border-gray-100">
                                    <span class="block text-gray-400 text-xs mb-1">กำไรเฉลี่ย/คัน</span>
                                    <span class="font-bold text-amber-600 text-lg">฿{{ number_format($avgProfit, 0) }}</span>
                                </div>
                                <div class="bg-{{ $carProfit >= 0 ? 'emerald' : 'red' }}-50 rounded-xl p-3 border border-{{ $carProfit >= 0 ? 'emerald' : 'red' }}-200">
                                    <span class="block text-gray-500 text-xs mb-1 font-semibold">กำไรจากรถ</span>
                                    <span class="font-bold {{ $carProfit >= 0 ? 'text-emerald-600' : 'text-red-500' }} text-xl">
                                        {{ $carProfit >= 0 ? '+' : '' }}฿{{ number_format($carProfit, 0) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Sold Capital Expenses Section -->
            @if($soldCapitalExpenses->count() > 0)
                <div class="lg:col-span-3 mt-6">
                    <div class="bg-white rounded-3xl premium-shadow overflow-hidden flex flex-col">
                        <div class="p-5 border-b bg-gradient-to-r from-purple-50 to-indigo-50">
                            <h3 class="font-bold text-purple-800 flex items-center gap-2">
                                <span class="w-6 h-6 bg-purple-100 rounded-lg flex items-center justify-center text-xs">💰</span>
                                รายการทุนอื่นๆที่ขายแล้ว ({{ $soldCapitalExpenses->count() }} รายการ)
                            </h3>
                        </div>
                        <div class="overflow-x-auto flex-1">
                            <table class="w-full text-sm">
                                <thead class="text-xs text-gray-500 uppercase bg-purple-50/50 sticky top-0 z-10">
                                    <tr>
                                        <th class="px-4 py-3 text-center w-10">#</th>
                                        <th class="px-4 py-3 text-left">วันที่ขาย</th>
                                        <th class="px-4 py-3 text-left">รายการ</th>
                                        <th class="px-4 py-3 text-right">ทุนตั้งต้น</th>
                                        <th class="px-4 py-3 text-right">รับคืนแล้ว</th>
                                        <th class="px-4 py-3 text-right">ทุนคงเหลือ</th>
                                        <th class="px-4 py-3 text-right">ราคาขาย</th>
                                        <th class="px-4 py-3 text-right">กำไร/ขาดทุน</th>
                                        <th class="px-3 py-3 text-center">สรุป</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @foreach($soldCapitalExpenses as $index => $expense)
                                        @php
                                            $decreasesSum = $capitalExpenses->where('parent_id', $expense->id)->sum('amount');
                                            $remainingCost = $expense->amount - $decreasesSum;
                                            $expProfit = ($expense->sold_price ?? 0) - $remainingCost;
                                        @endphp
                                        <tr class="hover:bg-purple-50/30 transition-colors">
                                            <td class="px-4 py-3 text-center text-gray-400 text-xs">{{ $loop->iteration }}</td>
                                            <td class="px-4 py-3 whitespace-nowrap">
                                                <div class="text-gray-600">{{ $expense->sold_date ? \Carbon\Carbon::parse($expense->sold_date)->addYears(543)->format('d/m/Y') : '-' }}</div>
                                            </td>
                                            <td class="px-4 py-3">
                                                <div class="font-medium text-gray-800">{{ $expense->name }}</div>
                                                @if($expense->description)
                                                    <div class="text-xs text-gray-400">{{ Str::limit($expense->description, 40) }}</div>
                                                @endif
                                            </td>
                                            <td class="px-4 py-3 text-right whitespace-nowrap text-gray-700">
                                                ฿{{ number_format($expense->amount, 0) }}
                                            </td>
                                            <td class="px-4 py-3 text-right whitespace-nowrap text-gray-500">
                                                {{ $decreasesSum > 0 ? '฿' . number_format($decreasesSum, 0) : '-' }}
                                            </td>
                                            <td class="px-4 py-3 text-right whitespace-nowrap font-semibold text-gray-800">
                                                ฿{{ number_format($remainingCost, 0) }}
                                            </td>
                                            <td class="px-4 py-3 text-right whitespace-nowrap font-semibold text-purple-600">
                                                ฿{{ number_format($expense->sold_price ?? 0, 0) }}
                                            </td>
                                            <td class="px-4 py-3 text-right whitespace-nowrap">
                                                <span class="font-bold {{ $expProfit >= 0 ? 'text-emerald-600' : 'text-red-500' }}">
                                                    {{ $expProfit >= 0 ? '+' : '' }}฿{{ number_format($expProfit, 0) }}
                                                </span>
                                            </td>
                                            <td class="px-3 py-3 text-center whitespace-nowrap">
                                                <div class="flex items-center justify-center gap-1">
                                                    <a href="{{ route('capital-expenses.show', $expense->id) }}"
                                                        class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-purple-50 hover:bg-purple-100 text-purple-500 hover:text-purple-700 transition-all"
                                                        title="สรุปรายการ">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                            stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                                        </svg>
                                                    </a>
                                                    <form action="{{ route('capital-expenses.revertSold', $expense->id) }}" method="POST"
                                                        onsubmit="return confirm('ยกเลิกการขาย {{ $expense->name }}?\nรายการจะกลับไปอยู่ในทุนอื่นๆ')">
                                                        @csrf
                                                        <button type="submit"
                                                            class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-amber-50 hover:bg-amber-100 text-amber-500 hover:text-amber-700 transition-all"
                                                            title="ยกเลิกการขาย (กลับทุนอื่นๆ)">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('capital-expenses.destroy', $expense->id) }}" method="POST"
                                                        onsubmit="return confirm('ลบรายการ {{ $expense->name }} ออกจากระบบ?\n⚠️ ข้อมูลจะถูกลบถาวร')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-red-50 hover:bg-red-100 text-red-400 hover:text-red-600 transition-all"
                                                            title="ลบรายการ">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Capital Expenses Summary Footer -->
                        <div class="border-t-2 border-purple-200 bg-gradient-to-r from-purple-50 to-indigo-50 p-5">
                            <h4 class="text-sm font-bold text-purple-700 mb-3 flex items-center gap-2">
                                💰 สรุปกำไรจากทุนอื่นๆ ({{ $soldCapitalExpenses->count() }} รายการ)
                            </h4>
                            <div class="bg-{{ $capitalExpensesProfit >= 0 ? 'emerald' : 'red' }}-50 rounded-xl p-3 border border-{{ $capitalExpensesProfit >= 0 ? 'emerald' : 'red' }}-200 inline-block">
                                <span class="block text-gray-500 text-xs mb-1 font-semibold">กำไรจากทุนอื่นๆ</span>
                                <span class="font-bold {{ $capitalExpensesProfit >= 0 ? 'text-emerald-600' : 'text-red-500' }} text-xl">
                                    {{ $capitalExpensesProfit >= 0 ? '+' : '' }}฿{{ number_format($capitalExpensesProfit, 0) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Grand Total Combined -->
            <div class="lg:col-span-3 mt-6">
                <div class="bg-gradient-to-r from-slate-800 to-slate-900 rounded-3xl p-6 premium-shadow">
                    <h4 class="text-white font-bold text-lg mb-4 flex items-center gap-2">🏆 กำไรสุทธิรวมทั้งหมด</h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="bg-white/10 backdrop-blur rounded-2xl p-4">
                            <span class="block text-gray-300 text-xs mb-1">🚗 กำไรจากรถ</span>
                            <span class="font-bold {{ $carProfit >= 0 ? 'text-emerald-400' : 'text-red-400' }} text-xl">
                                {{ $carProfit >= 0 ? '+' : '' }}฿{{ number_format($carProfit, 0) }}
                            </span>
                        </div>
                        <div class="bg-white/10 backdrop-blur rounded-2xl p-4">
                            <span class="block text-gray-300 text-xs mb-1">💰 กำไรจากทุนอื่นๆ</span>
                            <span class="font-bold {{ $capitalExpensesProfit >= 0 ? 'text-purple-400' : 'text-red-400' }} text-xl">
                                {{ $capitalExpensesProfit >= 0 ? '+' : '' }}฿{{ number_format($capitalExpensesProfit, 0) }}
                            </span>
                        </div>
                        <div class="bg-emerald-500/20 backdrop-blur rounded-2xl p-4 border border-emerald-400/30">
                            <span class="block text-emerald-300 text-xs mb-1 font-semibold">✨ กำไรสุทธิรวม</span>
                            <span class="font-bold {{ $totalProfit >= 0 ? 'text-emerald-400' : 'text-red-400' }} text-2xl">
                                {{ $totalProfit >= 0 ? '+' : '' }}฿{{ number_format($totalProfit, 0) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('profitChart').getContext('2d');

            const labels = {!! json_encode($months) !!};
            const data = {!! json_encode($profits) !!};

            const gradient = ctx.createLinearGradient(0, 0, 0, 300);
            gradient.addColorStop(0, 'rgba(16, 185, 129, 0.3)');
            gradient.addColorStop(1, 'rgba(16, 185, 129, 0)');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'กำไร (บาท)',
                        data: data,
                        borderColor: '#10b981',
                        backgroundColor: gradient,
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#10b981',
                        pointBorderWidth: 2,
                        pointRadius: 5,
                        pointHoverRadius: 8,
                        pointHoverBackgroundColor: '#10b981',
                        pointHoverBorderColor: '#fff',
                        pointHoverBorderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: {
                        intersect: false,
                        mode: 'index'
                    },
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: 'rgba(15, 23, 42, 0.9)',
                            titleColor: '#fff',
                            bodyColor: '#e2e8f0',
                            padding: 12,
                            borderRadius: 12,
                            displayColors: false,
                            callbacks: {
                                label: function (context) {
                                    return 'กำไร: ฿' + context.parsed.y.toLocaleString();
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0,0,0,0.05)',
                                drawBorder: false
                            },
                            ticks: {
                                callback: function (value) {
                                    if (value >= 1000000) return (value / 1000000).toFixed(1) + 'M';
                                    if (value >= 1000) return (value / 1000).toFixed(0) + 'k';
                                    return value;
                                },
                                color: '#94a3b8'
                            }
                        },
                        x: {
                            grid: { display: false },
                            ticks: { color: '#94a3b8' }
                        }
                    }
                }
            });
        });
    </script>
</body>

</html>