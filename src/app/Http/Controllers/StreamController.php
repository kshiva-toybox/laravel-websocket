<?php

namespace App\Http\Controllers;

use App\Http\Requests\Stream\PostCommentRequest;
use App\Http\Resources\CommentResource;
use App\Http\Resources\StreamResource;
use App\Models\Comment;
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

    public function comments(Stream $stream)
    {
        return CommentResource::collection($stream->comments);
    }

    public function postComment(Stream $stream, PostCommentRequest $request)
    {
        $stream->comments()->create([
            'nickname' => $request->nickname,
            'body' => $request->body,
        ]);
        return response()->json([
            'message' => 'Comment posted successfully',
        ]);
    }
}
