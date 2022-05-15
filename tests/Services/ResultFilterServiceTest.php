<?php

namespace Tests\Services;

use App\Http\Services\ResultFilterService;
use Tests\TestCase;

class ResultFilterServiceTest extends TestCase
{

    /**
     * @dataProvider provider
     */
    public function testFilteredResults(array $provider): void
    {
        $resultFilterService = new ResultFilterService();
        $result = $resultFilterService->getFilteredResults($provider, 'deadwood');
        $this->assertEquals($provider[0]->show->name, $result[0]->show->name);
        $this->assertIsArray($result);
    }

    public function provider(): array
    {
        $tempClass = new \StdClass();
        $tempClass1 = new \StdClass();
        $tempClass1->score = '0.90784115';
        $tempClass->url = 'https://www.tvmaze.com/shows/565/deadwood';
        $tempClass->name = 'Deadwood';
        $tempClass->type = 'Scripted';
        $tempClass1->show = $tempClass;
        return [
            [
                [$tempClass1]
            ]
        ];
    }

}
