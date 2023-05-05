<?php

declare(strict_types=1);

namespace RickAndMorty\Models;

class Character
{
    private int $id;
    private string $name;
    private string $status;
    private string $species;
    private string $gender;
    private string $originName;
    private string $originUrl;
    private string $lastLocationName;
    private string $lastLocationUrl;
    private string $imageUrl;
    private string $firstSeenEpisodeName;

    public function __construct(
        int $id,
        string $name,
        string $status,
        string $species,
        string $gender,
        string $originName,
        string $originUrl,
        string $lastLocationName,
        string $lastLocationUrl,
        string $imageUrl,
        string $firstSeenEpisodeName
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->status = $status;
        $this->species = $species;
        $this->gender = $gender;
        $this->originName = $originName;
        $this->originUrl = $originUrl;
        $this->lastLocationName = $lastLocationName;
        $this->lastLocationUrl = $lastLocationUrl;
        $this->imageUrl = $imageUrl;
        $this->firstSeenEpisodeName = $firstSeenEpisodeName;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getSpecies(): string
    {
        return $this->species;
    }

    public function getGender(): string
    {
        return $this->gender;
    }

    public function getOriginName(): string
    {
        return $this->originName;
    }

    public function getOriginUrl(): string
    {
        return $this->originUrl;
    }

    public function getLastLocationName(): string
    {
        return $this->lastLocationName;
    }

    public function getLastLocationUrl(): string
    {
        return $this->lastLocationUrl;
    }

    public function getImageUrl(): string
    {
        return $this->imageUrl;
    }

    public function getFirstSeenEpisodeName(): string
    {
        return $this->firstSeenEpisodeName;
    }
}
