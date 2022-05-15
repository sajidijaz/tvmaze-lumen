<?php

namespace App\Http\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class TvShowService
{
    private TvMazeService $tvMazeService;
    private ResultFilterService $resultFilterService;

    public function __construct(TvMazeService $tvMazeService,ResultFilterService $resultFilterService)
    {
        $this->tvMazeService = $tvMazeService;
        $this->resultFilterService = $resultFilterService;
    }

    public function getResults(string $query): array
    {
        if (Cache::has($query)) {
            return Cache::get($query);
        }
        $getTvShows = $this->tvMazeService->getTvShows($query);
        if (!empty($getTvShows['error']) && $getTvShows['error'] === true) {
            return $getTvShows;
        }
        $responseBody = $this->resultFilterService->getFilteredResults($getTvShows, $query);
        if (!empty($responseBody)) {
            Cache::put($query, $responseBody, Carbon::now()->addMinutes(2));
        }
        return $responseBody;
    }

}
