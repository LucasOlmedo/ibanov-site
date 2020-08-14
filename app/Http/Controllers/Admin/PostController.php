<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Posts\PostRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.post.partials.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'titulo' => 'required|string',
            'Texto' => 'required|string',
            'fileupload' => 'required|file',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->with(['error' => $validator->errors()->getMessages()])
                ->withInput();
        }

        $result = $this->postRepository->storePost($request->all());
        if ($result) {
            return redirect()
                ->route('admin.post.index')
                ->with('success', 'Depoimento publicado!');
        }
        return redirect()
            ->back()
            ->with(['error' => 'Ocorreu um erro ao publicar o depoimento!'])
            ->withInput();
    }

    public function show()
    {

    }

    /**
     * @return Application|Factory|View
     */
    public function edit()
    {
        return view('admin.post.partials.edit');
    }

    public function update()
    {

    }

    public function delete()
    {

    }
}
