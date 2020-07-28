<?php

namespace App\Repositories\Users;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

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
}
