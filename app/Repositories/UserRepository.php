<?php

namespace App\Repositories;

use App\Constants\GeneralStatus;
use App\Models\BaseModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class UserRepository extends BaseRepository
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function create($data): array|Collection|Builder|BaseModel|null
    {
        $model = $this->getBaseModel();
        $model->fill($data);
        $model->save();
        if (isset($data['roles']))
        {
            foreach ($data['roles'] as $role)
            {
                UserRolea::create([
                    'user_id' => $model->id,
                    'role_code' => $role['role_code'],
                    'status' => $role['status'] ? GeneralStatus::STATUS_ACTIVE : GeneralStatus::STATUS_NOT_ACTIVE
                ]);
            }
        }
        return $model;
    }

    public function update($data, $id): BaseModel|array|Collection|Builder|null
    {
        $model = $this->findById($id);
        $model->fill($data);
        $model->save();
        if (isset($data['roles']))
            {
                foreach ($data['roles'] as $role)
                {
                    UserROles::create([
                        'user_id' => $model->id,
                        'role_code' => $role['role_code'],
                        'status' => $role['status'] ? GeneralStatus::STATUS_ACTIVE : GeneralStatus::STATUS_NOT_ACTIVE,
                    ]);
                }
            }
        return $model;
    }

    public function findByEmail($email)
    {
        $model = $this->getBaseModel();
        return $model::query()->where('email', '=', $email)->first();
    }

    public function findByEmailOrName($emailOrName)
    {
        $model = $this->getBaseModel();
        return $model::query()->where('email', '=', $emailOrName)->orWhere('name', '=', $emailOrName)->first();
    }

    public function createToken(string $email): string
    {
        $model = $this->findByEmailOrName($email);
        return $model->createToken('auth_token')->plainTextToken;
    }

    public function removeToken(string|user $email): int
    {
        if (is_string($email))
        {
            $model = $this->findByEmail($email);
        }else{
            $model = $email;
        }

        return $model->tokens()->delete();
    }
}