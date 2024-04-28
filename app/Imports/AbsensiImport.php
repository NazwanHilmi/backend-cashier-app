<?php

namespace App\Imports;

use App\Models\Absensi;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AbsensiImport implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) 
        {
            Absensi::create([
                'nama' => $row['nama'],
                'tanggal_masuk' => $row['tanggal_masuk'],
                'waktu_masuk' => $row['waktu_masuk'],
                'status' => $row['status'],
                'waktu_keluar' => $row['waktu_keluar'],
            ]);
        }
    }
}
