<?php

namespace App\Imports;

use App\Models\TempletBag;
use Maatwebsite\Excel\Concerns\ToModel;

class TempletBagImport implements ToModel
{
    public function model(array $row)
    {
        return new TempletBag([
            'name'       => $row[0],
            'supplier'      => $row[1],
            'weight'       => $row[2],
            'cost_profit'      => $row[3],
            'cost_buy'     => $row[4],
            'user_buy'       => $row[5],
        ]);
    }
}
