@extends('layouts.app')

@section('content')
    <!-- Header with Back Button -->
    <div class="flex items-center gap-2 mb-4">
        <a href="{{ route('funds.index') }}" class="text-gray-500">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
        </a>
        <h1 class="text-xl font-bold">{{ $fund->name }}</h1>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-3 gap-2 mb-6 text-center">
        <div class="bg-white p-3 rounded shadow">
            <span class="block text-gray-400 text-xs">เงินทุน</span>
            <span class="font-bold text-blue-600 text-sm">฿{{ number_format($fund->total_amount, 0) }}</span>
        </div>
        <div class="bg-white p-3 rounded shadow">
            <span class="block text-gray-400 text-xs">ใช้ไป (รวมรถ)</span>
            <!-- Calculation logic to be verified in Controller or View Composer later -->
            @php
                $totalUsed = 0;
                foreach($fund->expenseGroups as $g) {
                   $totalUsed += $g->purchase_price + $g->expenseItems->sum('amount');
                }
            @endphp
            <span class="font-bold text-red-600 text-sm">฿{{ number_format($totalUsed, 0) }}</span>
        </div>
        <div class="bg-white p-3 rounded shadow">
            <span class="block text-gray-400 text-xs">คงเหลือ</span>
            <span class="font-bold text-green-600 text-sm">฿{{ number_format($fund->total_amount - $totalUsed, 0) }}</span>
        </div>
    </div>

    <!-- Car Table (Scrollable) -->
    <div class="bg-white shadow rounded overflow-x-auto">
        <table class="min-w-max divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ลำดับ</th>
                    <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">วันทึ่ซื้อ</th>
                    <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ราคาซื้อ</th>
                    <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ค่าปรับสภาพ</th>
                    <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ต้นทุนรวม</th>
                    <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ราคาตั้งขาย</th>
                    <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">กำไรคาดการณ์</th>
                    <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">สถานะ</th>
                    <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">รหัสรถ</th>
                    <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">รุ่นรถ</th>
                    <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ทะเบียน</th>
                    <th class="relative px-3 py-3"><span class="sr-only">Edit</span></th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($fund->expenseGroups as $index => $group)
                    @php
                        $refurbishCost = $group->expenseItems->sum('amount');
                        $totalCost = $group->purchase_price + $refurbishCost;
                        $expectedProfit = $group->selling_price ? ($group->selling_price - $totalCost) : 0;
                    @endphp
                    <tr>
                        <td class="px-3 py-4 text-sm text-gray-500">{{ $index + 1 }}</td>
                        <td class="px-3 py-4 text-sm text-gray-900">{{ $group->purchase_date ? \Carbon\Carbon::parse($group->purchase_date)->format('d/m/Y') : '-' }}</td>
                        <td class="px-3 py-4 text-sm text-gray-900">฿{{ number_format($group->purchase_price, 0) }}</td>
                        <td class="px-3 py-4 text-sm text-gray-500">
                            <span class="bg-gray-100 px-2 py-1 rounded">฿{{ number_format($refurbishCost, 0) }}</span>
                        </td>
                        <td class="px-3 py-4 text-sm font-bold text-blue-600">฿{{ number_format($totalCost, 0) }}</td>
                        <td class="px-3 py-4 text-sm text-gray-900">{{ $group->selling_price ? '฿'.number_format($group->selling_price, 0) : '-' }}</td>
                        <td class="px-3 py-4 text-sm font-bold {{ $expectedProfit >= 0 ? 'text-green-600' : 'text-red-600' }}">
                            ฿{{ number_format($expectedProfit, 0) }}
                        </td>
                        <td class="px-3 py-4 text-sm">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $group->status == 'sold' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                {{ $group->status }}
                            </span>
                        </td>
                        <td class="px-3 py-4 text-sm text-gray-500">{{ $group->brand }}</td>
                        <td class="px-3 py-4 text-sm text-gray-500">{{ $group->model }} {{ $group->year }} {{ $group->color }}</td>
                        <td class="px-3 py-4 text-sm text-gray-500">{{ $group->license_plate }}</td>
                        <td class="px-3 py-4 text-right text-sm font-medium">
                            <a href="#" class="text-indigo-600 hover:text-indigo-900">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                </svg>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="12" class="px-3 py-4 text-center text-sm text-gray-500">ไม่มีข้อมูลรถ</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Floating Action Button -->
    <div class="fixed bottom-20 right-4">
        <button onclick="document.getElementById('addCarModal').classList.remove('hidden')" class="bg-blue-500 hover:bg-blue-600 text-white rounded-full p-4 shadow-lg flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
        </button>
    </div>

    <!-- Add Car Modal -->
    <div id="addCarModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-10 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">เพิ่มรายการรถ</h3>
                <form action="{{ route('expense-groups.store') }}" method="POST" class="text-left space-y-3">
                    @csrf
                    <input type="hidden" name="fund_id" value="{{ $fund->id }}">
                    <input type="hidden" name="status" value="stock">
                    
                    <div>
                        <label class="block text-xs font-bold mb-1">วันที่ซื้อ</label>
                        <input type="date" name="purchase_date" class="w-full border rounded px-3 py-2 text-sm" required>
                    </div>

                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <label class="block text-xs font-bold mb-1">ราคาซื้อ</label>
                            <input type="number" step="0.01" name="purchase_price" class="w-full border rounded px-3 py-2 text-sm" required>
                        </div>
                        <div>
                            <label class="block text-xs font-bold mb-1">ราคาตั้งขาย</label>
                            <input type="number" step="0.01" name="selling_price" class="w-full border rounded px-3 py-2 text-sm">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <label class="block text-xs font-bold mb-1">ยี่ห้อ (Brand)</label>
                            <input type="text" name="brand" class="w-full border rounded px-3 py-2 text-sm" placeholder="Nissan" required>
                        </div>
                        <div>
                             <label class="block text-xs font-bold mb-1">รุ่น (Model)</label>
                             <input type="text" name="model" class="w-full border rounded px-3 py-2 text-sm" placeholder="Teana" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-2">
                         <div>
                            <label class="block text-xs font-bold mb-1">ปี</label>
                            <input type="text" name="year" class="w-full border rounded px-3 py-2 text-sm" placeholder="2013" required>
                        </div>
                        <div>
                             <label class="block text-xs font-bold mb-1">สี</label>
                             <input type="text" name="color" class="w-full border rounded px-3 py-2 text-sm" placeholder="ดำ" required>
                        </div>
                         <div>
                             <label class="block text-xs font-bold mb-1">ทะเบียน</label>
                             <input type="text" name="license_plate" class="w-full border rounded px-3 py-2 text-sm" placeholder="กข 1234">
                        </div>
                    </div>

                    <div class="pt-4 flex gap-2">
                        <button type="button" onclick="document.getElementById('addCarModal').classList.add('hidden')" class="w-1/2 bg-gray-200 text-gray-800 font-medium py-2 rounded-md hover:bg-gray-300">
                            ยกเลิก
                        </button>
                         <button type="submit" class="w-1/2 bg-blue-500 text-white font-medium py-2 rounded-md hover:bg-blue-600">
                            บันทึก
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection