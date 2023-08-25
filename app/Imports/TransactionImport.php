<?php

namespace App\Imports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\ToModel;

class TransactionImport implements ToModel
{
    public function model(array $col)
    {
        return new Transaction([
           'product_id'  => $col[0],
           'trx_date'    => $col[1],
           'price'       => $col[2],
        ]);
    }
}



