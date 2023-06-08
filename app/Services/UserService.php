<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;


class UserService extends BaseService
{
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function createModel($data): array|Collection|Builder|Model|null
    {
        $data['password'] = bcrypt($data['password']);
        return parent::createModel($data);
    }

    public function updateModel($data, $id): array|Collection|Builder|Model|null
    {
        $data['password'] = bcrypt($data['password']);
        return parent::updateModel($data, $id);
    }


}