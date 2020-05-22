<?php

namespace App\Http\Controllers;

use App\ClassroomPretest;
use Illuminate\Http\Request;
use App\Imports\CsvImport;
use Maatwebsite\Excel\Facades\Excel;
use App\ClassroomPretestExam;
use App\ClassroomPretestUser;
use Carbon\Carbon;


class ClassroomPretestController extends Controller
{

    public function show($id){
        // หา User ID
        $users = auth()->user()->id;

        // ดึงข้อมูล Pretest มาแสดง
        $pretest = ClassroomPretest::where('cls_id',$id)->get();

        foreach ($pretest as $key => $pretests) {

            // เช็คว่าสอบได้กี่คะแนน
            $pretests->score = ClassroomPretestUser::where('pt_id',$pretests->pt_id)
            ->where('id',$users)->value('cpu_score');

            $createdate = Carbon::parse($pretests->created_at); // now date is a carbon instance
            $pretests->create_at = $createdate->isoFormat('LL');

            $pretests->checkalready = ClassroomPretestUser::where('id', $users)
            ->where('pt_id',$pretests->pt_id)
            ->count();
        }





        // $test = ClassroomPretestUser::where('pt_id',1)
        //     ->where('id',$users)->value('cpu_score');
        // $item->score
        // findOrFail($id)

        $sumscore = ClassroomPretest::where('cls_id',$id)->sum('pt_number_of_exam');


        $getscore = ClassroomPretestUser::where('cls_id',$id)
        ->where('id',$users)->sum('cpu_score');

        // $purchases = DB::table('transactions')

        // ->where('categories.kind', '=', 1)
        // ->sum('transactions.amount');


      //dd($getscore); / 100) * $sumscore

        //pretest id getscore sumscore
        return view('backend.all_pretest',compact('id', 'pretest','getscore','sumscore'));
    }

    public function csv_import(Request $request, $id){
        //dd(request()->file('file'));

        $pretest = ClassroomPretest::updateOrCreate(
            ['cls_id' => $id, 'pt_name' => $request->cls_name]
        );

        // protected $primaryKey = 'pt_id';

        // protected $fillable = [
        //     'cls_id',
        //     'pt_name',
        //     'pt_number_of_exam',
        // ];

      //  dd($request);

        Excel::import(new CsvImport($id,$pretest->pt_id), request()->file('file'));

        $pretestotal = ClassroomPretestExam::where('pt_id',$pretest->pt_id)->count();
        $pretest->pt_number_of_exam = $pretestotal;
        $pretest->save();

       // dd($pretestotal);
        return back();
    }
}
