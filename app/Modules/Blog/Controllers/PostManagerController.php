<?php

namespace App\Modules\Blog\Controllers;

use App\GlobalParams;
use App\Http\Requests\PostTypeInformationRequest;
use App\Models\Post;
use App\Modules\Blog\Repositories\PostRepository;
use App\Traits\ViewTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use PhpParser\Node\Expr\Array_;

class PostManagerController extends Controller
{
    use ViewTrait;

    private $request;
    private Array $postType;
    private PostRepository $repository;

    public function __construct(PostTypeInformationRequest $request, PostRepository $postRepository)
    {
        parent::__construct();
        $this->request = $request;
        $this->repository = $postRepository;
        $this->postType = $this->app['config']['blog'];

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $limit = $this->request->limit ?: 20;
        $offset = $this->request->offset ?: 1;
        $posts = $this->repository->all($this->request->all(), $offset, $limit);

        return self::view('blog::manager.post.index', [
            'data' => $posts,
            'nextAction' => 'blog-manager-show'

        ], $this->postType['title']);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return self::view('blog::manager.post.create', [
            'postType' => $this->postType,
            'nextAction' => 'blog-manager-store'
        ], $this->postType['menu']['add_new']['title']);
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store()
    {
        $params = $this->request->only(['title', 'path', 'description']);
        $params = array_merge($params, [
            'user_id' => Auth::id(),
            'path' => $params['path'] ?? Str::random(5),
            'post_type' => $this->app['config']['blog']['slug'],
        ]);

        $post = $this->repository->create($params);

        if (!$post)
            return back();

        return redirect(route('blog-manager-edit', ['post' => $post->id]));

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        $post = $this->repository->firstById($id);
        return self::view('blog::manager.post.show', [
            'postType' => $this->postType,
            'nextAction' => 'blog-manager-show',
            'method' => 'put',
            'data' => $post
        ], $post->title);
    }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit($id)
    {
        $post = $this->repository->firstById($id);

        return self::view('blog::manager.post.show', [
            'postType' => $this->postType,
            'nextAction' => 'blog-manager-show',
            'method' => 'put',
            'data' => $post
        ], $post->title);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id)
    {
        $post = $this->repository->firstById($id);
        $this->repository->update($post, $this->request->except(['_method', '_token', 'postType']));

        return redirect(route('blog-manager-edit', ['post' => $post->id]) . "?result=success");

    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy($id)
    {
        $this->repository->delete($id);

        return redirect(route('blog-manager-index') . "?result=success");
    }
}
