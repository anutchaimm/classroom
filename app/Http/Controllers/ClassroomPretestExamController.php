<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ClassroomPretest;
use App\ClassroomPretestExam;

class ClassroomPretestExamController extends Controller
{
    public function show($id){
        // หา User ID
        $users = auth()->user()->id;

        $pretest = ClassroomPretest::find($id)->with('exam')->first();

        // foreach ($pretest->exam as $key => $value) {
        //     echo $value->exm_question ;
        // }

      // dd($pretest);
        return view('backend.pretest', compact('pretest'));
    }

    public function update(Request $request,$id){
        $users = auth()->user()->id;

        $pretest = ClassroomPretestExam::where('pt_id',$id)->get();


        foreach ($request->customRadio as $key => $value) {
            echo $value. "=";

            echo $pretest[$key-1]->exm_answer. "<br>";

          //  if($value == )

        }

        dd($request);
    }
}
