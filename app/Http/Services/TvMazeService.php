<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Http;

class TvMazeService
{
    private const BASE_URL = 'https://api.tvmaze.com/';

    public function getTvShows(string $query): array
    {
        $response = Http::get(self::BASE_URL . 'search/shows?q=' . $query);
        if ($response->failed()) {
            return ['error' => true, 'message' => 'Something went wrong with tv maze api'];
        }
        return json_decode($response->body());
    }
}
