<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class entryTransHarianController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Master Data Target'
        ];
        return view('masterDataTarget.v_index', $data);
    }
}
