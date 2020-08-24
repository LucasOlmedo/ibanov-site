<?php

namespace App\Repositories\Posts;

use App\Models\Post;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;

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
        return $query->orderByDesc('DateIns')->with('user:userID,nome')->get();
    }

    /**
     * @param  array  $params
     * @return mixed
     */
    public function storePost(array $params)
    {
        $fileUpload = Arr::get($params, 'fileupload');
        if (empty($fileUpload)) {
            return false;
        }
        $params['userID'] = auth()->user()->userID;
        $params['imagem'] = base64_encode(file_get_contents($fileUpload));
        return $this->model::create($params);
    }

    public function updatePost(Post $post, array $params)
    {
        $fileUpload = Arr::get($params, 'fileupload');
        if (!empty($fileUpload)) {
            $params['imagem'] = base64_encode(file_get_contents($fileUpload));
        }
        return $post->update($params);
    }

    /**
     * @param  int  $id
     * @return mixed
     */
    public function getPost(int $id)
    {
        return $this->model::findOrFail($id);
    }

    /**
     * @param  Post  $post
     * @return bool|null
     * @throws Exception
     */
    public function deletePost(Post $post)
    {
        try {
            return $post->delete();
        } catch (Exception $e) {
            throw new $e;
        }
    }
}
