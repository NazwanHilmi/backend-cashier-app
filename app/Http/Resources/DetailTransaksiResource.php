<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DetailTransaksiResource extends JsonResource {
	/**
	 * Transform the resource into an array.
	 */
	public function toArray(Request $request): array {
		return [
			'id' => $this->id,
			'sub_total' => $this->sub_total,
			'unit_price' => $this->unit_price,
			'quantity' => $this->quantity,
			'menu' => [
				'id' => $this->menu->id,
				'nama' => $this->menu->nama_menu,
			],
			'transaksi' => [
				'id' => $this->transaksi->id,
				'total_harga' => $this->transaksi->total_harga,
			],
		];
	}
}
