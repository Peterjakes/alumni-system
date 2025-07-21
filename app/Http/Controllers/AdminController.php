<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function dashboard()
{
    $usersCount = \App\Models\User::count();
    $eventsCount = \App\Models\Event::count();
    $registrationsCount = \App\Models\EventRegistration::count();

    return view('backend.admin.dashboard', compact('usersCount', 'eventsCount', 'registrationsCount'));
}
}
