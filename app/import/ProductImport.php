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
                'name' => $row[0],
                'supplier_name' => $row[1],
                'purchase_price' => $row[2],
                'selling_price' => $row[3],
                'stock' => $row[4],
            ]);
        }
    }
}
