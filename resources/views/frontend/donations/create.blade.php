@extends('frontend.layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 shadow mt-8 rounded">
    <h2 class="text-xl font-bold mb-4">Donate via M-Pesa</h2>

    @if(session('success'))
        <div class="bg-green-200 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('donations.store') }}">
        @csrf
        <div class="mb-4">
            <label class="block text-sm font-semibold">Amount</label>
            <input type="number" name="amount" class="w-full border rounded p-2" required min="10">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold">Phone Number</label>
            <input type="text" name="phone" class="w-full border rounded p-2" required>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Donate</button>
    </form>
</div>
@endsection
