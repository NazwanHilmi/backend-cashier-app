<?php

namespace App\Imports;

use App\Models\EntrustedProduct;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row)
        {
            Product::create([
                'name' => $row['nama_produk'],
                'supplier_name' => $row['nama_supplier'],
                'purchase_price' => $row['harga_beli'],
                'sell_price' => $row['harga_jual'],
                'stock' => $row['stok'],
            ]);
        }
    }
}
