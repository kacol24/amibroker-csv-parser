<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AmibrokerExport implements FromCollection, WithHeadings, WithCustomCsvSettings, WithMapping
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
            '<ticker>',
            '<date>',
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
            $ticker = explode('.', $value['ticker']);

            if (! isset($ticker[1]) || $ticker[1] != 'JK') {
                $value['ticker'] .= '.JK';
            }

            return $value;
        }, $rows);
    }

    public function getCsvSettings(): array
    {
        return [
            'enclosure' => '',
        ];
    }

    public function map($row): array
    {
        return [
            $row['ticker'],
            $row['date'],
            $row['open'],
            $row['high'],
            $row['low'],
            $row['close'],
            $row['volume'],
        ];
    }
}
