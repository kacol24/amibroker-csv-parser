<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AmibrokerImport implements ToCollection, WithHeadingRow
{
    use Importable;

    public function collection(Collection $collection)
    {
        return $collection;
    }
}
