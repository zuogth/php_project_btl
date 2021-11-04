<?php

namespace App\Http\Services\Comment;

use App\Models\Comments;

class CommentService
{
    public function findAll()
    {
        return Comments::with(['product','user'])->get();
    }
}
