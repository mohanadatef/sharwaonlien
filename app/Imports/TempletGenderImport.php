<?php

namespace App\Imports;

use App\Models\TempletGender;
use Maatwebsite\Excel\Concerns\ToModel;

class TempletGenderImport implements ToModel
{
    public function model(array $row)
    {
     /*   return new TempletGender([
            'name'       => $row[0],
            'order'       => $row[1],
            ]);*/
    }
}
