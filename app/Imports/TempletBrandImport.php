<?php

namespace App\Imports;

use App\Models\TempletBrand;
use Maatwebsite\Excel\Concerns\ToModel;

class TempletBrandImport implements ToModel
{
    public function model(array $row)
    {
        return new TempletBrand([
            'name'       => $row[0],
            'code'      => $row[1],
            'order'       => $row[2],
            ]);
    }
}
