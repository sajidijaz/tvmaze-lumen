<?php

namespace App\Http\Services;

class ResultFilterService
{

    public function getFilteredResults(array $tvShows, string $query): array
    {
        $filtered = collect($tvShows)->filter(function ($value) use ($query) {
            return strtolower($value->show->name) === strtolower($query);
        });
        return $filtered->all();
    }

}
