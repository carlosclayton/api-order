<?php

namespace App\Repositories;

use App\Models\Order;
use App\Traits\Uuid;
use Illuminate\Support\Arr;
use Ramsey\Uuid\Uuid as RamseyUuid;


class OrderRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(new Order());
    }

    public function getAll()
    {
        return $this->model->all();
    }
}
