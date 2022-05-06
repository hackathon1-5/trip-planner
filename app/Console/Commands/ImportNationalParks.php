<?php

namespace App\Console\Commands;

use App\Models\Activity;
use App\Models\NPS;
use App\Models\Place;
use App\Models\PlaceActivity;
use App\Models\PlaceType;
use Illuminate\Console\Command;

class ImportNationalParks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nps:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Use the National Park service API and import all national parks.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $npsClient = new NPS();
        $parks = $npsClient->getParks();

        // Create the national park place type record if we don't have it.
        if (!PlaceType::where('name', 'national park')->exists()) {
            $place_type = ['name' => 'national park'];
            PlaceType::insert($place_type);
        }
        $place_type_id = PlaceType::where('name', 'national park')->value('id');

        foreach ($parks->data as $park) {
            $place = [
                'name' => $park->fullName,
                'place_type_id' => $place_type_id,
                'description' => $park->description,
                'latitude' => $park->latitude,
                'longitude' => $park->longitude,
                'cost' => isset($park->entranceFees[0]) ? $park->entranceFees[0]->cost : '0.00',
            ];
            $place_id = Place::insert($place);

            foreach ($park->activities as $activity) {
                // Create the activity record if we don't have it.
                if (!Activity::where('name', $activity->name)->exists()) {
                    $act = ['name' => $activity->name, 'outdoor' => true];
                    Activity::insert($act);
                }
                $activity_id = Activity::where('name', $activity->name)->value('id');

                $place_activity = [
                    'place_id' => $place_id,
                    'activity_id' => $activity_id,
                ];
                PlaceActivity::insert($place_activity);
            }
        }
        return 0;
    }
}
