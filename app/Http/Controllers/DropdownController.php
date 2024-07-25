<?php

namespace App\Http\Controllers;

use App\Models\Block;
use App\Models\District;
use App\Models\State;

class DropdownController extends Controller
{
    public function index()
    {
        $states = State::orderBy('name', 'asc')->get();
        return view('index', compact('states'));
    }

    public function getDistricts($stateId)
    {
        $districts = District::where('state_id', $stateId)->orderBy('name', 'asc')->get();
        return response()->json($districts);
    }

    public function getBlocks($districtId)
    {
        $blocks = Block::where('district_id', $districtId)->orderBy('name', 'asc')->get();
        return response()->json($blocks);
    }
}
