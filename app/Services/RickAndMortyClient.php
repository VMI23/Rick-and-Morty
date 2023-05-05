<?php

declare(strict_types=1);

namespace RickAndMorty\Services;

use GuzzleHttp\Client;
use RickAndMorty\Models\Character;
use RickAndMorty\Models\Episode;
use RickAndMorty\Models\Location;

class RickAndMortyClient
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://rickandmortyapi.com/api/',
        ]);
    }

    public function locations(): array
    {
        $locationIds = implode(",", range(1, 126));
        $locations = [];

        $responseLocations = $this->client->get("location/$locationIds");
        $dataLocations = json_decode($responseLocations->getBody()->getContents());

        $characters = $this->characters();
        foreach ($dataLocations as $location) {
            $residents = [];
            foreach ($location->residents as $residentUrl) {
                $residentId = $this->extractId($residentUrl);
                if (isset($characters[$residentId])) {
                    $residents[] = $characters[$residentId];
                }
            }
            $locations[$location->id] = new Location(
                $location->id,
                $location->name,
                $location->type,
                $location->dimension,
                $residents
            );
        }
        return $locations;
    }

    public function characters(): array
    {
        $charIds = implode(",", range(1, 826));
        $chars = [];

        $responseChars = $this->client->get("character/$charIds");
        $dataChar = json_decode($responseChars->getBody()->getContents());

        // Retrieve episodes data
        $episodeIds = implode(",", range(1, 51));

        $episodes = [];
        $responseEpisodes = $this->client->get("episode/$episodeIds");
        $dataEp = json_decode($responseEpisodes->getBody()->getContents());

        foreach ($dataEp as $episode) {
            $episodes[$episode->id] = $episode->name;
        }

        foreach ($dataChar as $character) {
            $chars[$character->id] = new Character(
                $character->id,
                $character->name,
                $character->status,
                $character->species,
                $character->gender,
                $character->origin->name,
                $character->origin->url,
                $character->location->name,
                $character->location->url,
                $character->image,
                $episodes[$this->extractId($character->episode[0])]
            );
        }

        return $chars;
    }

    public function episodes(): array
    {
        $episodeIds = implode(",", range(1, 51));
        $episodes = [];

        // Retrieve episodes data
        $responseEpisodes = $this->client->get("episode/$episodeIds");
        $dataEpisodes = json_decode($responseEpisodes->getBody()->getContents());

        $characters = $this->characters();

        foreach ($dataEpisodes as $episode) {
            $episodeCharacters = [];
            foreach ($episode->characters as $characterUrl) {
                $characterId = $this->extractId($characterUrl);
                if (isset($characters[$characterId])) {
                    $episodeCharacters[] = $characters[$characterId];
                }
            }
            $episodes[$episode->id] = new Episode(
                $episode->id,
                $episode->name,
                $episode->air_date,
                $episode->episode,
                $episodeCharacters
            );
        }
        return $episodes;
    }

    protected function extractId($url): int
    {
        $path = parse_url($url, PHP_URL_PATH);
        $id = substr($path, strrpos($path, '/') + 1);
        return intval($id);
    }
}