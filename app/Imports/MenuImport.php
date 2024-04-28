<?php

namespace App\Imports;

use App\Models\Type;
use App\Models\Menu;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MenuImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) 
        {
            $type = Type::where('nama_jenis', $row['jenis'])->first();

            if($type){
                Menu::create([
                    'nama_menu' => $row['nama_menu'],
                    'harga' => $row['harga'],
                    'deskripsi' => $row['deskripsi'],
                    'type_id' => $type->id
                ]);
            }
        }
    }
}
