<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MejaResource extends JsonResource {
	/**
	 * Transform the resource into an array.
	 */
	public function toArray(Request $request): array {
		return [
			'id' => $this->id,
			'nomor_meja' => $this->nomor_meja,
			'kapasitas' => $this->kapasitas,
			'status' => $this->status,
		];
	}
}
