<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // return view dashboard
        return view('dashboard.index'); // buat resources/views/dashboard/index.blade.php
    }
}
