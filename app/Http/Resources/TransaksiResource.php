<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\DetailTransaksiResource;

class TransaksiResource extends JsonResource {
	/**
	 * Transform the resource into an array.
	 */
	public function toArray(Request $request): array {
		return [
			'id' => $this->id,
			'tanggal' => $this->tanggal,
			'total_harga' => $this->total_harga,
			'note' => $this->note,
			'payment' => [
				'id' => $this->paymentMethod->id,
				'name' => $this->paymentMethod->name,
			],
            'detail' => DetailTransaksiResource::collection($this->detailTransaksi),
			// 'user' => [
			// 	'id' => $this->user->id,
			// 	'name' => $this->user->name,
			// ],
		];

	}

}
