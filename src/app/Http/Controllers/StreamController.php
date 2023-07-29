<?php

namespace App\Http\Controllers;

use App\Http\Resources\StreamResource;
use App\Models\Stream;

class StreamController extends Controller
{
    public function index()
    {
        $streams = Stream::all();
        return StreamResource::collection($streams);
    }

    public function show(Stream $stream)
    {
        return new StreamResource($stream);
    }
}
