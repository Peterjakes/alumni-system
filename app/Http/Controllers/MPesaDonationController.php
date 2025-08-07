<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MpesaService;
use App\Models\MPesaDonation;


class MPesaDonationController extends Controller
{
    protected $mpesa;

    public function __construct(MpesaService $mpesa)
    {
        $this->mpesa = $mpesa;
    }

    public function index()
{
    $donations = MPesaDonation::latest()->paginate(10);
    return view('backend.donations.index', compact('donations'));
}


    public function create()
    {
        return view('frontend.donations.create');
    }

    
    public function store(Request $request)
{
    $request->validate([
        'amount' => 'required|numeric|min:1',
        'phone' => 'required|regex:/^2547\d{8}$/',
    ]);

    //  store in database before initiating STK push
    $donation = MPesaDonation::create([
        'user_id' => auth()->id(),
        'amount' => $request->amount,
        'phone' => $request->phone,
        'status' => 'pending',
    ]);

    $mpesa = new MpesaService();
    $response = $mpesa->stkPush($request->phone, $request->amount);

    if (isset($response['ResponseCode']) && $response['ResponseCode'] == '0') {
        return redirect()->back()->with('success', 'STK Push initiated. Check your phone.');
    } else {
        return redirect()->back()->with('error', 'Failed to initiate payment.');
    }
}

}

