<?php

namespace App\Http\Controllers;

use App\Exports\AmibrokerExport;
use App\Imports\AmibrokerImport;
use Illuminate\Http\Request;

class ImportController extends Controller
{
    public function __invoke(Request $request)
    {
        $collection = (new AmibrokerImport)->toCollection($request->file('excel'), null, \Maatwebsite\Excel\Excel::CSV);

        return (new AmibrokerExport($collection->first()))->download($request->file('excel')->getClientOriginalName() . '.csv');
    }
}
