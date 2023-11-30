<?php

namespace App\DTO\Hotel;

use Illuminate\Database\Eloquent\Collection;

class HotelDataStoreResponse
{

    private ?object $model;
    private ?int $id;
    private ?string $title;
    private ?string $description;
    private ?string $poster_url;
    private ?string $address;
    private ?string $sort;
    private ?array $filters;
    private ?string $start_date;
    private ?string $end_date;

    public function __construct(
        ?object $model = null,
        ?string $sort = null,
        ?array $filters = null,
        ?string $start_date = null,
        ?string $end_date = null,
    )
    {
        if ($model) {
            $this->model = $model;
            $this->id = $model->id;
            $this->title = $model->title;
            $this->description = $model->description;
            $this->poster_url = $model->poster_url;
            $this->address = $model->address;
        }

        $this->sort = $sort;
        $this->filters = $filters;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    public function getId():int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getPoster_url(): string
    {
        return $this->poster_url;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getStart_date(): string
    {
        return $this->start_date;
    }

    public function getEnd_date(): string
    {
        return $this->end_date;
    }

    public function getFacilities(): Collection
    {
        return $this->model->facilities;
    }

    public function getRoomFacilities(): Collection
    {
        return $this->model->roomFacilities();
    }

    public function getRoomMinPrice(): int
    {
        return $this->model->rooms->min('price');
    }



    public function getFilterRooms(): Collection
    {
        return $this->model->filterRooms(
            start_date: $this->start_date,
            end_date: $this->end_date,
            sort: $this->sort,
            filters: $this->filters
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'poster_url' => $this->poster_url,
            'address' => $this->address,
        ];
    }


}
