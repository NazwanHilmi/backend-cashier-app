<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{

    use HasFactory;

    protected $table = 'type';
    protected $fillable = ['nama_jenis', 'kategori_id'];


	public function category() {
		return $this->belongsTo(Category::class, 'kategori_id');
	}
}
