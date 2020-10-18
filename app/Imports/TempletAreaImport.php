<?php

namespace App\Imports;

use App\Models\TempletArea;
use Maatwebsite\Excel\Concerns\ToModel;

class TempletAreaImport implements ToModel
{
    public function model(array $row)
    {
        return new TempletArea([
            'city'       => $row[0],
            'name'       => $row[1],
            'order'       => $row[2],
            ]);
    }
}
