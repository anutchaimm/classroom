<?php

namespace App\Imports;
use App\ClassroomPretestExam;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CsvImport implements ToModel, WithHeadingRow

{
    private $cls_id;
    private $pt_id;

    public function __construct($cls_id,$pt_id)
    {
        $this->cls_id = $cls_id;
        $this->pt_id = $pt_id;

       // dd($this->columnName);
    }


    public function model(array $row)
    {

       // dd($row["exm_question"]);
        return new ClassroomPretestExam([
            'pt_id'      =>  $this->pt_id,
            'cls_id'     =>  $this->cls_id,
            'exm_question'  =>  $row["exm_question"],
            'exm_choice_1'      =>  $row["exm_choice_1"],
            'exm_choice_2'     =>  $row["exm_choice_2"],
            'exm_choice_3'  =>  $row["exm_choice_3"],
            'exm_choice_4'      =>  $row["exm_choice_4"],
            'exm_answer'     =>  $row["exm_answer"],

        ]);
    }
}
