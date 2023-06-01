<?php

namespace App\Services;

use App\Repositories\FounderRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;


class FounderService extends BaseService
{
    public function __construct(FounderRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $data
     * @param bool $all
     * @return LengthAwarePaginator|Collection
     * @throws \Throwable
     */
    public function paginatedList($data = [],$all=false): LengthAwarePaginator|Collection
    {
        if($all) return $this->repository->getAllList($data, ["products"]);
        return $this->repository->paginatedList($data, ["products"]);
    }



}