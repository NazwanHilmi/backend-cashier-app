<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';
    protected $fillable = [
        'tanggal',
        'total_harga',
        'payment_method_id',
        'note',
    ];

    public function detailTransaksi() {
        return $this->hasMany(DetailTransaksi::class);
    }

    public function paymentMethod() {
		return $this->belongsTo(paymentMethod::class, 'payment_method_id');
	}
}
