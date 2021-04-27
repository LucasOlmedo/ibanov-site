<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\Users\UserRepository;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

/**
 * Class UserController
 * @package App\Http\Controllers\Admin
 */
class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * UserController constructor.
     * @param  UserRepository  $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param  Request  $request
     * @return Application|Factory|JsonResponse|View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return response()->json(
                $this->userRepository->getUserList($request->all())
            );
        }
        return view('admin.user.index');
    }

    /**
     * @param  Request  $request
     * @return JsonResponse|void
     * @throws Exception
     */
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'nome' => 'required',
                'email' => 'required|email|unique:Users',
            ]);

            $newUser = $this->userRepository->storeUser($request->all());
            if ($newUser) {
                return response()->json([
                    'message' => 'Usuário cadastrado com sucesso!',
                ]);
            }

            throw new Exception('Não foi possível cadastrar o usuário!', 500);
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * @param  int  $id
     * @return JsonResponse
     * @throws Exception
     */
    public function show(int $id)
    {
        try {
            $user = $this->userRepository->getUser($id);
            if ($user instanceof User) {
                return response()->json($user);
            }
            throw new Exception('Não foi possível encontrar o usuário!', 404);
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * @param  int  $id
     * @param  Request  $request
     * @return JsonResponse
     * @throws Exception
     */
    public function update(int $id, Request $request)
    {
        try {
            $user = $this->userRepository->getUser($id);
            if ($user instanceof User) {
                $updatedUser = $this->userRepository->updateUser($user, $request->all());
                if ($updatedUser) {
                    return response()->json([
                        'message' => 'Usuário atualizado com sucesso!',
                    ]);
                }
                throw new Exception('Não foi possível atualizar o usuário!', 500);
            }
            throw new Exception('Não foi possível encontrar o usuário!', 404);
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
            $user = $this->userRepository->getUser($id);
            if ($this->userRepository->deleteUser($user)) {
                return response()->json([
                    'message' => 'Removido com sucesso!'
                ]);
            }
            throw new Exception('Não foi possível remover o usuário!');
        } catch (Exception $e) {
            throw $e;
        }
    }
}
