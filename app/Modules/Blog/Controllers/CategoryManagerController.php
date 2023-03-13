<?php

namespace App\Modules\Blog\Controllers;

use App\Modules\Blog\Repositories\CategoryRepository;
use App\Traits\ViewTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CategoryManagerController extends Controller
{
    use ViewTrait;

    private CategoryRepository $repository;
    private Request $request;
    private mixed $postType;

    public function __construct(CategoryRepository $repository, Request $request)
    {
        parent::__construct();
        $this->repository = $repository;
        $this->request = $request;
        $this->postType = $this->app['config']['blog'];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $limit = $this->request->limit ?: 20;
        $offset = $this->request->offset ?: 1;
        $categories = $this->repository->all($this->request->all(), $offset, $limit);

        return self::view('blog::adminArea.index', [
            'data' => $categories,
            'nextAction' => 'blog-manager-category-show'
        ], $this->postType['title']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return self::view('blog::adminArea.create', [
            'postType' => $this->postType,
            'nextAction' => 'blog-manager-category-store'
        ], $this->postType['menu']['add_new']['title']);
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(Request $request)
    {
        $params = $this->request->only(['title', 'path', 'description']);
        $params = array_merge($params, [
            'user_id' => Auth::id(),
            'path' => $params['path'] ?? Str::random(5),
            'post_type' => $this->app['config']['blog']['slug'],
        ]);

        $category = $this->repository->create($params);

        if (!$category)
            return back();

        return redirect(route('blog-manager-category-edit', ['category' => $category->id]));

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        $category = $this->repository->firstById($id);
        return self::view('blog::adminArea.show', [
            'postType' => $this->postType,
            'nextAction' => 'blog-manager-category-show',
            'method' => 'put',
            'data' => $category
        ], $category->title);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     */
    public function edit($id)
    {
        $category = $this->repository->firstById($id);

        return self::view('blog::adminArea.show', [
            'postType' => $this->postType,
            'nextAction' => 'blog-manager-category-show',
            'method' => 'put',
            'data' => $category
        ], $category->title);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     */
    public function update(Request $request, $id)
    {
        $category = $this->repository->firstById($id);
        $this->repository->update($category, $this->request->except(['_method', '_token', 'postType']));

        return redirect(route('blog-manager-category-edit', ['category' => $category->id]) . "?result=success");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        $this->repository->delete($id);

        return redirect(route('blog-manager-category-index') . "?result=success");

    }
}
