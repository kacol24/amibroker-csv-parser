<?php

namespace App\Http\Controllers;

use App\Exports\AmibrokerExport;
use App\Imports\AmibrokerImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;

class ImportController extends Controller
{
    public function __invoke(Request $request)
    {
        $filename = $request->file('excel')->getClientOriginalName();
        $filename = pathinfo($filename, PATHINFO_FILENAME);

        $collection = (new AmibrokerImport)->toCollection($request->file('excel'));

        return (new AmibrokerExport($collection->first()))
            ->download($filename . '.csv', Excel::CSV);
    }
}
