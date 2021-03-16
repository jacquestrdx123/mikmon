<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('location.index');
    }

    public function show($id){
        $location = Location::find($id);
        return view('location.show',compact('location'));
    }
}
