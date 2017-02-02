<?php

namespace App\Topics\Comments\Repositories;

use App\Topics\Comments\Comment;

interface CommentsRepositoryInterface
{
    public function store(Comment $comment);

    /**
     * @param $id
     * @return Comment
     */
    public function find($id);
}
