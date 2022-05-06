<?php

use App\Models\Place;
use App\Models\PlaceType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRestaurants extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!PlaceType::where('name', 'restaurant')->exists()) {
            $place_type = ['name' => 'restaurant'];
            PlaceType::insert($place_type);
        }
        $place_type_id = PlaceType::where('name', 'restaurant')->value('id');

        $places = [];
        $places[] = ['name' => 'Luo\'s Cafe', 'place_type_id' => $place_type_id, 'address1' => '365 S 100 E', 'city' => 'Kanab', 'state' => 'UT', 'zip' => '84741'];
        $places[] = ['name' => 'Jake\'s Chaparral', 'place_type_id' => $place_type_id, 'address1' => '86 South 200 West', 'city' => 'Kanab', 'state' => 'UT', 'zip' => '84741'];
        $places[] = ['name' => 'Cordwood (at Zion Mountain Resort)', 'place_type_id' => $place_type_id, 'address1' => '9065 West Hwy 9', 'city' => 'Mt. Carmel', 'state' => 'UT', 'zip' => '84755'];
        $places[] = ['name' => 'Pizza Hut', 'place_type_id' => $place_type_id, 'address1' => '421 S 100 E', 'city' => 'Kanab', 'state' => 'UT', 'zip' => '84741'];
        $places[] = ['name' => 'Subway', 'place_type_id' => $place_type_id, 'address1' => '295 E 300 S', 'city' => 'Kanab', 'state' => 'UT', 'zip' => '84741'];
        $places[] = ['name' => 'Escobar\'s Mexican Restaurant', 'place_type_id' => $place_type_id, 'address1' => '373 E 300 S', 'city' => 'Kanab', 'state' => 'UT', 'zip' => '84741'];
        foreach ($places as $place) {
            Place::insert($place);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $place_type_id = PlaceType::where('name', 'restaurant')->value('id');
        Place::where('place_type_id', $place_type_id)->get();
    }
}
