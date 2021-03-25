<?php

namespace App\Services;

use App\Repositories\OrderRepository;
use Ramsey\Uuid\Uuid as RamseyUuid;

class OrderService extends ServiceBase
{
    private $repository;

    public function __construct(OrderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function store($request)
    {
        $rules = function () use ($request) {
            $data = $request->only(
                'products',
                'customer_id',
            );

            $total = 0;
            $products = [];
            $qtdDiscount = false;
            $PriceDiscount = false;
            foreach ($data['products'] as $product) {
                if ($product['qtd'] >= 5) $qtdDiscount = true;
                $products[] = [
                    'product_id' => $product['id'],
                    'qtd' => $product['qtd'],
                ];
                $total += $product['price'];
                if ($total >= 500) $PriceDiscount = true;
            }
            $discount = ($qtdDiscount && $PriceDiscount) ? ($total * 15) / 100 : 0;

            $attr = [
                'code' => date('Y') . "-" . date('m') . "-" . RamseyUuid::uuid4()->__toString(),
                'total' => $total,
                'discount' => $total - $discount,
                'customer_id' => $data['customer_id'],
            ];

            $order = $this->repository->store($attr);
            $order->products()->sync($products);
            return $order;
        };
        return $this->persist($rules);
    }

    public function update($request, $id)
    {
        $rules = function () use ($request, $id) {
            $data = $request->only(
                'products',
                'customer_id',
            );

            $total = 0;
            $products = [];
            $qtdDiscount = false;
            $PriceDiscount = false;
            foreach ($data['products'] as $product) {
                if ($product['qtd'] >= 5) $qtdDiscount = true;
                $products[] = [
                    'product_id' => $product['id'],
                    'qtd' => $product['qtd'],
                ];
                $total += $product['price'];
                if ($total >= 500) $PriceDiscount = true;
            }
            $discount = ($qtdDiscount && $PriceDiscount) ? ($total * 15) / 100 : 0;

            $attr = [
                'code' => date('Y') . "-" . date('m') . "-" . RamseyUuid::uuid4()->__toString(),
                'total' => $total,
                'discount' => $total - $discount,
                'customer_id' => $data['customer_id'],
            ];

            $order = $this->repository->update($attr, $id);
            $order->products()->sync($products);
            return $order;

        };
        return $this->persist($rules);
    }

    public function destroy($id)
    {
        return $this->repository->delete($id);
    }

    public function show($id)
    {
        return $this->repository->show($id);
    }
}
