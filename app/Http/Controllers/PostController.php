<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Models\PostCategory;
use App\Queries\PostDataTable;
use App\Repositories\PostRepository;
use DataTables;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Laracasts\Flash\Flash;

class PostController extends AppBaseController
{
    /** @var  PostRepository */
    private $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * Display a listing of the Blog.
     *
     * @param  Request  $request
     *
     * @throws Exception
     *
     * @return Factory|View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new PostDataTable())->get())->make(true);
        }

        return view('blogs.index');
    }

    /**
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $blogCategories = PostCategory::pluck('name', 'id');

        return view('blogs.create', compact('blogCategories'));
    }

    /**
     * Store a newly created Blog in storage.
     *
     * @param  CreatePostRequest  $request
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreatePostRequest $request)
    {
        $input = $request->all();
        //dd($input);
        $blog = $this->postRepository->store($input);

        Flash::success('Post saved successfully.');

        return redirect(route('posts.index'));
    }

    /**
     * Show the form for editing the specified Blog.
     *
     * @param  Post  $post
     *
     * @return Application|Factory|View
     */
    public function show(Post $post)
    {
        $selectedBlogCategories = $post->postAssignCategory()->pluck('post_categories_id');

        return view('blogs.show', compact('post', 'selectedBlogCategories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Post  $post
     *
     * @return Application|Factory|View
     */
    public function edit(Post $post)
    {
        $selectedBlogCategories = $post->postAssignCategory()->pluck('post_categories_id');
        $blogCategories = PostCategory::pluck('name', 'id');

        return view('blogs.edit', compact('blogCategories', 'post', 'selectedBlogCategories'));
    }

    /**
     * Update the specified Blog in storage.
     *
     * @param  UpdatePostRequest  $request
     *
     * @param  Post  $post
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $input = $request->all();

        $this->postRepository->updateBlog($post, $input);

        Flash::success('Post updated successfully.');

        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified Blog from storage.
     *
     * @param  Post  $post
     *
     * @return JsonResource
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return $this->sendSuccess('Post deleted successfully.');
    }
}
