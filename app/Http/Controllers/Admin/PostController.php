<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Posts\PostRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class PostController
 * @package App\Http\Controllers\Admin
 */
class PostController extends Controller
{
    /**
     * @var PostRepository
     */
    private $postRepository;

    /**
     * UserController constructor.
     * @param  PostRepository  $postRepository
     */
    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * @param  Request  $request
     * @return Application|Factory|JsonResponse|View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return response()->json(
                $this->postRepository->getPostList($request->all())
            );
        }
        return view('admin.post.index');
    }

    public function store()
    {

    }

    public function show()
    {

    }

    public function update()
    {

    }

    public function delete()
    {

    }
}
