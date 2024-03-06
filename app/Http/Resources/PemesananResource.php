<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PemesananResource extends JsonResource {
	/**
	 * Transform the resource into an array.
	 */
	public function toArray(Request $request): array {
		return [
			'id' => $this->id,
			'tanggal_pemesanan' => $this->tanggal_pemesanan->toDateString(),
			'jam_mulai' => $this->jam_mulai,
			'jam_selesai' => $this->jam_selesai,
			'nama_pemesan' => $this->nama_pemesan,
			'jumlah_pelanggan' => $this->jumlah_pelanggan,
			'meja' => [
				'id' => $this->meja->id,
				'nomor_meja' => $this->meja->nomor_meja,
			],
		];
	}
}
