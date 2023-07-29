<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'nickname',
        'body',
    ];

    public function stream()
    {
        return $this->belongsTo(Stream::class);
    }
}
