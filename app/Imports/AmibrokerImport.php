<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AmibrokerImport implements ToCollection, WithHeadingRow
{
    use Importable;

    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        $export = collect();
        foreach ($collection as $row) {
            $ticker = $row['ticker'];

            if (substr($ticker, strlen($ticker), strlen($ticker) - 3) != '.JK') {
                $row['ticker'] .= '.JK';
            }

            $export->push($row);
        }

        dd($export);
    }
}
