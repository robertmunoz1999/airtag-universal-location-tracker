<?php

namespace App\Http\Resources;

use App\Models\Airtag;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AirtagResource extends JsonResource
{
    /** @var Airtag */
    public $resource;

    public function toArray(Request $request)
    {
        return [
            'identifier' => $this->resource->identifier,
            'name' => $this->resource->name,
            'located_at' => $this->resource->located_at,
            'latitude' => $this->resource->latitude,
            'longitude' => $this->resource->longitude,
        ];
    }
}
