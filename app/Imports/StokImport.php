<?php

namespace App\Imports;

use App\Models\Stok;
use App\Models\Menu;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StokImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) 
        {
            $menu = Menu::where('nama_menu', $row['menu'])->first();

            if($menu){
                Stok::create([
                    'jumlah' => $row['jumlah'],
                    'menu_id' => $menu->id
                ]);
            }
        }
    }
}
