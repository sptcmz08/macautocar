<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สรุปรายการรถสต็อก - CarStock Master</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --primary: #3b82f6;
        }

        body {
            font-family: 'Sarabun', sans-serif;
            background: linear-gradient(135deg, #f0f4f8 0%, #e2e8f0 100%);
            min-height: 100vh;
        }

        .premium-shadow {
            box-shadow: 0 10px 40px -10px rgba(0, 0, 0, 0.15);
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
            background: radial-gradient(circle, rgba(59, 130, 246, 0.1) 0%, transparent 50%);
        }

        .glass {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        @media print {
            body { background: white !important; }
            .no-print { display: none !important; }
            .premium-header { background: #1e293b !important; }
            .premium-shadow { box-shadow: none !important; }
        }
    </style>
</head>

<body class="p-4 md:p-8">

    <!-- Header -->
    <div class="premium-header rounded-3xl text-white p-6 md:p-8 mb-6 relative">
        <div class="relative z-10">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-4">
                <div>
                    <a href="{{ route('dashboard') }}"
                        class="inline-flex items-center gap-2 text-sm text-white/60 hover:text-white mb-3 transition-colors no-print">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                        </svg>
                        กลับหน้าหลัก
                    </a>
                    <h1 class="text-2xl md:text-3xl font-bold">📋 สรุปรายการรถสต็อก</h1>
                    <p class="text-sm text-blue-300/70 mt-1">Stock Summary Report</p>
                </div>
                <div class="flex gap-3">
                    <div class="glass rounded-2xl px-5 py-3 text-center">
                        <p class="text-xs text-gray-500 mb-1">จำนวนรถ</p>
                        <p class="text-2xl font-bold text-blue-600">{{ $totalCars }}</p>
                        <p class="text-xs text-gray-400">คัน</p>
                    </div>
                    <div class="glass rounded-2xl px-5 py-3 text-center">
                        <p class="text-xs text-gray-500 mb-1">ทุนรวมทั้งหมด</p>
                        <p class="text-2xl font-bold text-slate-800">฿{{ number_format($totalCost, 0) }}</p>
                    </div>
                    <div class="glass rounded-2xl px-5 py-3 text-center">
                        <p class="text-xs text-gray-500 mb-1">ราคาตั้งขายรวม</p>
                        <p class="text-2xl font-bold text-emerald-600">฿{{ number_format($totalSelling, 0) }}</p>
                    </div>
                </div>
            </div>
            <!-- Print Button -->
            <button onclick="window.print()"
                class="no-print inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 text-white px-4 py-2 rounded-xl text-sm transition-all">
                🖨️ พิมพ์รายงาน
            </button>
        </div>
    </div>

    <div class="max-w-7xl mx-auto">

        <!-- Zoom Controls -->
        <div class="flex items-center gap-2 mb-4 px-1 no-print zoom-controls">
            <span class="text-xs text-gray-500">🔍 ขนาด:</span>
            <button type="button" onclick="setPageZoom(0.25)"
                class="zoom-btn px-3 py-1.5 text-xs rounded-lg bg-gray-100 text-gray-600 hover:bg-blue-100 font-medium transition-all">25%</button>
            <button type="button" onclick="setPageZoom(0.50)"
                class="zoom-btn px-3 py-1.5 text-xs rounded-lg bg-gray-100 text-gray-600 hover:bg-blue-100 font-medium transition-all">50%</button>
            <button type="button" onclick="setPageZoom(0.75)"
                class="zoom-btn px-3 py-1.5 text-xs rounded-lg bg-gray-100 text-gray-600 hover:bg-blue-100 font-medium transition-all">75%</button>
            <button type="button" onclick="setPageZoom(1)"
                class="zoom-btn px-3 py-1.5 text-xs rounded-lg bg-blue-500 text-white font-medium transition-all">100%</button>
        </div>

        <div id="stockSummaryWrapper" style="transform-origin: top left; transition: transform 0.3s ease;">
        <div class="space-y-6">

        <!-- Overall Summary Cards -->
        <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
            <div class="bg-white rounded-2xl p-4 premium-shadow text-center">
                <p class="text-xs text-gray-400 mb-1">จำนวนรถทั้งหมด</p>
                <p class="text-3xl font-bold text-blue-600">{{ $totalCars }}</p>
                <p class="text-xs text-gray-400">คัน</p>
            </div>
            <div class="bg-white rounded-2xl p-4 premium-shadow text-center">
                <p class="text-xs text-gray-400 mb-1">ทุนซื้อรวม</p>
                <p class="text-xl font-bold text-gray-800">฿{{ number_format($totalPurchase, 0) }}</p>
            </div>
            <div class="bg-white rounded-2xl p-4 premium-shadow text-center">
                <p class="text-xs text-gray-400 mb-1">ค่าปรับสภาพรวม</p>
                <p class="text-xl font-bold text-orange-600">฿{{ number_format($totalRefurb, 0) }}</p>
            </div>
            <div class="bg-white rounded-2xl p-4 premium-shadow text-center">
                <p class="text-xs text-gray-400 mb-1">ต้นทุนรวม</p>
                <p class="text-xl font-bold text-slate-800">฿{{ number_format($totalCost, 0) }}</p>
            </div>
            <div class="bg-white rounded-2xl p-4 premium-shadow text-center">
                <p class="text-xs text-gray-400 mb-1">ราคาตั้งขายรวม</p>
                <p class="text-xl font-bold text-emerald-600">฿{{ number_format($totalSelling, 0) }}</p>
            </div>
        </div>

        <!-- Branch Sections -->
        @foreach($branches as $branch)
            @php
                $branchCars = $groupedByBranch->get($branch->id, collect());
                $branchPurchase = $branchCars->sum('purchase_price');
                $branchRefurb = $branchCars->sum(function ($car) { return $car->refurbishments->sum('amount'); });
                $branchCost = $branchCars->sum(function ($car) { return $car->total_cost; });
                $branchSelling = $branchCars->sum('selling_price');
            @endphp

            @if($branchCars->count() > 0)
                <div class="bg-white rounded-3xl premium-shadow overflow-hidden">
                    <!-- Branch Header -->
                    <div class="p-5 border-b bg-gradient-to-r from-blue-50 to-indigo-50">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-2">
                            <h3 class="text-lg font-bold text-blue-800 flex items-center gap-2">
                                🏢 สาขา: {{ $branch->name }}
                            </h3>
                            <div class="flex gap-4 text-sm">
                                <span class="text-blue-600 font-bold">{{ $branchCars->count() }} คัน</span>
                                <span class="text-gray-500">ทุนรวม: <span class="font-bold text-gray-800">฿{{ number_format($branchCost, 0) }}</span></span>
                                <span class="text-gray-500">ตั้งขาย: <span class="font-bold text-emerald-600">฿{{ number_format($branchSelling, 0) }}</span></span>
                            </div>
                        </div>
                    </div>

                    <!-- Cars Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead class="text-xs text-gray-500 uppercase bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-center w-10">#</th>
                                    <th class="px-4 py-3 text-left">รุ่นรถ</th>
                                    <th class="px-4 py-3 text-center">ปี</th>
                                    <th class="px-4 py-3 text-center">สี</th>
                                    <th class="px-4 py-3 text-center">เกียร์</th>
                                    <th class="px-4 py-3 text-left">ทะเบียน</th>
                                    <th class="px-4 py-3 text-right">ทุนซื้อ</th>
                                    <th class="px-4 py-3 text-right">ค่าปรับสภาพ</th>
                                    <th class="px-4 py-3 text-right">ต้นทุนรวม</th>
                                    <th class="px-4 py-3 text-right">ราคาตั้งขาย</th>
                                    <th class="px-4 py-3 text-right">คาดการณ์กำไร</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($branchCars as $index => $car)
                                    @php
                                        $refurbCost = $car->refurbishments->sum('amount');
                                        $carTotalCost = $car->total_cost;
                                        $expectedProfit = $car->selling_price ? ($car->selling_price - $carTotalCost) : 0;
                                    @endphp
                                    <tr class="hover:bg-blue-50/30 transition-colors">
                                        <td class="px-4 py-3 text-center text-gray-400">{{ $index + 1 }}</td>
                                        <td class="px-4 py-3">
                                            <div class="font-medium text-gray-800">{{ $car->brand }} {{ $car->model }}</div>
                                            @if($car->notes)
                                                <div class="text-xs text-amber-500">📝 {{ $car->notes }}</div>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 text-center text-gray-600">{{ $car->year ?: '-' }}</td>
                                        <td class="px-4 py-3 text-center">
                                            <span class="inline-flex items-center gap-1">
                                                <span class="w-2 h-2 rounded-full inline-block"
                                                    style="background: {{ $car->color == 'ขาว' ? '#e5e7eb' : ($car->color == 'ดำ' ? '#374151' : ($car->color == 'เทา' ? '#9ca3af' : ($car->color == 'เงิน' ? '#d1d5db' : ($car->color == 'น้ำเงิน' ? '#3b82f6' : ($car->color == 'แดง' ? '#ef4444' : '#f59e0b'))))) }}; border: 1px solid #d1d5db;"></span>
                                                {{ $car->color ?: '-' }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-center text-gray-600 text-xs">
                                            {{ $car->transmission == 'A' ? 'ออโต้' : ($car->transmission == 'M' ? 'ธรรมดา' : '-') }}
                                        </td>
                                        <td class="px-4 py-3 text-gray-600">{{ $car->license_plate ?: '-' }}</td>
                                        <td class="px-4 py-3 text-right whitespace-nowrap text-gray-700">
                                            ฿{{ number_format($car->purchase_price, 0) }}
                                        </td>
                                        <td class="px-4 py-3 text-right whitespace-nowrap text-orange-600">
                                            {{ $refurbCost > 0 ? '฿' . number_format($refurbCost, 0) : '-' }}
                                        </td>
                                        <td class="px-4 py-3 text-right whitespace-nowrap font-semibold text-gray-800">
                                            ฿{{ number_format($carTotalCost, 0) }}
                                        </td>
                                        <td class="px-4 py-3 text-right whitespace-nowrap font-semibold text-blue-600">
                                            {{ $car->selling_price ? '฿' . number_format($car->selling_price, 0) : '-' }}
                                        </td>
                                        <td class="px-4 py-3 text-right whitespace-nowrap">
                                            @if($car->selling_price)
                                                <span class="font-bold {{ $expectedProfit >= 0 ? 'text-emerald-600' : 'text-red-500' }}">
                                                    {{ $expectedProfit >= 0 ? '+' : '' }}฿{{ number_format($expectedProfit, 0) }}
                                                </span>
                                            @else
                                                <span class="text-gray-300">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="bg-blue-50/50">
                                <tr class="font-bold text-sm">
                                    <td colspan="6" class="px-4 py-3 text-right text-blue-700">
                                        รวมสาขา {{ $branch->name }} ({{ $branchCars->count() }} คัน)
                                    </td>
                                    <td class="px-4 py-3 text-right text-gray-800">฿{{ number_format($branchPurchase, 0) }}</td>
                                    <td class="px-4 py-3 text-right text-orange-600">฿{{ number_format($branchRefurb, 0) }}</td>
                                    <td class="px-4 py-3 text-right text-gray-900">฿{{ number_format($branchCost, 0) }}</td>
                                    <td class="px-4 py-3 text-right text-blue-600">฿{{ number_format($branchSelling, 0) }}</td>
                                    <td class="px-4 py-3 text-right text-emerald-600">
                                        @php $branchExpProfit = $branchSelling - $branchCost; @endphp
                                        {{ $branchExpProfit >= 0 ? '+' : '' }}฿{{ number_format($branchExpProfit, 0) }}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            @endif
        @endforeach

        <!-- Unassigned Branch -->
        @php
            $unassignedCars = $groupedByBranch->get(0, collect());
            $unPurchase = $unassignedCars->sum('purchase_price');
            $unRefurb = $unassignedCars->sum(function ($car) { return $car->refurbishments->sum('amount'); });
            $unCost = $unassignedCars->sum(function ($car) { return $car->total_cost; });
            $unSelling = $unassignedCars->sum('selling_price');
        @endphp

        @if($unassignedCars->count() > 0)
            <div class="bg-white rounded-3xl premium-shadow overflow-hidden">
                <div class="p-5 border-b bg-gradient-to-r from-gray-50 to-slate-50">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-2">
                        <h3 class="text-lg font-bold text-gray-600 flex items-center gap-2">
                            📍 ยังไม่ระบุสาขา
                        </h3>
                        <div class="flex gap-4 text-sm">
                            <span class="text-gray-600 font-bold">{{ $unassignedCars->count() }} คัน</span>
                            <span class="text-gray-500">ทุนรวม: <span class="font-bold text-gray-800">฿{{ number_format($unCost, 0) }}</span></span>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="text-xs text-gray-500 uppercase bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-center w-10">#</th>
                                <th class="px-4 py-3 text-left">รุ่นรถ</th>
                                <th class="px-4 py-3 text-center">ปี</th>
                                <th class="px-4 py-3 text-center">สี</th>
                                <th class="px-4 py-3 text-center">เกียร์</th>
                                <th class="px-4 py-3 text-left">ทะเบียน</th>
                                <th class="px-4 py-3 text-right">ทุนซื้อ</th>
                                <th class="px-4 py-3 text-right">ค่าปรับสภาพ</th>
                                <th class="px-4 py-3 text-right">ต้นทุนรวม</th>
                                <th class="px-4 py-3 text-right">ราคาตั้งขาย</th>
                                <th class="px-4 py-3 text-right">คาดการณ์กำไร</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($unassignedCars as $index => $car)
                                @php
                                    $refurbCost = $car->refurbishments->sum('amount');
                                    $carTotalCost = $car->total_cost;
                                    $expectedProfit = $car->selling_price ? ($car->selling_price - $carTotalCost) : 0;
                                @endphp
                                <tr class="hover:bg-gray-50/50 transition-colors">
                                    <td class="px-4 py-3 text-center text-gray-400">{{ $index + 1 }}</td>
                                    <td class="px-4 py-3">
                                        <div class="font-medium text-gray-800">{{ $car->brand }} {{ $car->model }}</div>
                                        @if($car->notes)
                                            <div class="text-xs text-amber-500">📝 {{ $car->notes }}</div>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-center text-gray-600">{{ $car->year ?: '-' }}</td>
                                    <td class="px-4 py-3 text-center">
                                        <span class="inline-flex items-center gap-1">
                                            <span class="w-2 h-2 rounded-full inline-block"
                                                style="background: {{ $car->color == 'ขาว' ? '#e5e7eb' : ($car->color == 'ดำ' ? '#374151' : ($car->color == 'เทา' ? '#9ca3af' : ($car->color == 'เงิน' ? '#d1d5db' : ($car->color == 'น้ำเงิน' ? '#3b82f6' : ($car->color == 'แดง' ? '#ef4444' : '#f59e0b'))))) }}; border: 1px solid #d1d5db;"></span>
                                            {{ $car->color ?: '-' }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-center text-gray-600 text-xs">
                                        {{ $car->transmission == 'A' ? 'ออโต้' : ($car->transmission == 'M' ? 'ธรรมดา' : '-') }}
                                    </td>
                                    <td class="px-4 py-3 text-gray-600">{{ $car->license_plate ?: '-' }}</td>
                                    <td class="px-4 py-3 text-right whitespace-nowrap text-gray-700">฿{{ number_format($car->purchase_price, 0) }}</td>
                                    <td class="px-4 py-3 text-right whitespace-nowrap text-orange-600">{{ $refurbCost > 0 ? '฿' . number_format($refurbCost, 0) : '-' }}</td>
                                    <td class="px-4 py-3 text-right whitespace-nowrap font-semibold text-gray-800">฿{{ number_format($carTotalCost, 0) }}</td>
                                    <td class="px-4 py-3 text-right whitespace-nowrap font-semibold text-blue-600">{{ $car->selling_price ? '฿' . number_format($car->selling_price, 0) : '-' }}</td>
                                    <td class="px-4 py-3 text-right whitespace-nowrap">
                                        @if($car->selling_price)
                                            <span class="font-bold {{ $expectedProfit >= 0 ? 'text-emerald-600' : 'text-red-500' }}">
                                                {{ $expectedProfit >= 0 ? '+' : '' }}฿{{ number_format($expectedProfit, 0) }}
                                            </span>
                                        @else
                                            <span class="text-gray-300">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-gray-50">
                            <tr class="font-bold text-sm">
                                <td colspan="6" class="px-4 py-3 text-right text-gray-600">
                                    รวมยังไม่ระบุสาขา ({{ $unassignedCars->count() }} คัน)
                                </td>
                                <td class="px-4 py-3 text-right text-gray-800">฿{{ number_format($unPurchase, 0) }}</td>
                                <td class="px-4 py-3 text-right text-orange-600">฿{{ number_format($unRefurb, 0) }}</td>
                                <td class="px-4 py-3 text-right text-gray-900">฿{{ number_format($unCost, 0) }}</td>
                                <td class="px-4 py-3 text-right text-blue-600">฿{{ number_format($unSelling, 0) }}</td>
                                <td class="px-4 py-3 text-right text-emerald-600">
                                    @php $unExpProfit = $unSelling - $unCost; @endphp
                                    {{ $unExpProfit >= 0 ? '+' : '' }}฿{{ number_format($unExpProfit, 0) }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        @endif

        <!-- Grand Total -->
        <div class="bg-gradient-to-r from-slate-800 to-slate-900 rounded-3xl p-6 premium-shadow">
            <h4 class="text-white font-bold text-lg mb-4 flex items-center gap-2">🏆 สรุปรวมทั้งหมด</h4>
            <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                <div class="bg-white/10 backdrop-blur rounded-2xl p-4 text-center">
                    <span class="block text-gray-300 text-xs mb-1">จำนวนรถ</span>
                    <span class="font-bold text-white text-2xl">{{ $totalCars }}</span>
                    <span class="block text-gray-400 text-xs">คัน</span>
                </div>
                <div class="bg-white/10 backdrop-blur rounded-2xl p-4 text-center">
                    <span class="block text-gray-300 text-xs mb-1">ทุนซื้อรวม</span>
                    <span class="font-bold text-white text-lg">฿{{ number_format($totalPurchase, 0) }}</span>
                </div>
                <div class="bg-white/10 backdrop-blur rounded-2xl p-4 text-center">
                    <span class="block text-gray-300 text-xs mb-1">ค่าปรับสภาพรวม</span>
                    <span class="font-bold text-orange-400 text-lg">฿{{ number_format($totalRefurb, 0) }}</span>
                </div>
                <div class="bg-white/10 backdrop-blur rounded-2xl p-4 text-center">
                    <span class="block text-gray-300 text-xs mb-1">ต้นทุนรวม</span>
                    <span class="font-bold text-white text-lg">฿{{ number_format($totalCost, 0) }}</span>
                </div>
                <div class="bg-emerald-500/20 backdrop-blur rounded-2xl p-4 text-center border border-emerald-400/30">
                    <span class="block text-emerald-300 text-xs mb-1">ราคาตั้งขายรวม</span>
                    <span class="font-bold text-emerald-400 text-lg">฿{{ number_format($totalSelling, 0) }}</span>
                </div>
            </div>

            <!-- Branch breakdown -->
            <div class="mt-4 pt-4 border-t border-white/10">
                <h5 class="text-white/60 text-sm mb-3">สรุปรายสาขา</h5>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                    @foreach($branches as $branch)
                        @php $bCars = $groupedByBranch->get($branch->id, collect()); @endphp
                        @if($bCars->count() > 0)
                            <div class="bg-white/5 rounded-xl p-3 flex justify-between items-center">
                                <div>
                                    <span class="text-white text-sm font-medium">🏢 {{ $branch->name }}</span>
                                    <span class="text-blue-300 text-xs ml-2">{{ $bCars->count() }} คัน</span>
                                </div>
                                <span class="text-white font-bold text-sm">
                                    ฿{{ number_format($bCars->sum(function ($c) { return $c->total_cost; }), 0) }}
                                </span>
                            </div>
                        @endif
                    @endforeach
                    @if($unassignedCars->count() > 0)
                        <div class="bg-white/5 rounded-xl p-3 flex justify-between items-center">
                            <div>
                                <span class="text-gray-300 text-sm font-medium">📍 ยังไม่ระบุ</span>
                                <span class="text-gray-400 text-xs ml-2">{{ $unassignedCars->count() }} คัน</span>
                            </div>
                            <span class="text-white font-bold text-sm">
                                ฿{{ number_format($unCost, 0) }}
                            </span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

    <script>
    function setPageZoom(scale) {
        var wrapper = document.getElementById('stockSummaryWrapper');
        if (!wrapper) return;
        wrapper.style.transform = 'scale(' + scale + ')';
        wrapper.style.width = (100 / scale) + '%';
        var container = event.target.closest('.zoom-controls');
        if (container) {
            container.querySelectorAll('.zoom-btn').forEach(function(btn) {
                btn.classList.remove('bg-blue-500', 'text-white');
                btn.classList.add('bg-gray-100', 'text-gray-600');
            });
        }
        event.target.classList.remove('bg-gray-100', 'text-gray-600');
        event.target.classList.add('bg-blue-500', 'text-white');
    }
    </script>

</body>

</html>
