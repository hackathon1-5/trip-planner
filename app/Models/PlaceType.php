<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlaceType extends Model
{
    use HasFactory;

    protected $table = 'place_types';
    protected $fillable = ['name'];

    public function places() {
        return $this->hasMany('places', 'place_type_id', 'id');
    }
}
