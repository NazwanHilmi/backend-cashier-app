<?php

namespace App\Imports;

use App\Models\Type;
use App\Models\Category;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TypeImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) 
        {
            $kategori = Category::where('nama', $row['kategori'])->first();

            if($kategori){
                Type::create([
                    'nama_jenis' => $row['nama_jenis'],
                    'kategori_id' => $kategori->id
                ]);
            }
        }
    }
}
