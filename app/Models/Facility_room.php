<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility_room extends Model
{
    use HasFactory;

    protected $fillable = [
        'facility_id',
        'room_id'
    ];

    public function facilities()
    {
        return $this->belongsTo(Facility::class);
    }

    public function rooms()
    {
        return $this->belongsTo(Room::class);
    }

}
