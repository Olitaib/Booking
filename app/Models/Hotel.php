<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Facility;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
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
     * @param string $start_date
     * @param string $end_date
     * @param ?string $sort
     * @param ?array $filters
     *
     * @return Collection<Room> // include Room Model class above using `use App..\Room `
     */

    public function filterRooms(string $start_date, string $end_date, ?string $sort, ?array $filters): Collection
    {
        $rooms = Room::query()
            ->select('r.*') // select only columns from rooms table (aliased as r) wildcard * for all columns
            ->from('rooms', 'r') // use alias 'r'
            ->join('hotels as h', 'h.id','=','r.hotel_id')
            ->leftJoin('bookings as b', 'b.room_id', '=', 'r.id')
            ->where('h.id', '=', $this->id) // filter out rooms from other hotels
            ->where(fn (Builder $q) => // translates into AND (b.from >= $to OR b.to <= $from OR b.id IS NULL)
                $q->whereDate('b.started_at', '>=', $end_date) //
                ->orWhereDate('b.finished_at', '<=', $start_date)
                ->orWhereNull('b.id') // include rooms that were never booked
            );

        if ($filters) {
            $count = count($filters);

            $rooms
                ->join('facility_rooms as fr', 'fr.room_id', '=', 'r.id')
                ->join('facilities as f', 'f.id', '=', 'fr.facility_id')
                ->whereIn('f.id', $filters) // include rooms that have selected facilities
                ->groupBy('r.id')
                ->havingRaw("COUNT(DISTINCT f.id) = $count"); // include rooms with all selected facilities only
        }

        $sort = explode('_', $sort);

        return $rooms
            ->distinct() // remove duplicates
            ->orderBy($sort[0], $sort[1])
            ->get();
    }

    public function roomFacilities(): Collection
    {
        return Facility::query()
            ->select('f.*')
            ->from('facilities as f')
            ->join('facility_rooms as fr', 'fr.facility_id', '=', 'f.id')
            ->leftJoin('rooms as r', 'r.id', '=', 'fr.room_id')
            ->where('r.hotel_id','=', $this->id)
            ->distinct()
            ->get();
    }

    public static function FilterHotels(string $sort, ?array $filters = null): Collection
    {
        $hotels = self::query()
            ->select('h.*', Room::raw('MAX(r.price) as maxPrice'), Room::raw('MIN(r.price) as minPrice'))
            ->from('hotels as h')
            ->join('rooms as r', 'r.hotel_id', '=', 'h.id')
            ->groupBy('h.id');

        if ($filters) {
            $count = count($filters);
            $hotels
                ->join('facility_hotels as fh', 'fh.hotel_id', '=', 'h.id')
                ->join('facilities as f', 'f.id', '=', 'fh.facility_id')
                ->whereIn('f.id', $filters)
                ->groupBy('h.id')
                ->havingRaw("COUNT(DISTINCT f.id) = $count");
        }

        $sort = explode('_', $sort);

        return $hotels
            ->distinct()
            ->orderBy($sort['0'], $sort['1'])
            ->get();

    }

    public static function allHotelsFacilities(): Collection
    {
        return Facility::query()->whereHas('hotels')->get();
    }

}
