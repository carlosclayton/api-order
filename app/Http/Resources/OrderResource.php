<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'OrderId' => $this->id,
            'OrderCode' => $this->code,
            'OrderDate' => Carbon::parse($this->created_at)->format('d/m/Y H:i:s'),
            'TotalAmountWihtoutDiscount' => $this->total,
            'TotalAmountWithDiscount' => $this->discount,
        ];
    }
}
