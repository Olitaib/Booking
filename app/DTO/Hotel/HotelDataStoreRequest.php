<?php

namespace App\DTO\Hotel;

use Carbon\Carbon;

class HotelDataStoreRequest
{

    private ?int $id;
    private ?string $title;
    private ?string $description;
    private ?string $poster_url;
    private ?string $address;
    private ?array $filters;
    private ?string $sort;
    private ?string $start_date;
    private ?string $end_date;

    public function __construct(
        ?int $id = null,
        ?string $title = null,
        ?string $description = null,
        ?string $poster_url = null,
        ?string $address = null,
        ?array $filters = null,
        string $sort = null,
        ?string $start_date = null,
        ?string $end_date = null,
    )
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->poster_url = $poster_url;
        $this->address = $address;
        $this->filters = $filters;
        $this->sort = $sort ?? 'title_asc';
        $this->start_date = $start_date ??  Carbon::now()->format('Y-m-d');
        $this->end_date = $end_date ?? Carbon::now()->addDay()->format('Y-m-d');
    }

    public function getId():int
    {
        return $this->id;
    }

    public function getSort(): string
    {
        return $this->sort;
    }

    public function getFilters(): array | null
    {
        return $this->filters;
    }

    public function getStart_date(): string
    {
        return $this->start_date;
    }

    public function getEnd_date(): string
    {
        return $this->end_date;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'poster_url' => $this->poster_url,
            'address' => $this->address
        ];
    }

}
