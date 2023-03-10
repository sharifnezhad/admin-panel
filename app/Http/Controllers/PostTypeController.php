<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostTypeInformationRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class PostTypeController extends Controller
{
    private $request;

    public function __construct(PostTypeInformationRequest $request)
    {
        parent::__construct();
        $this->request = $request;

    }

    /**
     * Display a listing of the resource.
     */
    public function index($name)
    {
        $limit = $this->request->limit ?: 20;
        $offset = $this->request->offset ?: 1;
        $posts = Post::query()
            ->with(['user'])
            ->where('post_type', $name)
            ->paginate($limit, ['*'], $offset);

        return self::view('manager.postType.index', [
            'posts' => $posts,
            'post_type' => $this->request->postType['name']
        ], $this->request->postType['labels']['title']);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return self::view('manager.postType.create', [
            'postType' => $this->request->postType,
        ], $this->request->postType['labels']['add_new']);
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store()
    {
        $params = $this->request->only(['title', 'path', 'description']);
        $params['user_id'] = Auth::id();
        $params['path'] = $params['path'] ?? Str::random(5);
        $params['post_type'] = $this->request->postType['name'];
        $post = Post::query()->create($params);
        if (!$post)
            return back();

        return redirect(self::$dashboardUrl . "/posttype/{$this->request->postType['slug']}/{$post->id}/edit");
    }

    /**
     */
    public function show($name, $id)
    {
        $post = Post::find($id);
        return self::view('manager.postType.create', [
            'postType' => $this->request->postType,
            'nextAction' => $post->id,
            'method' => 'put',
            'post' => $post
        ], $post->title);
    }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit($name, $id)
    {
        $post = Post::find($id);
        return self::view('manager.postType.create', [
            'postType' => $this->request->postType,
            'nextAction' => $post->id,
            'method' => 'put',
            'post' => $post
        ], $post->title);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($name, $id)
    {
        $post = Post::query()
            ->whereId($id);
        $post->update($this->request->except(['_method', '_token', 'postType']));

        return redirect(self::$dashboardUrl . "/posttype/{$this->request->postType['slug']}/{$post->first()->id}/edit?result=success");
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy($name, $id)
    {
        Post::query()
            ->whereId($id)
            ->delete();

        return redirect(self::$dashboardUrl . "/posttype/{$this->request->postType['slug']}?result=success");
    }
}
