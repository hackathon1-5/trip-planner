<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;

    protected $table = 'places';
    protected $fillable = ['name'];

    public function place_types() {
        return $this->belongsTo(PlaceType::class, 'place_type_id', 'id');
    }
}
