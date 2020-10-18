<?php

namespace App\Imports;

use App\Models\TempletSupplier;
use Maatwebsite\Excel\Concerns\ToModel;

class TempletSupplierImport implements ToModel
{
    public function model(array $row)
    {
        return new TempletSupplier([
            'name'       => $row[0],
            'mobile'       => $row[1],
            'address'       => $row[2],
            'email'       => $row[3],
            ]);
    }
}
