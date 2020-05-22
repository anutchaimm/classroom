<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\CsvImport;
use Maatwebsite\Excel\Facedes\Excel;
use App\ClassroomPretestExam;

class CsvFile extends Controller
{
    public function csv_import(){
        Excel::import(new CsvImport, request()->file('file'));
        return back();
    }
}
