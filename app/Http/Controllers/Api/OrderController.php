<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Services\OrderService;

class OrderController extends Controller
{

    private $service;

    public function __construct(OrderService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        try {
            $data = OrderResource::collection($this->service->getAll());
        } catch (\Exception $exception) {
            return $this->responseError($exception->getMessage());
        }
        return $this->responseSuccess($data);
    }

    public function store(OrderRequest $request)
    {

        try {
            $data = new OrderResource($this->service->store($request));
        } catch (\Exception $exception) {
            return $this->responseError($exception->getMessage());
        }
        return $this->responseSuccess($data);
    }

    public function update(OrderRequest $request, $id)
    {
        try {
            $data = new OrderResource(
                $this->service->update($request, $id)
            );
        } catch (\Exception $exception) {
            return $this->responseError($exception->getMessage());
        }
        return $this->responseSuccess($data);
    }

    public function show($uuid)
    {
        try {
            $data = new OrderResource(
                $this->service->show($uuid)
            );
        } catch (\Exception $exception) {
            return $this->responseError($exception->getMessage());
        }
        return $this->responseSuccess($data);
    }

    public function destroy($uuid)
    {
        try {
            $this->service->destroy($uuid);
        } catch (\Exception $exception) {
            return $this->responseError($exception->getMessage());
        }
        return $this->responseSuccess();
    }
}
