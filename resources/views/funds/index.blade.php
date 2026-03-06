@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Funds</h1>
        <a href="{{ route('funds.create') }}"
            class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
            + New Fund
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($funds as $fund)
            <a href="{{ route('funds.show', $fund->id) }}"
                class="block bg-white shadow rounded-lg p-6 hover:shadow-lg transition">
                <h2 class="text-xl font-semibold mb-2">{{ $fund->name }}</h2>
                <p class="text-gray-600 mb-4">{{ Str::limit($fund->description, 100) }}</p>
                <div class="text-3xl font-bold text-gray-800">
                    ฿{{ number_format($fund->total_amount, 2) }}
                </div>
            </a>
        @endforeach
    </div>
@endsection