<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายงาน - CarStock Master</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: 'Sarabun', sans-serif;
            background: linear-gradient(135deg, #f0f4f8 0%, #e2e8f0 100%);
            min-height: 100vh;
        }

        .premium-header {
            background: linear-gradient(135deg, #0891b2 0%, #0e7490 100%);
        }

        .glass {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(12px);
        }

        .premium-shadow {
            box-shadow: 0 10px 40px -10px rgba(0, 0, 0, 0.15);
        }

        .stat-card {
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.95) 0%, rgba(248, 250, 252, 0.95) 100%);
            border-radius: 16px;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--color-start), var(--color-end));
        }
    </style>
</head>

<body class="p-4 md:p-8">

    <!-- Header -->
    <div class="premium-header rounded-3xl text-white p-6 md:p-8 mb-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <a href="{{ route('dashboard') }}"
                    class="inline-flex items-center gap-2 text-sm text-white/60 hover:text-white mb-3 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                    กลับหน้าหลัก
                </a>
                <h1 class="text-2xl md:text-3xl font-bold flex items-center gap-3">
                    <span>📈</span> รายงานสรุป
                </h1>
                <p class="text-sm text-cyan-200 mt-1">สรุปยอดขาย กำไร และค่าใช้จ่ายรายเดือน/รายปี</p>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto space-y-6">
        <!-- Yearly Summary Cards -->
        <div
            class="grid grid-cols-1 md:grid-cols-{{ $yearlyData->count() > 0 ? min($yearlyData->count(), 4) : 1 }} gap-4">
            @forelse($yearlyData as $data)
                <div class="stat-card premium-shadow" style="--color-start: #3b82f6; --color-end: #8b5cf6;">
                    <p class="text-sm text-gray-500 mb-2">📅 ปี {{ $data['year'] }}</p>
                    <div class="grid grid-cols-2 gap-4 text-center">
                        <div>
                            <p class="text-xs text-gray-400">ขายได้</p>
                            <p class="text-2xl font-bold text-blue-600">{{ $data['count'] }}</p>
                            <p class="text-[10px] text-gray-400">คัน</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400">กำไรรวม</p>
                            <p class="text-xl font-bold {{ $data['profit'] >= 0 ? 'text-emerald-600' : 'text-red-500' }}">
                                ฿{{ number_format($data['profit'], 0) }}</p>
                        </div>
                    </div>
                    <div class="mt-3 pt-3 border-t grid grid-cols-2 gap-2 text-xs text-gray-500">
                        <div>รายได้: <span
                                class="font-medium text-gray-700">฿{{ number_format($data['revenue'], 0) }}</span></div>
                        <div>ต้นทุน: <span class="font-medium text-gray-700">฿{{ number_format($data['cost'], 0) }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="stat-card premium-shadow text-center py-10 text-gray-400 col-span-full">
                    <span class="text-4xl block mb-2">📭</span>
                    ยังไม่มีข้อมูลการขาย
                </div>
            @endforelse
        </div>

        <!-- Monthly Chart & Table -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Chart -->
            <div class="bg-white rounded-2xl premium-shadow p-6">
                <h3 class="font-bold text-gray-700 mb-4 flex items-center gap-2">
                    <span class="text-lg">📊</span> กราฟกำไรรายเดือน
                </h3>
                <div class="h-64">
                    <canvas id="monthlyChart"></canvas>
                </div>
            </div>

            <!-- Monthly Table -->
            <div class="bg-white rounded-2xl premium-shadow overflow-hidden">
                <div class="p-5 border-b bg-gradient-to-r from-cyan-50 to-white">
                    <h3 class="font-bold text-gray-700 flex items-center gap-2">
                        <span class="text-lg">📋</span> รายละเอียดรายเดือน
                    </h3>
                </div>
                <div class="overflow-x-auto max-h-64">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 text-xs text-gray-500 uppercase sticky top-0">
                            <tr>
                                <th class="px-4 py-3 text-left">เดือน</th>
                                <th class="px-4 py-3 text-center">ขาย</th>
                                <th class="px-4 py-3 text-right">รายได้</th>
                                <th class="px-4 py-3 text-right">กำไร</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($monthlyData as $data)
                                <tr class="hover:bg-cyan-50/50">
                                    <td class="px-4 py-3 font-medium text-gray-700">{{ $data['month'] }}</td>
                                    <td class="px-4 py-3 text-center">{{ $data['count'] }} คัน</td>
                                    <td class="px-4 py-3 text-right text-gray-600">฿{{ number_format($data['revenue'], 0) }}
                                    </td>
                                    <td
                                        class="px-4 py-3 text-right font-bold {{ $data['profit'] >= 0 ? 'text-emerald-600' : 'text-red-500' }}">
                                        {{ $data['profit'] >= 0 ? '+' : '' }}฿{{ number_format($data['profit'], 0) }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-8 text-center text-gray-400">ไม่มีข้อมูล</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Capital Expenses Total -->
        <div class="bg-white rounded-2xl premium-shadow overflow-hidden">
            <div class="p-5 border-b bg-gradient-to-r from-orange-50 to-white">
                <h3 class="font-bold text-gray-700 flex items-center gap-2">
                    <span class="text-lg">💸</span> ค่าใช้จ่ายทุนอื่นๆ
                </h3>
            </div>
            <div class="p-5">
                @php
                    $capitalExpensesTotal = $capitalExpensesByMonth->sum();
                @endphp
                @if($capitalExpensesTotal > 0)
                    <div class="flex items-center justify-center">
                        <div class="bg-gradient-to-r from-orange-100 to-orange-50 rounded-2xl p-6 text-center shadow-sm">
                            <p class="text-sm text-gray-500 mb-1">ยอดรวมทั้งหมด</p>
                            <p class="text-3xl font-bold text-orange-600">฿{{ number_format($capitalExpensesTotal, 0) }}</p>
                        </div>
                    </div>
                @else
                    <div class="text-center py-8 text-gray-400">
                        <span class="text-3xl block mb-2">✨</span>
                        ไม่มีรายการค่าใช้จ่ายทุน
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('monthlyChart').getContext('2d');

            const labels = {!! json_encode($monthlyData->pluck('month')->values()) !!};
            const profitData = {!! json_encode($monthlyData->pluck('profit')->values()) !!};
            const revenueData = {!! json_encode($monthlyData->pluck('revenue')->values()) !!};

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'กำไร',
                            data: profitData,
                            backgroundColor: 'rgba(16, 185, 129, 0.7)',
                            borderColor: '#10b981',
                            borderWidth: 1,
                            borderRadius: 6
                        },
                        {
                            label: 'รายได้',
                            data: revenueData,
                            backgroundColor: 'rgba(59, 130, 246, 0.5)',
                            borderColor: '#3b82f6',
                            borderWidth: 1,
                            borderRadius: 6
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'top' },
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    return context.dataset.label + ': ฿' + context.parsed.y.toLocaleString();
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function (value) {
                                    if (value >= 1000000) return (value / 1000000).toFixed(1) + 'M';
                                    if (value >= 1000) return (value / 1000).toFixed(0) + 'k';
                                    return value;
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
</body>

</html>