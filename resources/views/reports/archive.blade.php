<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>รายงานปี {{ $archive->year }} | CarStock Master</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Prompt', 'sans-serif'] }
                }
            }
        }
    </script>
</head>

<body class="bg-gradient-to-br from-slate-900 via-indigo-900 to-slate-900 min-h-screen text-white">
    <!-- Header -->
    <header class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 py-6 px-4 shadow-2xl">
        <div class="max-w-5xl mx-auto">
            <div class="flex items-center gap-4">
                <a href="{{ route('year-end.show') }}"
                    class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center hover:bg-white/30 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                </a>
                <div>
                    <h1 class="text-2xl font-bold">📁 รายงานปี พ.ศ. {{ $archive->year }}</h1>
                    <p class="text-sm opacity-80">ข้อมูลที่ถูก Archive เมื่อ
                        {{ $archive->created_at->translatedFormat('d F Y') }}</p>
                </div>
            </div>
        </div>
    </header>

    <main class="max-w-5xl mx-auto px-4 py-8">
        <!-- Summary Cards -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
            <div
                class="bg-gradient-to-br from-emerald-500/30 to-green-600/30 backdrop-blur-xl rounded-2xl p-5 border border-emerald-500/30">
                <p class="text-xs text-emerald-300 mb-1">💰 กำไรรวมทั้งปี</p>
                <p class="text-2xl font-bold text-emerald-400">฿{{ number_format($archive->total_profit, 0) }}</p>
            </div>
            <div
                class="bg-gradient-to-br from-blue-500/30 to-indigo-600/30 backdrop-blur-xl rounded-2xl p-5 border border-blue-500/30">
                <p class="text-xs text-blue-300 mb-1">💵 เงินสดสิ้นปี</p>
                <p class="text-2xl font-bold text-blue-400">฿{{ number_format($archive->final_cash, 0) }}</p>
            </div>
            <div
                class="bg-gradient-to-br from-purple-500/30 to-pink-600/30 backdrop-blur-xl rounded-2xl p-5 border border-purple-500/30">
                <p class="text-xs text-purple-300 mb-1">🚗 รถที่ขาย</p>
                <p class="text-2xl font-bold text-purple-400">{{ $archive->cars_sold_count }} คัน</p>
            </div>
            <div
                class="bg-gradient-to-br from-orange-500/30 to-red-600/30 backdrop-blur-xl rounded-2xl p-5 border border-orange-500/30">
                <p class="text-xs text-orange-300 mb-1">🏦 ทุนตั้งต้น</p>
                <p class="text-2xl font-bold text-orange-400">฿{{ number_format($archive->initial_capital, 0) }}</p>
            </div>
        </div>

        <!-- Additional Stats -->
        <div class="grid grid-cols-3 gap-4 mb-8">
            <div class="bg-white/10 backdrop-blur-xl rounded-xl p-4 text-center border border-white/20">
                <p class="text-xs text-gray-400">มูลค่าสต็อกรถ</p>
                <p class="font-bold text-lg">฿{{ number_format($archive->car_stock_value, 0) }}</p>
            </div>
            <div class="bg-white/10 backdrop-blur-xl rounded-xl p-4 text-center border border-white/20">
                <p class="text-xs text-gray-400">มูลค่าอะไหล่</p>
                <p class="font-bold text-lg">฿{{ number_format($archive->parts_value, 0) }}</p>
            </div>
            <div class="bg-white/10 backdrop-blur-xl rounded-xl p-4 text-center border border-white/20">
                <p class="text-xs text-gray-400">ทุนอื่นๆ</p>
                <p class="font-bold text-lg">฿{{ number_format($archive->capital_expenses, 0) }}</p>
            </div>
        </div>

        @if($archive->notes)
            <div class="bg-yellow-500/20 border border-yellow-500/30 rounded-xl p-4 mb-8">
                <p class="text-sm text-yellow-300"><strong>📝 หมายเหตุ:</strong> {{ $archive->notes }}</p>
            </div>
        @endif

        <!-- Sold Cars List -->
        @if($archive->sold_cars_data && count($archive->sold_cars_data) > 0)
            <div class="bg-white/10 backdrop-blur-xl rounded-2xl border border-white/20 overflow-hidden mb-8">
                <div class="bg-white/5 px-6 py-4 border-b border-white/10">
                    <h2 class="font-bold text-lg flex items-center gap-2">
                        🚗 รายการรถที่ขายในปีนี้ ({{ count($archive->sold_cars_data) }} คัน)
                    </h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-white/5">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-bold text-gray-400 uppercase">#</th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-gray-400 uppercase">รถ</th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-gray-400 uppercase">ทะเบียน</th>
                                <th class="px-4 py-3 text-right text-xs font-bold text-gray-400 uppercase">ต้นทุน</th>
                                <th class="px-4 py-3 text-right text-xs font-bold text-gray-400 uppercase">ราคาขาย</th>
                                <th class="px-4 py-3 text-right text-xs font-bold text-emerald-400 uppercase">กำไร</th>
                                <th class="px-4 py-3 text-center text-xs font-bold text-gray-400 uppercase">วันที่ขาย</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @foreach($archive->sold_cars_data as $index => $car)
                                <tr class="hover:bg-white/5">
                                    <td class="px-4 py-3 text-gray-400">{{ $index + 1 }}</td>
                                    <td class="px-4 py-3 font-semibold">{{ $car['brand'] }} {{ $car['model'] }}</td>
                                    <td class="px-4 py-3 text-gray-400">{{ $car['license_plate'] ?? '-' }}</td>
                                    <td class="px-4 py-3 text-right text-gray-300">฿{{ number_format($car['total_cost'], 0) }}
                                    </td>
                                    <td class="px-4 py-3 text-right text-blue-400 font-semibold">
                                        ฿{{ number_format($car['sold_price'], 0) }}</td>
                                    <td
                                        class="px-4 py-3 text-right font-bold {{ $car['profit'] >= 0 ? 'text-emerald-400' : 'text-red-400' }}">
                                        {{ $car['profit'] >= 0 ? '+' : '' }}฿{{ number_format($car['profit'], 0) }}
                                    </td>
                                    <td class="px-4 py-3 text-center text-gray-400">{{ $car['sold_date'] ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-white/5 font-bold">
                            <tr>
                                <td colspan="3" class="px-4 py-3 text-right">รวม</td>
                                <td class="px-4 py-3 text-right">
                                    ฿{{ number_format(collect($archive->sold_cars_data)->sum('total_cost'), 0) }}</td>
                                <td class="px-4 py-3 text-right text-blue-400">
                                    ฿{{ number_format(collect($archive->sold_cars_data)->sum('sold_price'), 0) }}</td>
                                <td class="px-4 py-3 text-right text-emerald-400">
                                    ฿{{ number_format(collect($archive->sold_cars_data)->sum('profit'), 0) }}</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        @endif

        <!-- Back Button -->
        <div class="flex justify-center">
            <a href="{{ route('dashboard') }}"
                class="bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 font-bold py-4 px-8 rounded-xl transition-all shadow-lg shadow-purple-500/30 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
                กลับหน้าหลัก
            </a>
        </div>
    </main>
</body>

</html>