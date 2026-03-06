<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset ปีใหม่ | CarStock Master</title>
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

<body class="bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900 min-h-screen text-white">
    <!-- Header -->
    <header class="bg-gradient-to-r from-red-600 via-orange-600 to-yellow-600 py-6 px-4 shadow-2xl">
        <div class="max-w-4xl mx-auto">
            <div class="flex items-center gap-4">
                <a href="{{ route('dashboard') }}"
                    class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center hover:bg-white/30 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                </a>
                <div>
                    <h1 class="text-2xl font-bold">🔄 Reset ปีใหม่</h1>
                    <p class="text-sm opacity-80">ปิดบัญชีปี {{ $setting->year }} และเริ่มต้นปีใหม่</p>
                </div>
            </div>
        </div>
    </header>

    <main class="max-w-4xl mx-auto px-4 py-8">
        <!-- Warning Banner -->
        <div class="bg-gradient-to-r from-red-500/20 to-orange-500/20 border-2 border-red-500/50 rounded-2xl p-6 mb-8">
            <div class="flex items-start gap-4">
                <div class="text-4xl">⚠️</div>
                <div>
                    <h2 class="text-xl font-bold text-red-400 mb-2">คำเตือน: การ Reset จะทำให้ข้อมูลเปลี่ยนแปลง</h2>
                    <ul class="text-sm text-gray-300 space-y-1">
                        <li>✓ รถที่ขายแล้วจะถูกย้ายไป Archive (ยังดูได้ในรายงาน)</li>
                        <li>✓ กำไรสะสมจะถูก reset เป็น 0</li>
                        <li>✓ รถในสต็อก, อะไหล่, ทุนอื่นๆ จะยกยอดไปปีใหม่</li>
                        <li>✓ บัญชีส่วนตัวจะยกยอดไปปีใหม่</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Current Year Summary -->
        <div class="bg-white/10 backdrop-blur-xl rounded-3xl p-6 mb-8 border border-white/20">
            <h3 class="text-xl font-bold mb-6 flex items-center gap-3">
                <span class="w-10 h-10 bg-blue-500 rounded-xl flex items-center justify-center">📊</span>
                สรุปข้อมูลปี {{ $setting->year }}
            </h3>

            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-6">
                <div
                    class="bg-gradient-to-br from-emerald-500/20 to-green-600/20 rounded-2xl p-4 border border-emerald-500/30">
                    <p class="text-xs text-emerald-300 mb-1">💰 กำไรสะสมทั้งปี</p>
                    <p class="text-2xl font-bold text-emerald-400">฿{{ number_format($accumulatedProfit, 0) }}</p>
                </div>
                <div
                    class="bg-gradient-to-br from-blue-500/20 to-indigo-600/20 rounded-2xl p-4 border border-blue-500/30">
                    <p class="text-xs text-blue-300 mb-1">💵 เงินสดคงเหลือ</p>
                    <p class="text-2xl font-bold text-blue-400">฿{{ number_format($cashOnHand, 0) }}</p>
                </div>
                <div
                    class="bg-gradient-to-br from-purple-500/20 to-pink-600/20 rounded-2xl p-4 border border-purple-500/30">
                    <p class="text-xs text-purple-300 mb-1">🚗 รถที่ขายแล้ว</p>
                    <p class="text-2xl font-bold text-purple-400">{{ $soldCars->count() }} คัน</p>
                </div>
            </div>

            <h4 class="font-bold text-gray-300 mb-3">📦 สิ่งที่จะยกยอดไปปีใหม่:</h4>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                <div class="bg-white/5 rounded-xl p-3 text-center">
                    <p class="text-xs text-gray-400">รถในสต็อก</p>
                    <p class="font-bold text-lg">{{ $stockCars->count() }} คัน</p>
                    <p class="text-xs text-gray-500">฿{{ number_format($stockCarsValue, 0) }}</p>
                </div>
                <div class="bg-white/5 rounded-xl p-3 text-center">
                    <p class="text-xs text-gray-400">อะไหล่</p>
                    <p class="font-bold text-lg">฿{{ number_format($partsValue, 0) }}</p>
                </div>
                <div class="bg-white/5 rounded-xl p-3 text-center">
                    <p class="text-xs text-gray-400">ทุนอื่นๆ</p>
                    <p class="font-bold text-lg">฿{{ number_format($capitalExpensesTotal, 0) }}</p>
                </div>
                <div class="bg-white/5 rounded-xl p-3 text-center">
                    <p class="text-xs text-gray-400">บัญชีส่วนตัว</p>
                    <p class="font-bold text-lg {{ $personalBalance >= 0 ? 'text-emerald-400' : 'text-red-400' }}">
                        ฿{{ number_format($personalBalance, 0) }}</p>
                </div>
            </div>
        </div>

        <!-- Reset Form -->
        <form action="{{ route('year-end.execute') }}" method="POST"
            class="bg-white/10 backdrop-blur-xl rounded-3xl p-6 border border-white/20">
            @csrf
            <h3 class="text-xl font-bold mb-6 flex items-center gap-3">
                <span
                    class="w-10 h-10 bg-gradient-to-br from-orange-500 to-red-600 rounded-xl flex items-center justify-center">🚀</span>
                ตั้งค่าปีใหม่
            </h3>

            <div class="grid md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-2">📅 ปีใหม่ (พ.ศ.)</label>
                    <input type="number" name="new_year" value="{{ $setting->year + 1 }}" required
                        class="w-full bg-white/10 border-2 border-white/20 rounded-xl px-4 py-3 text-xl font-bold focus:border-purple-500 focus:ring-4 focus:ring-purple-500/20 transition-all">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-2">💰 ทุนตั้งต้นปีใหม่ (บาท)</label>
                    <input type="number" name="new_initial_capital" value="{{ $setting->initial_capital }}" required
                        class="w-full bg-white/10 border-2 border-white/20 rounded-xl px-4 py-3 text-xl font-bold focus:border-purple-500 focus:ring-4 focus:ring-purple-500/20 transition-all">
                    <p class="text-xs text-gray-500 mt-1">ทุนปีที่แล้ว:
                        ฿{{ number_format($setting->initial_capital, 0) }}</p>
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-300 mb-2">📝 หมายเหตุ (ถ้ามี)</label>
                <textarea name="notes" rows="2" placeholder="เช่น ปิดบัญชีปี 2569 เริ่มต้นปี 2570..."
                    class="w-full bg-white/10 border-2 border-white/20 rounded-xl px-4 py-3 focus:border-purple-500 focus:ring-4 focus:ring-purple-500/20 transition-all"></textarea>
            </div>

            <!-- Confirmation -->
            <div class="bg-red-500/20 border-2 border-red-500/50 rounded-xl p-4 mb-6">
                <label class="block text-sm font-semibold text-red-400 mb-2">⚠️ พิมพ์ "RESET" เพื่อยืนยัน</label>
                <input type="text" name="confirm_text" placeholder="พิมพ์ RESET" required
                    class="w-full bg-white/10 border-2 border-red-500/50 rounded-xl px-4 py-3 text-center text-xl font-bold uppercase tracking-widest focus:border-red-500 focus:ring-4 focus:ring-red-500/20 transition-all"
                    pattern="RESET" title="กรุณาพิมพ์ RESET">
            </div>

            <div class="flex gap-4">
                <a href="{{ route('dashboard') }}"
                    class="flex-1 bg-gray-600 hover:bg-gray-700 text-center font-bold py-4 rounded-xl transition-all">
                    ยกเลิก
                </a>
                <button type="submit"
                    class="flex-1 bg-gradient-to-r from-red-600 via-orange-600 to-yellow-600 hover:from-red-700 hover:via-orange-700 hover:to-yellow-700 font-bold py-4 rounded-xl transition-all shadow-lg shadow-orange-500/30 hover:shadow-xl">
                    🔄 ยืนยัน Reset ปีใหม่
                </button>
            </div>
        </form>

        <!-- Previous Archives -->
        @if($archives->count() > 0)
            <div class="mt-8 bg-white/10 backdrop-blur-xl rounded-3xl p-6 border border-white/20">
                <h3 class="text-xl font-bold mb-4 flex items-center gap-3">
                    <span class="w-10 h-10 bg-indigo-500 rounded-xl flex items-center justify-center">📁</span>
                    รายงานปีที่ผ่านมา
                </h3>
                <div class="space-y-3">
                    @foreach($archives as $archive)
                        <a href="{{ route('reports.archive', $archive->year) }}"
                            class="block bg-white/5 hover:bg-white/10 rounded-xl p-4 transition-all group">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-14 h-14 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center font-bold text-lg">
                                        {{ $archive->year }}
                                    </div>
                                    <div>
                                        <p class="font-bold">ปี พ.ศ. {{ $archive->year }}</p>
                                        <p class="text-xs text-gray-400">ขายรถ {{ $archive->cars_sold_count }} คัน | กำไร
                                            ฿{{ number_format($archive->total_profit, 0) }}</p>
                                    </div>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor"
                                    class="w-5 h-5 text-gray-500 group-hover:text-white group-hover:translate-x-1 transition-all">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                </svg>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </main>
</body>

</html>