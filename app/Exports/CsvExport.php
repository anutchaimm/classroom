<?php

namespace App\Exports;

use App\ClassroomPretestUser;
use Maatwebsite\Excel\Concerns\FromCollection;

class CsvExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ClassroomPretestUser::all();
    }
}

