<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product';

    protected $fillable = [
        'name',
        'supplier_name',
        'purchase_price',
        'selling_price',
        'stock'
    ];

    public function DetailTransaksi() {
        return $this->hasMany(DetailTransaksi::class);
    }
}
