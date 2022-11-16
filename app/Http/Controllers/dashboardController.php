<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class dashboardController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard',
        ];
        return view('v_dashboard', $data);
    }
}
