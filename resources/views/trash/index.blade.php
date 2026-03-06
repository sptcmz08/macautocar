<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ถังขยะ - CarStock Master</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Sarabun', sans-serif;
            background: linear-gradient(135deg, #f0f4f8 0%, #e2e8f0 100%);
            min-height: 100vh;
        }

        .premium-header {
            background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%);
        }

        .glass {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(12px);
        }

        .premium-shadow {
            box-shadow: 0 10px 40px -10px rgba(0, 0, 0, 0.15);
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
                    <span>🗑️</span> ถังขยะ
                </h1>
                <p class="text-sm text-red-200 mt-1">รายการที่ลบไปแล้ว สามารถกู้คืนได้</p>
            </div>
            <div class="flex items-center gap-4">
                <div class="glass rounded-2xl px-5 py-3 text-center">
                    <p class="text-xs text-gray-600">รถ</p>
                    <p class="text-2xl font-bold text-red-600">{{ $deletedCars->count() }}</p>
                </div>
                <div class="glass rounded-2xl px-5 py-3 text-center">
                    <p class="text-xs text-gray-600">อะไหล่</p>
                    <p class="text-2xl font-bold text-red-600">{{ $deletedParts->count() }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-6xl mx-auto space-y-6">
        <!-- Deleted Cars -->
        <div class="bg-white rounded-2xl premium-shadow overflow-hidden">
            <div class="p-5 border-b bg-gradient-to-r from-red-50 to-white">
                <h3 class="font-bold text-gray-700 flex items-center gap-2">
                    <span class="text-xl">🚗</span> รถที่ลบไป ({{ $deletedCars->count() }})
                </h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 text-xs text-gray-500 uppercase">
                        <tr>
                            <th class="px-5 py-3 text-left">รถ</th>
                            <th class="px-5 py-3 text-center">ทะเบียน</th>
                            <th class="px-5 py-3 text-right">ราคาซื้อ</th>
                            <th class="px-5 py-3 text-center">ลบเมื่อ</th>
                            <th class="px-5 py-3 text-center">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($deletedCars as $car)
                            <tr class="hover:bg-red-50/50">
                                <td class="px-5 py-4">
                                    <div class="font-medium text-gray-800">{{ $car->brand }} {{ $car->model }}</div>
                                    <div class="text-xs text-gray-400">{{ $car->year }} | {{ $car->color }}</div>
                                </td>
                                <td class="px-5 py-4 text-center text-gray-600">{{ $car->license_plate ?: '-' }}</td>
                                <td class="px-5 py-4 text-right font-medium text-gray-700">
                                    ฿{{ number_format($car->purchase_price, 0) }}</td>
                                <td class="px-5 py-4 text-center text-xs text-gray-400">
                                    {{ $car->deleted_at->format('d/m/Y H:i') }}</td>
                                <td class="px-5 py-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <form action="{{ route('cars.restore', $car->id) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="bg-emerald-100 hover:bg-emerald-200 text-emerald-700 px-3 py-1.5 rounded-lg text-xs font-medium transition-colors">
                                                ♻️ กู้คืน
                                            </button>
                                        </form>
                                        <form action="{{ route('cars.forceDelete', $car->id) }}" method="POST"
                                            onsubmit="return confirm('⚠️ ลบถาวร! ข้อมูลจะหายไปและไม่สามารถกู้คืนได้');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-100 hover:bg-red-200 text-red-700 px-3 py-1.5 rounded-lg text-xs font-medium transition-colors">
                                                🗑️ ลบถาวร
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-5 py-10 text-center text-gray-400">
                                    <div class="flex flex-col items-center gap-2">
                                        <span class="text-4xl">✨</span>
                                        <span>ไม่มีรถในถังขยะ</span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Deleted Parts -->
        <div class="bg-white rounded-2xl premium-shadow overflow-hidden">
            <div class="p-5 border-b bg-gradient-to-r from-orange-50 to-white">
                <h3 class="font-bold text-gray-700 flex items-center gap-2">
                    <span class="text-xl">🔧</span> อะไหล่ที่ลบไป ({{ $deletedParts->count() }})
                </h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 text-xs text-gray-500 uppercase">
                        <tr>
                            <th class="px-5 py-3 text-left">ชื่อ</th>
                            <th class="px-5 py-3 text-center">จำนวน</th>
                            <th class="px-5 py-3 text-right">ราคา/หน่วย</th>
                            <th class="px-5 py-3 text-center">ลบเมื่อ</th>
                            <th class="px-5 py-3 text-center">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($deletedParts as $part)
                            <tr class="hover:bg-orange-50/50">
                                <td class="px-5 py-4 font-medium text-gray-800">{{ $part->name }}</td>
                                <td class="px-5 py-4 text-center text-gray-600">{{ $part->quantity }}</td>
                                <td class="px-5 py-4 text-right font-medium text-gray-700">
                                    ฿{{ number_format($part->unit_price, 0) }}</td>
                                <td class="px-5 py-4 text-center text-xs text-gray-400">
                                    {{ $part->deleted_at->format('d/m/Y H:i') }}</td>
                                <td class="px-5 py-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <form action="{{ route('parts.restore', $part->id) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="bg-emerald-100 hover:bg-emerald-200 text-emerald-700 px-3 py-1.5 rounded-lg text-xs font-medium transition-colors">
                                                ♻️ กู้คืน
                                            </button>
                                        </form>
                                        <form action="{{ route('parts.forceDelete', $part->id) }}" method="POST"
                                            onsubmit="return confirm('⚠️ ลบถาวร! ข้อมูลจะหายไปและไม่สามารถกู้คืนได้');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-100 hover:bg-red-200 text-red-700 px-3 py-1.5 rounded-lg text-xs font-medium transition-colors">
                                                🗑️ ลบถาวร
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-5 py-10 text-center text-gray-400">
                                    <div class="flex flex-col items-center gap-2">
                                        <span class="text-4xl">✨</span>
                                        <span>ไม่มีอะไหล่ในถังขยะ</span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>