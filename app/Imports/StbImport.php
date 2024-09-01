<?php

namespace App\Imports;

use App\Models\STb;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StbImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Check if the user already exists based on email
        $stb = STb::firstOrNew(['nuid' => $row['nuid']]);

        if (!$stb->exists) {
            $stb->nuid = $row['nuid'];
            $stb->bcl_id = $row['bcl_id'];
            $stb->category = $row['category'];
            $stb->status = $row['status'];
        }

        $stb->save();
    }
}
