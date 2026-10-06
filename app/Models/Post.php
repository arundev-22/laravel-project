<?php

namespace App\Models;

use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    protected $fillable = ['user_id', 'title', 'image', 'content'];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }   

    public function comments() : HasMany
    {
        return $this->hasMany(Comment::class);
    }
}