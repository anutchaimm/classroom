<?php

namespace App\Exports;

use App\ClassroomPretestUser;
use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class CsvExport implements FromCollection
{
    private $id;
    private $name;

    public function __construct($id,$name)
    {
        $this->id = $id;
        $this->name = $name;

       // dd($this->columnName);
    }

    public function collection()
    {
        return ClassroomPretestUser::all();
    }
}

