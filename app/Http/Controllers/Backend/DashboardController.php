<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->hasRole('Super Admin')) {
            return view('backend.dashboard.admin');
        }

        if (Auth::user()->hasRole('Agent')) {
            return view('backend.dashboard.agent');
        }

        if (Auth::user()->hasRole('Staff')) {
            return view('backend.dashboard.staff');
        }

        if (Auth::user()->hasRole('Student')) {
            return view('backend.dashboard.student');
        }
    }
}
