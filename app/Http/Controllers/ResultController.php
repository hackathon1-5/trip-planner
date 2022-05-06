<?php

namespace App\Http\Controllers;

use App\Models\NPS;
use App\Models\Place;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function index() {
        $this->generateItinerary();
    }

    public function generateItinerary() {
        // Retrieve all the possible places, in random order.
        $places = Place::inRandomOrder()->get();

        // Resort by user preferences, bumping the lower-ranked ones to the bottom.
        $npsClient = new NPS();
    }
}
