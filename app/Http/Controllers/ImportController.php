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

        $uploadedPath = $request->file('excel')->storeAs('imports', $filename.'.csv');
        
        $collection = (new AmibrokerImport)->toCollection($uploadedPath, null, Excel::CSV);

        return (new AmibrokerExport($collection->first()))
            ->download($filename.'.csv', Excel::CSV);
    }
}
