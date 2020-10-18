<?php

namespace App\Imports;

use App\Models\TempletCompanyDelivery;
use Maatwebsite\Excel\Concerns\ToModel;

class TempletCompanyDeliveryImport implements ToModel
{
    public function model(array $row)
    {
        return new TempletCompanyDelivery([
            'name' => $row[0],
            'mobile'       => $row[1],
            'address'       => $row[2],
            'email'       => $row[3],
            'description'       => $row[4],
            'performance' => $row[5],
            ]);
    }
}
