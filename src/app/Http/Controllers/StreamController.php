<?php

namespace App\Http\Controllers;

use App\Events\ChatCommentSended;
use App\Events\ChatLiked;
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
        $comment = new Comment();
        $comment->nickname = $request->nickname;
        $comment->body = $request->body;
        $comment->stream_id = $stream->id;
        $comment->save();

        ChatCommentSended::dispatch($comment);

        return new CommentResource($comment);
    }

    public function like(Stream $stream)
    {
        $stream->like++;
        $stream->save();

        ChatLiked::dispatch($stream);

        return new StreamResource($stream);
    }
}
