<?php

namespace App\Imports;

use App\Models\TempletSize;
use Maatwebsite\Excel\Concerns\ToModel;

class TempletSizeImport implements ToModel
{
    public function model(array $row)
    {
        return new TempletSize([
            'name'       => $row[0],
            'code'       => $row[1],
            'order'       => $row[2],
            ]);
    }
}
