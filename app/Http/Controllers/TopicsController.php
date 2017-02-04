<?php

namespace App\Http\Controllers;

use App\Categories\Category;
use App\Http\Requests\StoreTopicRequest;
use App\Topics\Comments\Repositories\CommentsRepositoryInterface;
use App\Topics\Repositories\TopicsRepositoryInterface;
use App\Topics\Topic;
use Illuminate\Http\Request;

class TopicsController
{
    private $topics;
    private $comments;

    public function __construct(TopicsRepositoryInterface $topics, CommentsRepositoryInterface $comments)
    {
        $this->topics = $topics;
        $this->comments = $comments;
    }

    public function index()
    {
        $topics = $this->topics->all();

        return view('topics.index')->with(compact('topics'));
    }

    public function show($id)
    {
        $topic = $this->topics->find($id);

        return view('topics.show')->with(compact('topic'));
    }

    public function store(Request $request)
    {
        $topic = new Topic();

        $topic->setTitle($request->get('title'));
        $topic->setContent($request->get('content'));
        $topic->setTags($request->get('tags'));
        $topic->setAttribute('user_id', 2);

        if ($request->get('category')) {
            $category = Category::where('id', $request->get('category'))->get()->first();
        }

        $topic->timestamps = false;

        $topic->save();

        return redirect()->route('topics.index');
    }

    public function voteCommentUp($commentId)
    {
        $comment = $this->comments->find($commentId);
        $comment->timestamps = false;

        $votes = $comment->getVotes();
        $votes++;


        $comment->setVotes($votes);

        $this->comments->store($comment);

        return redirect()->back();
    }

    public function voteCommentDown($commentId)
    {
        $comment = $this->comments->find($commentId);
        $comment->timestamps = false;

        $votes = $comment->getVotes();
        $votes--;


        $comment->setVotes($votes);

        $this->comments->store($comment);

        return redirect()->back();
    }

    public function create()
    {
        $categories = Category::get()->all();
        return view('topics.create')->with(compact('categories'));
    }
}
