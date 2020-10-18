<?php

namespace App\Imports;

use App\Models\TempletCity;
use Maatwebsite\Excel\Concerns\ToModel;

class TempletCityImport implements ToModel
{
    public function model(array $row)
    {
        return new TempletCity([
            'name'       => $row[0],
            'order'       => $row[1],
            ]);
    }
}
