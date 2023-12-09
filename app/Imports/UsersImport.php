<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements WithHeadingRow
{
    public function __construct(
    )
    {
    }

    public function headingRow(): int
    {
        return 1;
    }
}
