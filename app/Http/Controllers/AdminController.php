<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Event;
use App\Models\EventRegistration;

class AdminController extends Controller
{
    public function index()
    {
        $usersCount = User::count();
        $eventsCount = Event::count();
        $registrationsCount = EventRegistration::count();

        return view('backend.admin.dashboard', compact('usersCount', 'eventsCount', 'registrationsCount'));
    }
}
