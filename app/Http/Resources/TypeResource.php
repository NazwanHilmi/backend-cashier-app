<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TypeResource extends JsonResource {
	/**
	 * Transform the resource into an array.
	 */
	public function toArray(Request $request): array {
		return [
			'id' => $this->id,
			'nama_jenis' => $this->nama_jenis,
			'category' => [
				'id' => $this->category->id,
				'nama' => $this->category->nama,
			],
		];
	}
}
