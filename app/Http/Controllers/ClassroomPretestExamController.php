<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClassroomPretestExamController extends Controller
{
    public function show($id){

        return view('backend.pretest');
    }
}
