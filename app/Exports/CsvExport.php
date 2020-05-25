<?php

namespace App\Exports;

use App\ClassroomPretestUser;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class CsvExport implements FromQuery, WithHeadings
{
    use Exportable;
    private $id;
    private $name;


    public function __construct($id,$name)
    {
        $this->id = $id;
        $this->name = $name;
    }



    public function query()
    {
        // return ClassroomPretestUser::query()->where('id', $this->id);
        // return ClassroomPretestUser::all();


        return $users = DB::table('classroom_pretest_users')
        ->join('profiles', 'profiles.user_id', '=', 'classroom_pretest_users.id')
        // ->join('classrooms', 'classrooms.cls_id', '=', 'classroom_pretest_users.cls_id')
        // ->join('classroom_pretests', 'classroom_pretests.pt_id', '=', 'classroom_pretest_users.pt_id')
        // ->select('classrooms.cls_name', 'classroom_pretests.pt_name', 'profiles.prf_firstname', 'profiles.prf_lastname', 'classroom_pretest_users.cpu_score', 'classroom_pretest_users.updated_at')
        ->get();
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

