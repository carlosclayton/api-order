<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Throwable;

abstract class ServiceBase
{
    private $storeFunction;
    private $withTransaction = false;

    protected function persist(\Closure $storeFunction)
    {
        $this->storeFunction = $storeFunction;

        try {
            if (!$this->withTransaction) {
                $func = DB::transaction($this->storeFunction);
            } else {
                $func = $this->storeFunction;
            }
        } catch (Throwable $exception) {
            throw $exception;
        }

        return $func;
    }

    protected function withTransaction()
    {
        $this->withTransaction = true;
        return $this;
    }
}
