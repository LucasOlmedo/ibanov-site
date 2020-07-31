<?php

namespace App\Repositories\Users;

use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserRepository
 * @package App\Repositories\Users
 */
class UserRepository
{
    /**
     * @var User
     */
    private $model;

    /**
     * UserRepository constructor.
     * @param  User  $user
     */
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    /**
     * @param  array  $params
     * @return Builder[]|Collection
     */
    public function getUserList(array $params = [])
    {
        $query = $this->model->newQuery();
        return $query->get();
    }

    /**
     * @param  array  $params
     * @return mixed
     */
    public function storeUser(array $params = [])
    {
        $path = "https://www.gravatar.com/avatar/".md5(strtolower(trim($params['email'])))."?d=identicon&s=250";
        $params['avatar'] = base64_encode(file_get_contents($path));
        $params['sysAdmin'] = (bool)Arr::get($params, 'sysAdmin');
        $params['password'] = Hash::make('#ibanov.1234');
        return $this->model::create($params);
    }

    /**
     * @param  int  $id
     * @return mixed
     */
    public function getUser(int $id)
    {
        return $this->model::findOrFail($id);
    }

    /**
     * @param  User  $user
     * @return bool|null
     * @throws Exception
     */
    public function deleteUser(User $user)
    {
        try {
            return $user->delete();
        } catch (Exception $e) {
            throw new $e;
        }
    }
}
