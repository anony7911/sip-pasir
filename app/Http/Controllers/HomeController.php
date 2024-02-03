<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
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
        return view('home');
    }

    public function getGeolocation(Request $request)
    {
        // Get latitude and longitude from the request
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');

        // Handle the geolocation data (you can store it, process it, etc.)
        // Example: Log the geolocation
        \Log::info("User's Geolocation - Latitude: $latitude, Longitude: $longitude");

        // Return the geolocation data as JSON
        return response()->json(['latitude' => $latitude, 'longitude' => $longitude]);
    }
}
