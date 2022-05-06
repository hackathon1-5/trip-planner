<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $table = 'activities';
    protected $fillable = ['name', 'outdoor'];

    static public function testData() {
        return [
            'bicycling',
            'hiking',
            'sightseeing',
            'birdwatching',
            'rock climbing',
            'culinary tour',
            'boating',
        ];
    }
}
