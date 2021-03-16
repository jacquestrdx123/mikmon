<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DhcpleaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
}
