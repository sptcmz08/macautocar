@extends('layouts.app')

@section('content')
    <div class="py-4">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">🏢 จัดการสาขา</h1>
                    <p class="text-gray-500 text-sm">ตั้งค่าสาขาสำหรับจัดกลุ่มรถ</p>
                </div>
                <a href="{{ route('dashboard') }}"
                    class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg transition text-sm font-medium">
                    ← กลับ Dashboard
                </a>
            </div>

            <!-- Add New Branch Form -->
            <div class="bg-white rounded-xl p-6 mb-6 shadow-sm border border-gray-100">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">➕ เพิ่มสาขาใหม่</h2>
                <form action="{{ route('branches.store') }}" method="POST" class="flex flex-wrap gap-4 items-end">
                    @csrf
                    <div class="flex-1 min-w-[200px]">
                        <label class="block text-gray-600 text-sm mb-1">ชื่อสาขา</label>
                        <input type="text" name="name" required
                            class="w-full px-4 py-2.5 rounded-lg bg-gray-50 border border-gray-200 text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="เช่น สาขาหลัก, สาขาสอง">
                    </div>
                    <div class="w-32">
                        <label class="block text-gray-600 text-sm mb-1">สี</label>
                        <input type="color" name="color" value="#3B82F6" required
                            class="w-full h-[42px] rounded-lg bg-gray-50 border border-gray-200 cursor-pointer">
                    </div>
                    <button type="submit"
                        class="bg-emerald-500 hover:bg-emerald-600 text-white px-6 py-2.5 rounded-lg font-medium transition shadow-sm">
                        เพิ่มสาขา
                    </button>
                </form>
            </div>

            <!-- Branch List -->
            <div class="bg-white rounded-xl overflow-hidden shadow-sm border border-gray-100">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                    <h2 class="text-lg font-semibold text-gray-800">📋 รายการสาขา</h2>
                </div>

                @forelse($branches as $branch)
                    <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-4 hover:bg-gray-50 transition group">
                        <!-- Color indicator -->
                        <div class="w-8 h-8 rounded-full shadow-sm flex-shrink-0"
                            style="background-color: {{ $branch->color }}"></div>

                        <!-- Branch name -->
                        <div class="flex-1">
                            <span class="text-gray-800 font-semibold text-base">{{ $branch->name }}</span>
                            <span class="text-gray-400 text-sm ml-2">({{ $branch->cars->count() }} คัน)</span>
                        </div>

                        <!-- Actions -->
                        <div class="flex items-center gap-2 opacity-0 group-hover:opacity-100 transition">
                            <button onclick="openEditModal({{ $branch->id }}, '{{ $branch->name }}', '{{ $branch->color }}')"
                                class="text-amber-500 hover:text-amber-600 p-2 rounded-lg hover:bg-amber-50 transition"
                                title="แก้ไข">
                                ✏️
                            </button>
                            <form action="{{ route('branches.destroy', $branch) }}" method="POST" class="inline"
                                onsubmit="return confirm('ยืนยันลบสาขา {{ $branch->name }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="text-red-500 hover:text-red-600 p-2 rounded-lg hover:bg-red-50 transition"
                                    title="ลบ">
                                    🗑️
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="px-6 py-12 text-center text-gray-400">
                        ยังไม่มีสาขา - เพิ่มสาขาแรกเลย!
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl p-6 w-full max-w-md mx-4 shadow-2xl">
            <h3 class="text-lg font-bold text-gray-800 mb-4">✏️ แก้ไขสาขา</h3>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="space-y-4">
                    <div>
                        <label class="block text-gray-600 text-sm mb-1">ชื่อสาขา</label>
                        <input type="text" name="name" id="editName" required
                            class="w-full px-4 py-2.5 rounded-lg bg-gray-50 border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-gray-600 text-sm mb-1">สี</label>
                        <input type="color" name="color" id="editColor" required
                            class="w-full h-[42px] rounded-lg bg-gray-50 border border-gray-200 cursor-pointer">
                    </div>
                </div>
                <div class="flex justify-end gap-3 mt-6">
                    <button type="button" onclick="closeEditModal()"
                        class="px-4 py-2 text-gray-500 hover:text-gray-700 font-medium">
                        ยกเลิก
                    </button>
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg font-medium transition">
                        บันทึก
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openEditModal(id, name, color) {
            document.getElementById('editForm').action = `/branches/${id}`;
            document.getElementById('editName').value = name;
            document.getElementById('editColor').value = color;
            document.getElementById('editModal').classList.remove('hidden');
            document.getElementById('editModal').classList.add('flex');
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
            document.getElementById('editModal').classList.remove('flex');
        }

        document.getElementById('editModal').addEventListener('click', function (e) {
            if (e.target === this) closeEditModal();
        });
    </script>
@endsection