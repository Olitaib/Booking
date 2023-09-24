<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;

    protected $fillable = [
        'title'
    ];

    public function rooms()
    {
        return $this->belongsTo(Room::class);
    }

    public function hotels()
    {
        return $this->belongsTo(Hotel::class);
    }

}
