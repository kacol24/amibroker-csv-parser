<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AmibrokerExport implements FromCollection, WithHeadings
{
    use Exportable;

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return new Collection($this->data);
    }

    public function headings(): array
    {
        return [
            '<date>',
            '<ticker>',
            '<open>',
            '<high>',
            '<low>',
            '<close>',
            '<volume>',
        ];
    }

    public function prepareRows($rows)
    {
        return array_map(function ($value) {
            $ticker = $value['ticker'];

            if (substr($ticker, strlen($ticker), strlen($ticker) - 3) != '.JK') {
                $value['ticker'] .= '.JK';
            }

            return $value;
        }, $rows);
    }
}
