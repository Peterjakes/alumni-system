@extends('backend.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Donation History</h1>

    @if(session('success'))
        <div class="bg-green-200 p-2 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <table class="min-w-full bg-white border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th class="py-2 px-4 border-b">User</th>
                <th class="py-2 px-4 border-b">Amount (KES)</th>
                <th class="py-2 px-4 border-b">Phone</th>
                <th class="py-2 px-4 border-b">Transaction ID</th>
                <th class="py-2 px-4 border-b">Status</th>
                <th class="py-2 px-4 border-b">Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse($donations as $donation)
            <tr>
                <td class="py-2 px-4 border-b">{{ $donation->user->name ?? 'Guest' }}</td>
                <td class="py-2 px-4 border-b">{{ number_format($donation->amount, 2) }}</td>
                <td class="py-2 px-4 border-b">{{ $donation->phone }}</td>
                <td class="py-2 px-4 border-b">{{ $donation->transaction_id ?? 'Pending' }}</td>
                <td class="py-2 px-4 border-b">{{ ucfirst($donation->status) }}</td>
                <td class="py-2 px-4 border-b">{{ $donation->created_at->format('d M Y H:i') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center py-4">No donations found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $donations->links() }}
    </div>
</div>
@endsection
