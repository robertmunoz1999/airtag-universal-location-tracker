<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAirtagRequest;
use App\Http\Resources\AirtagResource;
use App\Models\Airtag;

class AirtagController extends Controller
{
    public function index()
    {
        $latestAirtags = Airtag::all()->groupBy('identifier')
            ->map(function ($group) {
                return $group->sortByDesc('located_at')->first();
            })
            ->values();

        return AirtagResource::collection($latestAirtags);
    }

    public function store(StoreAirtagRequest $request)
    {
        $data = $request->validated()['airtags-info'];

        foreach ($data as $airtagInfo) {
            Airtag::create($airtagInfo);
        }

        return response()->json(['message' => 'Airtag almacenado correctamente'], 201);
    }
}
