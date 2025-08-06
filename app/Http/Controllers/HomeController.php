<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
      public function index()
    {
        if (Auth::check()) {
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif (Auth::user()->role === 'alumni') {
                return redirect()->route('alumni.dashboard');
            }
        }
       // Return a public homepage if not logged in
        return view('frontend.home');
    }
}
