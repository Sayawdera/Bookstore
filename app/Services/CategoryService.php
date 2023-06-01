<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class CategoryService extends BaseService
{
    public function __construct(CategoryRepository $repository)
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