<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index() {
        if (!Auth::User()->isAdmin()) {
            return Inertia::render('Dashboard/User');
        } else {
            return Inertia::render('Dashboard/Admin');
        }
    }
}
