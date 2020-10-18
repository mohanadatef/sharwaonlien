<?php

namespace App\Imports;

use App\Models\TempletType;
use Maatwebsite\Excel\Concerns\ToModel;

class TempletTypeImport implements ToModel
{
    public function model(array $row)
    {
        return new TempletType([
            'name'       => $row[0],
            'order'       => $row[1],
            ]);
    }
}
