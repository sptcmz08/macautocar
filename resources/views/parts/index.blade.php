<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Stock Parts - CarStock Master</title>
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

<body class="bg-gray-100 text-gray-900 min-h-screen">

    <!-- Header -->
    <div class="bg-slate-800 text-white pt-6 pb-8 px-4">
        <div class="max-w-4xl mx-auto">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-2">
                    <a href="{{ route('dashboard') }}" class="text-gray-400 hover:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                        </svg>
                    </a>
                    <span class="text-2xl">📦</span>
                    <h1 class="text-xl font-bold">สต็อกอะไหล่ (Parts Stock)</h1>
                </div>
                <a href="{{ route('dashboard') }}" class="text-sm text-blue-300 hover:text-blue-100">กลับหน้าหลัก</a>
            </div>

            <!-- Stats -->
            @php
                $totalParts = $parts->sum('quantity');
                $totalValue = $parts->sum(function($part) { return $part->quantity * $part->unit_price; });
            @endphp
            <div class="grid grid-cols-2 gap-4 text-center">
                <div class="bg-slate-700/50 rounded-lg p-3">
                    <span class="block text-xs text-gray-400">จำนวนชิ้นรวม</span>
                    <span class="text-lg font-bold text-white">{{ number_format($totalParts) }} ชิ้น</span>
                </div>
                <div class="bg-slate-700/50 rounded-lg p-3">
                    <span class="block text-xs text-gray-400">มูลค่ารวม</span>
                    <span class="text-lg font-bold text-blue-400">฿{{ number_format($totalValue, 0) }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="max-w-4xl mx-auto px-4 -mt-4">
        
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

        <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-6">
            <div class="p-4 border-b flex justify-between items-center">
                <h2 class="text-lg font-bold text-gray-800">รายการอะไหล่</h2>
                <button onclick="document.getElementById('addPartModal').classList.remove('hidden')"
                    class="bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium py-2 px-4 rounded-lg flex items-center gap-1">
                    <span>+</span> เพิ่มอะไหล่
                </button>
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ชื่อรายการ</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">ราคาต่อหน่วย</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">จำนวน</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">มูลค่ารวม</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($parts as $part)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm font-medium text-gray-900">{{ $part->name }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <span class="text-sm text-gray-500">฿{{ number_format($part->unit_price, 0) }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $part->quantity > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ number_format($part->quantity) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <span class="text-sm font-bold text-blue-600">฿{{ number_format($part->quantity * $part->unit_price, 0) }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                <div class="flex items-center justify-center gap-2">
                                    <!-- Use Button -->
                                    <button onclick="usePart({{ $part }})" class="bg-blue-100 hover:bg-blue-200 text-blue-700 p-2 rounded-lg transition-colors group relative" title="นำไปใช้">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 11-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 004.486-6.336l-3.276 3.277a3.004 3.004 0 01-2.25-2.25l3.276-3.276a4.5 4.5 0 00-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437l1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008z" />
                                        </svg>
                                    </button>
                                    
                                    <!-- Edit Button -->
                                    <button onclick="editPart({{ $part }})" class="bg-yellow-100 hover:bg-yellow-200 text-yellow-700 p-2 rounded-lg transition-colors" title="แก้ไข">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg>
                                    </button>
                                    
                                    <!-- Delete Button -->
                                    <form action="{{ route('parts.destroy', $part) }}" method="POST" class="inline-block" onsubmit="return confirm('ยืนยันลบรายการนี้?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-100 hover:bg-red-200 text-red-700 p-2 rounded-lg transition-colors" title="ลบ">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-gray-400">
                                ยังไม่มีรายการอะไหล่ในสต็อก
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Use Part Modal -->
    <div id="usePartModal" class="fixed inset-0 bg-gray-800 bg-opacity-75 overflow-y-auto h-full w-full hidden z-50 flex items-start justify-center pt-10">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-sm mx-4">
            <div class="p-4 border-b flex justify-between items-center bg-blue-50">
                <h3 class="text-lg font-bold text-blue-800">นำอะไหล่ไปใช้ (Use Part)</h3>
                <button onclick="document.getElementById('usePartModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">&times;</button>
            </div>
            <form id="usePartForm" method="POST" class="p-4 space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">รายการอะไหล่</label>
                    <input type="text" id="usePartName" class="w-full bg-gray-100 border border-gray-200 rounded-lg px-3 py-2 text-sm text-gray-500" readonly>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">เลือกรถที่จะนำไปใส่</label>
                    <select name="car_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" required>
                        <option value="">-- เลือกรถ --</option>
                        @foreach($cars as $car)
                            <option value="{{ $car->id }}">{{ $car->brand }} {{ $car->model }} ({{ $car->license_plate ?: 'ไม่มีทะเบียน' }})</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">จำนวนที่ใช้ (ชิ้น)</label>
                    <input type="number" name="quantity" id="useQuantity" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" min="1" value="1" required>
                    <p class="text-xs text-gray-400 mt-1">คงเหลือ: <span id="maxQuantity">0</span> ชิ้น</p>
                </div>
                <div class="flex gap-3 pt-2">
                    <button type="button" onclick="document.getElementById('usePartModal').classList.add('hidden')" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2.5 rounded-lg">ยกเลิก</button>
                    <button type="submit" class="flex-1 bg-blue-500 hover:bg-blue-600 text-white font-medium py-2.5 rounded-lg">บันทึกการใช้</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Add Part Modal -->
    <div id="addPartModal" class="fixed inset-0 bg-gray-800 bg-opacity-75 overflow-y-auto h-full w-full hidden z-50 flex items-start justify-center pt-10">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-sm mx-4">
            <div class="p-4 border-b flex justify-between items-center">
                <h3 class="text-lg font-bold">เพิ่มอะไหล่ใหม่</h3>
                <button onclick="document.getElementById('addPartModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">&times;</button>
            </div>
            <form action="{{ route('parts.store') }}" method="POST" class="p-4 space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">ชื่ออะไหล่</label>
                    <input type="text" name="name" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" placeholder="เช่น ยาง Dunlop, ล้อแม็ก" required>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">ราคาต่อหน่วย</label>
                        <input type="number" name="unit_price" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" placeholder="0" required>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">จำนวนตั้งต้น</label>
                        <input type="number" name="quantity" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" placeholder="1" required>
                    </div>
                </div>
                <div class="flex gap-3 pt-2">
                    <button type="button" onclick="document.getElementById('addPartModal').classList.add('hidden')" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2.5 rounded-lg">ยกเลิก</button>
                    <button type="submit" class="flex-1 bg-blue-500 hover:bg-blue-600 text-white font-medium py-2.5 rounded-lg">บันทึก</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Part Modal -->
    <div id="editPartModal" class="fixed inset-0 bg-gray-800 bg-opacity-75 overflow-y-auto h-full w-full hidden z-50 flex items-start justify-center pt-10">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-sm mx-4">
            <div class="p-4 border-b flex justify-between items-center">
                <h3 class="text-lg font-bold">แก้ไขข้อมูลอะไหล่</h3>
                <button onclick="document.getElementById('editPartModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">&times;</button>
            </div>
            <form id="editPartForm" method="POST" class="p-4 space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">ชื่ออะไหล่</label>
                    <input type="text" name="name" id="editName" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" required>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">ราคาต่อหน่วย</label>
                        <input type="number" name="unit_price" id="editPrice" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" required>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">จำนวนคงเหลือ</label>
                        <input type="number" name="quantity" id="editQuantity" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm" required>
                    </div>
                </div>
                <div class="flex gap-3 pt-2">
                    <button type="button" onclick="document.getElementById('editPartModal').classList.add('hidden')" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2.5 rounded-lg">ยกเลิก</button>
                    <button type="submit" class="flex-1 bg-blue-500 hover:bg-blue-600 text-white font-medium py-2.5 rounded-lg">บันทึก</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function usePart(part) {
            document.getElementById('usePartForm').action = '/parts/' + part.id + '/use';
            document.getElementById('usePartName').value = part.name;
            document.getElementById('useQuantity').max = part.quantity;
            document.getElementById('maxQuantity').innerText = part.quantity;
            document.getElementById('usePartModal').classList.remove('hidden');
        }

        function editPart(part) {
            document.getElementById('editPartForm').action = '/parts/' + part.id;
            document.getElementById('editName').value = part.name;
            document.getElementById('editPrice').value = part.unit_price;
            document.getElementById('editQuantity').value = part.quantity;
            document.getElementById('editPartModal').classList.remove('hidden');
        }
    </script>

</body>
</html>
