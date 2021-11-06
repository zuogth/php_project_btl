<?php

namespace App\Http\Services\Admin\Comment;

use App\Models\Comments;

class CommentService
{
    public function findAll()
    {
        return Comments::with(['product','user'])->get();
    }
}
