<?php

namespace App\Http\Controllers;

use App\Http\Services\TvShowService;
use Illuminate\Http\Request;

class JsonApiController extends Controller
{

    private TvShowService $tvShowService;

    public function __construct(TvShowService $tvShowService)
    {
        $this->tvShowService = $tvShowService;
    }

    public function index(Request $request): array
    {
        $this->validate($request, [
            'q' => 'required|regex:/^[A-Za-z0-9 ]+$/|min:1',
        ]);
        return $this->tvShowService->getResults($request->get('q'));
    }

}
