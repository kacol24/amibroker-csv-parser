<?php

namespace App\Exports;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AmibrokerExport implements FromCollection, WithHeadings, WithCustomCsvSettings
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

            $value['date'] = Carbon::parse($value['date'])->format('Y/m/d');

            return $value;
        }, $rows);
    }

    public function getCsvSettings(): array
    {
        return [
            'enclosure' => '',
        ];
    }
}
