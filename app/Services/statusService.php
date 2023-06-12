<?php

namespace App\Services;

use App\Repositories\statusRepository;


class statusService extends BaseService
{
    public function __construct(statusRepository $repository)
    {
        $this->repository = $repository;
    }

}