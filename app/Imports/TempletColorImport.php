<?php

namespace App\Imports;

use App\Models\TempletColor;
use Maatwebsite\Excel\Concerns\ToModel;

class TempletColorImport implements ToModel
{
    public function model(array $row)
    {
        return new TempletColor([
            'name'       => $row[0],
            'order'       => $row[1],
            ]);
    }
}
