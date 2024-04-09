<?php

namespace App\Imports;

use App\Models\Customer;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CustomerImport implements ToCollection, WithHeadingRow
{

    public function collection(Collection $collection)
    {
        foreach ($collection as $row)
        {
            Customer::create([
                'name' => $row['nama'],
                'email' => $row['email'],
                'phone' => $row['phone'],
                'address' => $row['address'],
            ]);
        }
    }
}
