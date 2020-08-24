<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Posts\PostRepository;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
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

    /**
     * @param  Request  $request
     * @return RedirectResponse
     */
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

    /**
     * @param  int  $id
     */
    public function show(int $id)
    {

    }

    /**
     * @param  int  $id
     * @return Application|Factory|View
     * @throws Exception
     */
    public function edit(int $id)
    {
        try {
            $post = $this->postRepository->getPost($id);
            return view('admin.post.partials.edit', ['post' => $post]);
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * @param  Request  $request
     * @param  int  $id
     * @return RedirectResponse
     * @throws Exception
     */
    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'titulo' => 'required|string',
            'Texto' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->with(['error' => $validator->errors()->getMessages()])
                ->withInput();
        }

        try {
            $post = $this->postRepository->getPost($id);
            $result = $this->postRepository->updatePost($post, $request->all());
            if ($result) {
                return redirect()
                    ->route('admin.post.index')
                    ->with('success', 'Depoimento atualizado!');
            }
            return redirect()
                ->back()
                ->with(['error' => 'Ocorreu um erro ao atualizar o depoimento!'])
                ->withInput();
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * @param  int  $id
     * @return JsonResponse
     * @throws Exception
     */
    public function delete(int $id)
    {
        try {
            $post = $this->postRepository->getPost($id);
            if ($this->postRepository->deletePost($post)) {
                return response()->json([
                    'message' => 'Removido com sucesso!'
                ]);
            }
            throw new Exception('Não foi possível remover o depoimento!');
        } catch (Exception $e) {
            throw $e;
        }
    }
}
