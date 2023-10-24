<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'poster_url',
        'address'
    ];


    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class);
    }

    public function facilities(): BelongsToMany
    {
        return $this->belongsToMany(Facility::class, 'facility_hotels');
    }

    /**
     * @param string $from
     * @param string $to
     *
     * @return Collection<Room> // include Room Model class above using `use App..\Room `
     */
    public function availableRooms(string $from, string $to): Collection
    {
        return Room::query() // create query builder, alternative $this->query()
        ->select('r.*') // select only columns from rooms table (aliased as r) wildcard * for all columns
        ->from('rooms', 'r') // use alias 'r'
        ->join('hotels as h', 'h.id','=','r.hotel_id')
            ->leftJoin('bookings as b', 'b.room_id', '=', 'r.id') // left join to include rooms that were never booked
            ->where('h.id', '=', $this->id) // filter out rooms from other hotels
            ->where(fn (Builder $q) => // translates into AND (b.from >= $to OR b.to <= $from OR b.id IS NULL)
            $q->where('b.started_at', '>=', $to) //
            ->orWhere('b.finished_at', '<=', $from)
                ->orWhereNull('b.id') // include rooms that were never booked
            )
            ->distinct() // remove duplicates
            ->get();
    }

}
