@extends('frontend.layouts.app')

@section('title', 'Make a Donation')

@section('content')
<style>
    /* M-Pesa Brand Colors */
    .bg-mpesa-green { background-color: #00A651; }
    .text-mpesa-green { color: #00A651; }
    .border-mpesa-green { border-color: #00A651; }
    .hover\:bg-mpesa-green-dark:hover { background-color: #008A43; }
    .bg-mpesa-light { background-color: #E8F5E8; }
    .text-mpesa-dark { color: #2D5016; }
</style>

<div class="max-w-md mx-auto bg-white rounded-2xl shadow-2xl overflow-hidden" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
    {{-- M-Pesa Header --}}
    <div class="bg-mpesa-green text-white p-6 text-center">
        <div class="flex items-center justify-center mb-3">
            <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center mr-3">
                <span class="text-mpesa-green font-bold text-xl">M</span>
            </div>
            <h1 class="text-2xl font-bold">M-PESA</h1>
        </div>
        <p class="text-sm opacity-90">Lipa na M-PESA</p>
        <p class="text-xs opacity-75">Alumni System Donation</p>
    </div>

    {{-- Alert Messages --}}
    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-400 p-4 m-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-green-700">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-50 border-l-4 border-red-400 p-4 m-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-red-700">{{ session('error') }}</p>
                </div>
            </div>
        </div>
    @endif

    {{-- Donation Form --}}
    <div class="p-6">
        <form action="{{ route('donations.store') }}" method="POST" class="space-y-6">
            @csrf
            
            {{-- Removed Pay Bill section as requested --}}

            {{-- Added donor name field --}}
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Your Name</label>
                <input type="text" 
                       id="name" 
                       name="name" 
                       value="{{ old('name') }}"
                       class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-mpesa-green focus:border-mpesa-green text-lg font-semibold @error('name') border-red-500 @enderror"
                       placeholder="Enter your full name">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Amount Selection --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-3">Select Amount</label>
                <div class="grid grid-cols-2 gap-3 mb-4">
                    <button type="button" onclick="setAmount(500)" class="amount-btn bg-gray-100 hover:bg-mpesa-green hover:text-white border-2 border-gray-200 rounded-lg p-3 text-center font-semibold transition duration-200">
                        KES 500
                    </button>
                    <button type="button" onclick="setAmount(1000)" class="amount-btn bg-gray-100 hover:bg-mpesa-green hover:text-white border-2 border-gray-200 rounded-lg p-3 text-center font-semibold transition duration-200">
                        KES 1,000
                    </button>
                    <button type="button" onclick="setAmount(2500)" class="amount-btn bg-gray-100 hover:bg-mpesa-green hover:text-white border-2 border-gray-200 rounded-lg p-3 text-center font-semibold transition duration-200">
                        KES 2,500
                    </button>
                    <button type="button" onclick="setAmount(5000)" class="amount-btn bg-gray-100 hover:bg-mpesa-green hover:text-white border-2 border-gray-200 rounded-lg p-3 text-center font-semibold transition duration-200">
                        KES 5,000
                    </button>
                </div>
                
                <div>
                    <label for="amount" class="block text-sm font-medium text-gray-700 mb-2">Amount (KES)</label>
                    <input type="number" 
                           id="amount" 
                           name="amount" 
                           min="1" 
                           max="70000" 
                           value="{{ old('amount') }}"
                           class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-mpesa-green focus:border-mpesa-green text-lg font-semibold @error('amount') border-red-500 @enderror"
                           placeholder="0">
                    @error('amount')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Phone Number --}}
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <span class="text-gray-500 text-lg">🇰🇪 +254</span>
                    </div>
                    <input type="tel" 
                           id="phone" 
                           name="phone" 
                           value="{{ old('phone') }}"
                           class="w-full pl-20 pr-4 py-3 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-mpesa-green focus:border-mpesa-green text-lg font-semibold @error('phone') border-red-500 @enderror"
                           placeholder="7XXXXXXXX"
                           maxlength="9">
                </div>
                <p class="mt-1 text-xs text-gray-500">Enter your Safaricom number without +254</p>
                @error('phone')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Submit Button --}}
            <div class="pt-4">
                <button type="submit" 
                        class="w-full bg-mpesa-green hover:bg-mpesa-green-dark text-white font-bold py-4 px-6 rounded-lg transition duration-200 flex items-center justify-center text-lg shadow-lg">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                    PAY NOW
                </button>
            </div>
        </form>

        {{-- Security Notice --}}
        <div class="mt-6 p-4 bg-mpesa-light rounded-lg">
            <div class="flex items-start">
                <svg class="w-5 h-5 text-mpesa-green mt-0.5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                </svg>
                <div>
                    <h4 class="text-sm font-semibold text-mpesa-dark">Secure Payment</h4>
                    <p class="text-xs text-mpesa-dark mt-1">You will receive an M-PESA prompt on your phone. Enter your M-PESA PIN to complete the donation.</p>
                </div>
            </div>
        </div>

        {{-- Steps --}}
        <div class="mt-4 text-xs text-gray-600">
            <p class="font-semibold mb-2">How it works:</p>
            <ol class="list-decimal list-inside space-y-1">
                <li>Enter your name, amount and phone number</li>
                <li>Click "PAY NOW"</li>
                <li>Check your phone for M-PESA prompt</li>
                <li>Enter your M-PESA PIN</li>
                <li>Receive confirmation SMS</li>
            </ol>
        </div>
    </div>
</div>

<script>
function setAmount(amount) {
    document.getElementById('amount').value = amount;
    
    // Update button styles
    document.querySelectorAll('.amount-btn').forEach(btn => {
        btn.classList.remove('bg-mpesa-green', 'text-white');
        btn.classList.add('bg-gray-100');
    });
    
    // Highlight selected button
    event.target.classList.remove('bg-gray-100');
    event.target.classList.add('bg-mpesa-green', 'text-white');
}

// Format phone number input
document.getElementById('phone').addEventListener('input', function(e) {
    let value = e.target.value.replace(/\D/g, '');
    if (value.length > 9) {
        value = value.substring(0, 9);
    }
    e.target.value = value;
});
</script>
@endsection
