<?php

namespace App\Repositories\Posts;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class PostRepository
 * @package App\Repositories\Posts
 */
class PostRepository
{
    /**
     * @var Post
     */
    private $model;

    /**
     * UserRepository constructor.
     * @param  Post  $post
     */
    public function __construct(Post $post)
    {
        $this->model = $post;
    }

    /**
     * @param  array  $params
     * @return Builder[]|Collection
     */
    public function getPostList(array $params = [])
    {
        /** @var User $authUser */
        $authUser = auth()->user();
        $query = $this->model->newQuery();
        if (!$authUser->isAdmin()) {
            $query->where('userID', '=', $authUser->userID);
        }
        return $query->get();
    }
}
