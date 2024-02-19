<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    // All Cities Index
    public function index() {
        return view('cities.index', ['cities' => City::all()]);
    }

    // Show Single City
    public function show(City $city) {
        return view('cities.show', [
            'city' => $city
        ]);
    }

    // Autocomplete For Search
    public function autocomplete(Request $request) {
        $query = $request->get('query');
        $cities = City::where('name', 'like', '%' . $query . '%')->get();

        return response()->json($cities);
    }

}
