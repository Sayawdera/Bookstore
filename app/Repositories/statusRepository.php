<?php

namespace App\Repositories;

use App\Models\status;

class statusRepository extends BaseRepository
{
    public function __construct(status $model)
    {
        parent::__construct($model);
    }
}