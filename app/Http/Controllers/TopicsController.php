<?php

namespace App\Http\Controllers;

use App\Categories\Category;
use App\Http\Requests\StoreTopicRequest;
use App\Topics\Commands\StoreTopicCommand;
use App\Topics\Comments\Comment;
use App\Topics\Comments\Repositories\CommentsRepositoryInterface;
use App\Topics\Repositories\TopicsRepositoryInterface;
use App\Topics\Topic;
use App\Topics\TopicCategory;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TopicsController
{
    private $topics;
    private $comments;
    private $commandBus;

    public function __construct(
        TopicsRepositoryInterface $topics,
        CommentsRepositoryInterface $comments,
        Dispatcher $commandBus
    ) {
        $this->topics = $topics;
        $this->comments = $comments;
        $this->commandBus = $commandBus;
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

        return view('topics.show')->with(compact('topic', 'user'));
    }

    public function store(StoreTopicRequest $request)
    {
        $user = null;
        if (Auth::user()) {
            $user = Auth::user();
        }

        try {
            $this->commandBus->dispatch(new StoreTopicCommand(
                $request->get('title'),
                $request->get('content'),
                $request->get('tags'),
                $user,
                $request->get('categories')
            ));
        } catch (\Exception $e) {
            Log::error($e);
        }

        return redirect()->route('topics.index');
    }

    public function voteCommentUp($commentId)
    {
        $comment = $this->comments->find($commentId);

        $votes = $comment->getVotes();
        $votes++;

        $comment->setVotes($votes);

        $this->comments->store($comment);

        return redirect()->back();
    }

    public function voteCommentDown($commentId)
    {
        $comment = $this->comments->find($commentId);

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
        $comment->setContent(trim($request->get('content')));
        $comment->setTags($request->get('tags'));
        $comment->setVotes(0);
        $comment->setUser($user);

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
        if ($categoryId == 0) {
            return redirect()->route('topics.index');
        }

        $user = null;
        if (Auth::user()) {
            $user = Auth::user();
        }

        $categories = Category::get()->all();
        /** @var Category $category */
        $category = Category::where('id', $categoryId)->get()->first();

        /** @var TopicCategory[] $categoryTopics */
        $categoryTopics = TopicCategory::where('category_id', $categoryId)->get()->all();

        $topics = [];
        foreach ($categoryTopics as $categoryTopic) {
            $topics[] = $categoryTopic->getTopic();
        }

        return view('topics.index')->with(compact('topics', 'category', 'categories', 'user'));
    }

    public function byTag($tag)
    {
        $user = Auth::user();

        /** @var Topic[] $allTopics */
        $allTopics = Topic::get()->all();
        $topics = [];

        foreach ($allTopics as $topic) {
            $tags = explode(',', $topic->getTags());
            if (in_array($tag, $tags)) {
                $topics[] = $topic;
            }
        }

        $categories = Category::get()->all();

        return view('topics.index')->with(compact('topics', 'categories', 'user', 'tag'));
    }

    public function commentsByTag($topicId, $tag)
    {
        $user = Auth::user();

        /** @var Topic $topic */
        $topic = Topic::where('id', $topicId)->get()->first();

        $comments = [];
        $allComments = $topic->getComments();

        foreach ($allComments as $comment) {
            $tags = explode(',', $comment->getTags());
            if (in_array($tag, $tags)) {
                $comments[] = $comment;
            }
        }

        return view('topics.show')->with(compact('topic', 'comments', 'user'));
    }
}
