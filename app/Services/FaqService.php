<?php

namespace App\Services;

use App\Repositories\FaqRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;


class FaqService extends BaseService
{
    public function __construct(FaqRepository $repository)
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