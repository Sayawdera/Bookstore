<?php

namespace App\Services;

use App\Repositories\CountryRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class CountryService extends BaseService
{
    public function __construct(CountryRepository $repository)
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
        if($all) return $this->repository->getAllList($data, ["users"]);
        return $this->repository->paginatedList($data, ["users"]);
    }

}