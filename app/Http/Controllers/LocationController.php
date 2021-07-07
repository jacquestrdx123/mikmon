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
    public function create(){
        return view('location.create');
    }
    public function store(Request $request){
        $input = $request->all();
        $location = Location::create($input);
        return redirect('/location/'.$location->id);
    }

}
