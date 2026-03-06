@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-900 via-blue-900 to-slate-900 py-8">
        <div class="max-w-4xl mx-auto px-4">
            <!-- Header -->
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-white">🏢 จัดการสาขา</h1>
                    <p class="text-white/60 text-sm">ตั้งค่าสาขาสำหรับจัดกลุ่มรถ</p>
                </div>
                <a href="{{ route('dashboard') }}"
                    class="bg-white/10 hover:bg-white/20 text-white px-4 py-2 rounded-lg transition">
                    ← กลับ Dashboard
                </a>
            </div>

            <!-- Add New Branch Form -->
            <div class="bg-white/10 backdrop-blur-lg rounded-xl p-6 mb-6 border border-white/20">
                <h2 class="text-lg font-semibold text-white mb-4">➕ เพิ่มสาขาใหม่</h2>
                <form action="{{ route('branches.store') }}" method="POST" class="flex flex-wrap gap-4 items-end">
                    @csrf
                    <div class="flex-1 min-w-[200px]">
                        <label class="block text-white/80 text-sm mb-1">ชื่อสาขา</label>
                        <input type="text" name="name" required
                            class="w-full px-4 py-2 rounded-lg bg-white/10 border border-white/20 text-white placeholder-white/40 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="เช่น สาขาหลัก, สาขาสอง">
                    </div>
                    <div class="w-32">
                        <label class="block text-white/80 text-sm mb-1">สี</label>
                        <input type="color" name="color" value="#3B82F6" required
                            class="w-full h-10 rounded-lg bg-white/10 border border-white/20 cursor-pointer">
                    </div>
                    <button type="submit"
                        class="bg-emerald-500 hover:bg-emerald-600 text-white px-6 py-2 rounded-lg font-medium transition">
                        เพิ่มสาขา
                    </button>
                </form>
            </div>

            <!-- Branch List -->
            <div class="bg-white/10 backdrop-blur-lg rounded-xl overflow-hidden border border-white/20">
                <div class="px-6 py-4 border-b border-white/10">
                    <h2 class="text-lg font-semibold text-white">📋 รายการสาขา</h2>
                </div>

                @forelse($branches as $branch)
                    <div class="px-6 py-4 border-b border-white/10 flex items-center gap-4 hover:bg-white/5 transition group">
                        <!-- Color indicator -->
                        <div class="w-6 h-6 rounded-full shadow-lg" style="background-color: {{ $branch->color }}"></div>

                        <!-- Branch name -->
                        <div class="flex-1">
                            <span class="text-white font-medium">{{ $branch->name }}</span>
                            <span class="text-white/40 text-sm ml-2">({{ $branch->cars->count() }} คัน)</span>
                        </div>

                        <!-- Actions -->
                        <div class="flex items-center gap-2 opacity-0 group-hover:opacity-100 transition">
                            <button onclick="openEditModal({{ $branch->id }}, '{{ $branch->name }}', '{{ $branch->color }}')"
                                class="text-amber-400 hover:text-amber-300 p-2" title="แก้ไข">
                                ✏️
                            </button>
                            <form action="{{ route('branches.destroy', $branch) }}" method="POST" class="inline"
                                onsubmit="return confirm('ยืนยันลบสาขา {{ $branch->name }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-300 p-2" title="ลบ">
                                    🗑️
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="px-6 py-12 text-center text-white/40">
                        ยังไม่มีสาขา - เพิ่มสาขาแรกเลย!
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
        <div class="bg-slate-800 rounded-xl p-6 w-full max-w-md mx-4 border border-white/20">
            <h3 class="text-lg font-bold text-white mb-4">✏️ แก้ไขสาขา</h3>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="space-y-4">
                    <div>
                        <label class="block text-white/80 text-sm mb-1">ชื่อสาขา</label>
                        <input type="text" name="name" id="editName" required
                            class="w-full px-4 py-2 rounded-lg bg-white/10 border border-white/20 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-white/80 text-sm mb-1">สี</label>
                        <input type="color" name="color" id="editColor" required
                            class="w-full h-10 rounded-lg bg-white/10 border border-white/20 cursor-pointer">
                    </div>
                </div>
                <div class="flex justify-end gap-3 mt-6">
                    <button type="button" onclick="closeEditModal()" class="px-4 py-2 text-white/70 hover:text-white">
                        ยกเลิก
                    </button>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg">
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

        // Close modal on backdrop click
        document.getElementById('editModal').addEventListener('click', function (e) {
            if (e.target === this) closeEditModal();
        });
    </script>
@endsection