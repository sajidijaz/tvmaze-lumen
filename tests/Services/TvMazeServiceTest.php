<?php

namespace Tests\Services;

use App\Http\Services\TvMazeService;
use Tests\TestCase;

class TvMazeServiceTest extends TestCase
{
    public function testGetTvShowsIfMatched(): void
    {
        $tvMazeService = new TvMazeService();
        $response = $tvMazeService->getTvShows('deadwood');
        $this->assertEquals('Deadwood', $response[0]->show->name);
    }

    public function testGetTvShowsIfNotMatched(): void
    {
        $tvMazeService = new TvMazeService();
        $response = $tvMazeService->getTvShows('wrong movie name');
        $this->assertEmpty($response);
    }
}
