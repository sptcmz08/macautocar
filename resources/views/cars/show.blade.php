<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>แก้ไขข้อมูลรถ: {{ $car->brand }} {{ $car->model }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Sarabun', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-800 min-h-screen flex items-start justify-center pt-10">

    <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4">
        <!-- Header -->
        <div class="p-4 border-b flex justify-between items-center">
            <h3 class="text-lg font-bold">แก้ไขข้อมูลรถ: {{ $car->brand }} {{ $car->model }}</h3>
            <a href="{{ route('dashboard') }}" class="text-gray-400 hover:text-gray-600 text-2xl">&times;</a>
        </div>

        @if(session('success'))
            <!-- Premium Success Modal -->
            <div id="successOverlay" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[100] flex items-center justify-center opacity-0 transition-all duration-500">
                <div id="successModal" class="bg-white rounded-3xl shadow-[0_25px_60px_-15px_rgba(0,0,0,0.3)] p-8 w-[90%] max-w-sm transform scale-90 opacity-0 transition-all duration-500 ease-out">
                    <div class="flex justify-center mb-6">
                        <div class="relative">
                            <div id="successRing" class="absolute inset-0 w-20 h-20 rounded-full border-4 border-emerald-400 opacity-0"></div>
                            <div class="w-20 h-20 bg-gradient-to-br from-emerald-400 via-green-500 to-teal-600 rounded-full flex items-center justify-center shadow-lg shadow-emerald-200">
                                <svg class="w-10 h-10 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                    <path id="checkPath" d="M4 12l5 5L20 7" style="stroke-dasharray: 30; stroke-dashoffset: 30;"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mb-6">
                        <h4 class="text-2xl font-bold bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent mb-2">สำเร็จ!</h4>
                        <p class="text-gray-500 text-sm leading-relaxed">{{ session('success') }}</p>
                    </div>
                    <div class="w-full bg-gray-100 rounded-full h-2 overflow-hidden mb-6 shadow-inner">
                        <div id="toastProgress" class="bg-gradient-to-r from-emerald-400 via-green-500 to-teal-500 h-2 rounded-full" style="width: 100%"></div>
                    </div>
                    <button onclick="closeToast()" class="w-full bg-gradient-to-r from-emerald-500 via-green-500 to-teal-500 hover:from-emerald-600 hover:via-green-600 hover:to-teal-600 text-white font-semibold py-3.5 rounded-2xl transition-all duration-300 shadow-lg shadow-emerald-200 hover:shadow-xl hover:-translate-y-0.5">
                        <span class="flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            ตกลง
                        </span>
                    </button>
                </div>
            </div>
            <style>
                @keyframes checkDraw { to { stroke-dashoffset: 0; } }
                @keyframes modalBounce { 0% { transform: scale(0.8); opacity: 0; } 50% { transform: scale(1.02); } 100% { transform: scale(1); opacity: 1; } }
                @keyframes ringPulse { 0%, 100% { transform: scale(1); opacity: 0.6; } 50% { transform: scale(1.3); opacity: 0; } }
            </style>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const overlay = document.getElementById('successOverlay');
                    const modal = document.getElementById('successModal');
                    const progress = document.getElementById('toastProgress');
                    const checkPath = document.getElementById('checkPath');
                    const successRing = document.getElementById('successRing');
                    setTimeout(() => {
                        overlay.classList.remove('opacity-0'); overlay.classList.add('opacity-100');
                        modal.classList.remove('scale-90', 'opacity-0'); modal.style.animation = 'modalBounce 0.5s ease-out forwards';
                        checkPath.style.animation = 'checkDraw 0.4s ease-out 0.3s forwards';
                        successRing.style.animation = 'ringPulse 1.5s ease-in-out infinite';
                    }, 50);
                    let width = 100;
                    const interval = setInterval(() => { width -= 2.5; progress.style.width = width + '%'; if (width <= 0) { clearInterval(interval); closeToast(); } }, 100);
                    window.closeToast = function() {
                        modal.style.transform = 'scale(0.9)'; modal.style.opacity = '0';
                        overlay.classList.remove('opacity-100'); overlay.classList.add('opacity-0');
                        setTimeout(() => { overlay.remove(); }, 400);
                    };
                    overlay.addEventListener('click', function(e) { if (e.target === overlay) closeToast(); });
                });
            </script>
        @endif

        <!-- Car Edit Form -->
        <form action="{{ route('cars.update', $car) }}" method="POST" class="p-4 space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-xs font-medium text-gray-500 mb-1">สีรถ</label>
                <input type="text" name="color" value="{{ $car->color }}"
                    class="w-full bg-gray-100 border border-gray-200 rounded-lg px-4 py-3 text-sm">
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-500 mb-1">เลขทะเบียน</label>
                <input type="text" name="license_plate" value="{{ $car->license_plate }}"
                    class="w-full bg-gray-100 border border-gray-200 rounded-lg px-4 py-3 text-sm">
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-500 mb-1">วันที่ซื้อเข้ามา</label>
                <input type="date" name="purchase_date" value="{{ $car->purchase_date?->format('Y-m-d') }}"
                    class="w-full bg-gray-100 border border-gray-200 rounded-lg px-4 py-3 text-sm text-center">
            </div>

            <div>
                <label class="block text-xs font-medium text-blue-600 mb-1">ราคาที่ซื้อมา</label>
                <input type="number" name="purchase_price" value="{{ $car->purchase_price }}"
                    class="w-full bg-gray-100 border border-gray-200 rounded-lg px-4 py-3 text-lg text-blue-600 font-bold">
            </div>

            <div>
                <label class="block text-xs font-medium text-blue-600 mb-1">ราคาตั้งขาย</label>
                <input type="number" name="selling_price" value="{{ $car->selling_price }}"
                    class="w-full bg-gray-100 border border-gray-200 rounded-lg px-4 py-3 text-lg text-blue-600 font-bold">
            </div>

            <!-- Refurbishment Items Section -->
            <div class="border-t pt-4">
                <div class="flex justify-between items-center mb-2">
                    <span class="text-sm text-gray-500">รายการปรับสภาพ</span>
                    <button type="button" onclick="document.getElementById('addRefurbModal').classList.remove('hidden')"
                        class="text-blue-500 text-sm font-medium">+ เพิ่มรายการ</button>
                </div>

                @if($car->refurbishments->count() > 0)
                    <div class="space-y-2">
                        @foreach($car->refurbishments as $item)
                            <div class="flex justify-between items-center bg-gray-50 px-3 py-2 rounded">
                                <span class="text-sm">{{ $item->name }}</span>
                                <div class="flex items-center gap-2">
                                    <span
                                        class="text-sm text-orange-600 font-medium">฿{{ number_format($item->amount, 0) }}</span>
                                    <form action="{{ route('refurbishments.destroy', $item) }}" method="POST" class="inline"
                                        onsubmit="return confirm('ลบรายการนี้?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-400 hover:text-red-600 text-xs">✕</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                        <div class="flex justify-between items-center bg-orange-50 px-3 py-2 rounded font-bold">
                            <span class="text-sm">รวมค่าปรับสภาพ</span>
                            <span class="text-orange-600">฿{{ number_format($car->total_refurbishment_cost, 0) }}</span>
                        </div>
                    </div>
                @else
                    <p class="text-xs text-gray-400 text-center py-2">ยังไม่มีรายการปรับสภาพ</p>
                @endif
            </div>

            <!-- Total Cost -->
            <div class="bg-blue-50 px-4 py-3 rounded-lg">
                <div class="flex justify-between items-center">
                    <span class="font-medium">ต้นทุนรวม</span>
                    <span class="text-xl font-bold text-blue-700">฿{{ number_format($car->total_cost, 0) }}</span>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-3 pt-2">
                <a href="{{ route('dashboard') }}"
                    class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-3 rounded-lg text-center">ยกเลิก</a>
                <button type="submit"
                    class="flex-1 bg-blue-500 hover:bg-blue-600 text-white font-medium py-3 rounded-lg">บันทึกข้อมูล</button>
            </div>
        </form>
    </div>

    <!-- Add Refurbishment Modal -->
    <div id="addRefurbModal"
        class="fixed inset-0 bg-gray-800 bg-opacity-75 overflow-y-auto h-full w-full hidden z-50 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-sm mx-4">
            <div class="p-4 border-b flex justify-between items-center">
                <h3 class="text-lg font-bold">เพิ่มรายการปรับสภาพ</h3>
                <button onclick="document.getElementById('addRefurbModal').classList.add('hidden')"
                    class="text-gray-400 hover:text-gray-600">&times;</button>
            </div>
            <form action="{{ route('refurbishments.store', $car) }}" method="POST" class="p-4 space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">รายการ</label>
                    <input type="text" name="name" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm"
                        placeholder="เช่น ทาสี, เปลี่ยนยาง" required>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">มูลค่า (บาท)</label>
                    <input type="number" name="amount"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" placeholder="10000" required>
                </div>
                <div class="flex gap-3 pt-2">
                    <button type="button" onclick="document.getElementById('addRefurbModal').classList.add('hidden')"
                        class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2.5 rounded-lg">ยกเลิก</button>
                    <button type="submit"
                        class="flex-1 bg-blue-500 hover:bg-blue-600 text-white font-medium py-2.5 rounded-lg">บันทึก</button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>