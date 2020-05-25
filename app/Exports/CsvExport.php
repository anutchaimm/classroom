<?php

namespace App\Exports;

use App\ClassroomPretestUser;
use App\ClassroomUser;
use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class CsvExport implements FromCollection, WithHeadings
{
    use Exportable;
    private $id;
    private $name;
    private $people;


    public function __construct($id,$name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function collection()
    {

        //echo $this->id;
        $export = DB::table('classroom_pretest_users')
                ->join('classrooms', 'classrooms.cls_id', '=', 'classroom_pretest_users.cls_id')
                ->join('classroom_pretests', 'classroom_pretests.pt_id', '=', 'classroom_pretest_users.pt_id')
                ->join('profiles', 'profiles.user_id', '=', 'classroom_pretest_users.id')
                ->where('classroom_pretest_users.pt_id', '=', $this->id)
                ->select('classrooms.cls_name'
                ,'classroom_pretests.pt_name'
                ,'profiles.prf_firstname'
                ,'profiles.prf_lastname'
                ,'classroom_pretest_users.cpu_score'
                ,'classroom_pretest_users.created_at')
                ->get();

        // dd($export);
        return $export;
    }

    public function headings(): array
    {
        return [
            'Classroom',
            'Pretest Name',
            'Firstname',
            'Lastname',
            'Score',
            'Time',
        ];
    }

}

