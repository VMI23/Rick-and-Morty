<?php

declare(strict_types=1);

namespace RickAndMorty\Controllers;

use RickAndMorty\Core\TwigView;
use RickAndMorty\Services\RickAndMortyClient;
//Not suggested to load twig here!
class Controller
{
    public function locations(): TwigView
    {
        $locations = (new RickAndMortyClient())->locations();
        $totalLocations = count($locations);

        $limit = 9;
        $currentPage = $_GET['page'] ?? 1;
        $numPages = ceil($totalLocations / $limit);

        $params = [
            'locations' => $locations,
            'currentPage' => $currentPage,
            'numPages' => $numPages,
            'limit' => $limit,
            'totalLocations' => $totalLocations,
        ];
        return new TwigView('locations', $params);
    }

    public function episodes(): TwigView
    {
        $episodes = (new RickAndMortyClient())->episodes();
        $totalEpisodes = count($episodes);

        $limit = 9;
        $currentPage = $_GET['page'] ?? 1;
        $numPages = ceil($totalEpisodes / $limit);

        $params = [
            'episodes' => $episodes,
            'currentPage' => $currentPage,
            'numPages' => $numPages,
            'limit' => $limit,
            'totalEpisodes' => $totalEpisodes,
        ];
        return new TwigView('episodes', $params);
    }

    public function characters(): TwigView
    {
        $chars = (new RickAndMortyClient())->characters();
        $totalChars = count($chars);

        $limit = 9;
        $currentPage = $_GET['page'] ?? 1;
        $numPages = ceil($totalChars / $limit);

        $params = [
            'Chars' => $chars,
            'current_page' => $currentPage,
            'num_pages' => $numPages,
            'limit' => $limit,
            'total_chars' => $totalChars,
        ];

        return new TwigView('characters', $params);
    }

}