<?php

namespace App\Imports;

use App\Models\TempletUserDelivery;
use Maatwebsite\Excel\Concerns\ToModel;

class TempletUserDeliveryImport implements ToModel
{
    public function model(array $row)
    {
        return new TempletUserDelivery([
            'name'       => $row[0],
            'mobile'       => $row[1],
            'position'       => $row[2],
            'email'       => $row[3],
            'company_delivery'   => $row[4],
            ]);
    }
}
