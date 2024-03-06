<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
    use HasFactory;

    protected $table = 'stok';
    protected $fillable = ['jumlah', 'menu_id'];

    public function menu() {
		return $this->belongsTo(Menu::class, 'menu_id');
	}
}
