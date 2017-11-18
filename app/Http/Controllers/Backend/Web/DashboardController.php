<?php

namespace App\Http\Controllers\Backend\Web;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('backend/dashboard');
    }
}
