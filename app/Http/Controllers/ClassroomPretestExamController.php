<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ClassroomPretest;
use App\ClassroomPretestExam;
use App\ClassroomPretestUser;
use Illuminate\Support\Facades\DB;

class ClassroomPretestExamController extends Controller
{
    public function show($id){
        // หา User ID
        $users = auth()->user()->id;


        // echo $id;
        //dd($id);
        $pretest = ClassroomPretest::where('pt_id',$id)
        ->with(['exam' => function ($q) {
            $q->inRandomOrder();
        }])->inRandomOrder()
        ->first();




        // foreach ($pretest->exam as $key => $value) {
        //     echo $value->exm_question ;
        // }

    //  dd($pretest);
        return view('backend.pretest', compact('pretest'));
    }

    public function update(Request $request,$id){
        $users = auth()->user()->id;

        $pretest = ClassroomPretestExam::where('pt_id',$id)->get();
        $point = 0;

        foreach ($request->customRadio as $key => $value) {

            $answer =  ClassroomPretestExam::where('exm_id',$key)->value('exm_answer');

            // Debug
            // echo $value. " = " ;
            // echo $key ."<br>";
            // echo $answer."<br>";

            //ตรวจคำตอบ
            if($value == $answer){
                $point += 1 ;
            }
        }

        $clsid = ClassroomPretest::find($id)->value('cls_id');

        DB::beginTransaction();

        try{
            ClassroomPretestUser::updateOrCreate(
            // ตรวจสอบว่ามีมั้ย
            [
                'cls_id' => $clsid,
                'id' => $users,
                'pt_id' => $id
            ],
            [
                'cpu_score' => $point
            ]);
            DB::commit();
            return redirect()->route('pretest.show', ['id' => $clsid])->with('status', 'Data inserted sucessfully!!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('pretest.show', ['id' => $clsid])->with('status', 'Data inserted Failed!!');
        }

    }
}
