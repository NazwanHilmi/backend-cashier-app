<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MenuResource extends JsonResource {
	/**
	 * Transform the resource into an array.
	 */
	public function toArray(Request $request): array {
		return [
			'id' => $this->id,
			'nama_menu' => $this->nama_menu,
			'harga' => $this->harga,
            'image' => str_replace('public/', '', url("storage/{$this->image}")),
			'deskripsi' => $this->deskripsi,
			'type' => [
				'id' => $this->type?->id ?? '-',
				'nama' => $this->type?->nama_jenis ?? '-',
			],
			'stok' => [
				'id' => $this->stok?->id ?? '-',
				'jumlah' => $this->stok?->jumlah ?? '-',
			],
            'category' => [
				'id' => $this->stok?->id ?? '-',
				'nama' => $this->stok?->nama ?? '-',
			],
		];
	}
}
