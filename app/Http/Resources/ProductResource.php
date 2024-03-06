<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{

    public function toArray(Request $request): array {
		return [
			'id' => $this->id,
			'name' => $this->name,
			'supplier_name' => $this->supplier_name,
            'purchase_price'=> $this->purchase_price,
            'selling_price'=> $this->selling_price,
            'stock'=> $this->stock,
		];
	}
}
