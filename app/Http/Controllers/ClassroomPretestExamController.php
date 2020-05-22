<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ClassroomPretest;

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
}
