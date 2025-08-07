@extends('backend.layouts.app')

@section('content')
<div class="p-6 bg-white">
    <h2 class="text-xl font-bold mb-4">Donation History</h2>
    <table class="min-w-full text-sm border">
        <thead>
            <tr class="bg-gray-100">
                <th class="border px-4 py-2">Name</th>
                <th class="border px-4 py-2">Phone</th>
                <th class="border px-4 py-2">Amount</th>
                <th class="border px-4 py-2">Status</th>
                <th class="border px-4 py-2">Code</th>
                <th class="border px-4 py-2">Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($donations as $donation)
            <tr>
                <td class="border px-4 py-2">{{ $donation->name ?? '-' }}</td>
                <td class="border px-4 py-2">{{ $donation->phone }}</td>
                <td class="border px-4 py-2">KES {{ $donation->amount }}</td>
                <td class="border px-4 py-2">{{ ucfirst($donation->status) }}</td>
                <td class="border px-4 py-2">{{ $donation->transaction_code ?? '-' }}</td>
                <td class="border px-4 py-2">{{ $donation->created_at->format('d M Y H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $donations->links() }}
    </div>
</div>
@endsection
