<?php

namespace App\Http\Controllers;

use App\Imports\AmibrokerImport;
use Illuminate\Http\Request;

class ImportController extends Controller
{
    public function __invoke(Request $request)
    {
        (new AmibrokerImport)->import($request->file('excel'), null, \Maatwebsite\Excel\Excel::CSV);
    }
}
