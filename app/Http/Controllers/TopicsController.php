<?php

namespace App\Http\Controllers;

use App\Categories\Category;
use App\Http\Requests\StoreTopicRequest;
use App\Topics\Comments\Comment;
use App\Topics\Comments\Repositories\CommentsRepositoryInterface;
use App\Topics\Repositories\TopicsRepositoryInterface;
use App\Topics\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $user = null;
        if (Auth::user()) {
            $user = Auth::user();
        }

        $topics = $this->topics->all();
        $categories = Category::get()->all();

        return view('topics.index')->with(compact('topics', 'categories', 'user'));
    }

    public function show($id)
    {
        $user = null;
        if (Auth::user()) {
            $user = Auth::user();
        }

        $topic = $this->topics->find($id);

        $comments = $topic->getComments();

        return view('topics.show')->with(compact('topic', 'user'));
    }

    public function store(Request $request)
    {
        $user = null;
        if (Auth::user()) {
            $user = Auth::user();
        }

        $topic = new Topic();

        $topic->setTitle($request->get('title'));
        $topic->setContent($request->get('content'));
        $topic->setTags($request->get('tags'));
        $topic->setUser($user);

        if ($request->get('category')) {
            $category = Category::where('id', $request->get('category'))->get()->first();
        }

//        $topic->timestamps = false;

        $topic->save();

        return redirect()->route('topics.index');
    }

    public function voteCommentUp($commentId)
    {
        $comment = $this->comments->find($commentId);
//        $comment->timestamps = false;

        $votes = $comment->getVotes();
        $votes++;


        $comment->setVotes($votes);

        $this->comments->store($comment);

        return redirect()->back();
    }

    public function voteCommentDown($commentId)
    {
        $comment = $this->comments->find($commentId);
//        $comment->timestamps = false;

        $votes = $comment->getVotes();
        $votes--;

        $comment->setVotes($votes);

        $this->comments->store($comment);

        return redirect()->back();
    }

    public function create()
    {
        $user = null;
        if (Auth::user()) {
            $user = Auth::user();
        }

        $categories = Category::get()->all();

        return view('topics.create')->with(compact('categories', 'user'));
    }

    public function storeComment($id, Request $request)
    {
        $user = Auth::user();
        $topic = Topic::where('id', $id)->get()->first();

        $comment = new Comment();

        $comment->setTopic($topic);
        $comment->setContent($request->get('content'));
        $comment->setTags($request->get('tags'));
        $comment->setVotes(0);
        $comment->setUser($user);

//        $comment->timestamps = false;

        $comment->save();

        return redirect()->route('topics.show', $id);
    }

    public function delete($id)
    {
        $topic = Topic::where('id', $id)->get()->first();

        $topic->delete();

        return redirect()->route('topics.index');
    }

    public function deleteComment($topicId, $commentId)
    {
        $comment = Comment::where('id', $commentId)->get()->first();
        if ($comment) {
            $comment->delete();
        }

        return redirect()->route('topics.show', $topicId);
    }

    public function getByCategory($categoryId)
    {
        $user = null;
        if (Auth::user()) {
            $user = Auth::user();
        }

        $categories = Category::get()->all();
        /** @var Category $category */
        $category = Category::where('id', $categoryId)->get()->first();

        $topics = $category->getTopics();

        return view('topics.index')->with(compact('topics', 'category', 'categories', 'user'));
    }
}
