<?php

namespace Tests\Services;

use App\Http\Services\ResultFilterService;
use App\Http\Services\TvMazeService;
use App\Http\Services\TvShowService;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class TvShowServiceTest extends TestCase
{
    private TvMazeService $tvMazeService;
    private ResultFilterService $resultFilterService;
    private TvShowService $tvShowService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->tvMazeService = $this->createMock(TvMazeService::class);
        $this->resultFilterService = $this->createMock(ResultFilterService::class);
        $this->tvShowService = new TvShowService($this->tvMazeService, $this->resultFilterService);
    }

    public function testIfSomethingWrongInMazeApi(): void
    {
        $this->tvMazeService->method('getTvShows')->willReturn(
            ['error' => true, 'message' => 'Something went wrong with tv maze api']
        );
        $result = $this->tvShowService->getResults('deadwood');
        $this->assertEquals('Something went wrong with tv maze api', $result['message']);
    }

    public function testMazeApiFilteredResultIfEmpty(): void
    {
        $this->resultFilterService->method('getFilteredResults')->willReturn([]);
        $response = $this->tvShowService->getResults('deadwood');
        $this->assertCount(0, $response);
    }

    /**
     * @dataProvider provider
     */
    public function testMazeApiFilteredResultIfNotEmpty(array $provider): void
    {
        $this->resultFilterService->method('getFilteredResults')->willReturn($provider);
        $response = $this->tvShowService->getResults('deadwood');
        $this->assertEquals($provider['show']->name, $response['show']->name);
    }

    /**
     * @dataProvider provider
     */
    public function testGetCacheValue(array $provider): void
    {
        $this->resultFilterService->method('getFilteredResults')->willReturn($provider);
        $this->tvShowService->getResults('deadwood');
        $this->assertEquals($provider['show']->name, Cache::get('deadwood')['show']->name);
    }

    public function provider(): array
    {
        $tempClass = new \StdClass();
        $tempClass->url = 'https://www.tvmaze.com/shows/565/deadwood';
        $tempClass->name = 'Deadwood';
        $tempClass->type = 'Scripted';
        return [
            [
                [
                    'score' => '0.90784115',
                    'show' => $tempClass
                ]
            ]
        ];
    }

}
