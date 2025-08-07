@extends('frontend.layouts.app') 

@section('content')
<div class="max-w-md mx-auto mt-10 bg-white p-6 rounded shadow">

    <h2 class="text-2xl font-semibold mb-4">Donate via M-Pesa</h2>

    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('donations.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label for="phone" class="block font-medium">Phone Number</label>
            <input type="text" name="phone" id="phone" class="w-full border border-gray-300 rounded px-3 py-2"
                   placeholder="e.g. 254712345678" required>
        </div>

        <div>
            <label for="amount" class="block font-medium">Amount</label>
            <input type="number" name="amount" id="amount" class="w-full border border-gray-300 rounded px-3 py-2"
                   placeholder="Enter amount" required>
        </div>

        <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            Donate
        </button>
    </form>
</div>
@endsection
