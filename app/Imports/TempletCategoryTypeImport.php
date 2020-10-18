<?php

namespace App\Imports;

use App\Models\TempletCategoryType;
use Maatwebsite\Excel\Concerns\ToModel;

class TempletCategoryTypeImport implements ToModel
{
    public function model(array $row)
    {
        return new TempletCategoryType([
            'name'       => $row[0],
            'order'       => $row[1],
            ]);
    }
}
