<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\ClassroomComment;
use App\ClassroomDivisionUser;
use App\ClassroomUser;
use App\ClassroomContent;

class ClassroomUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        DB::beginTransaction();

        if($request->ajax()){
            try{

                $con_id = ClassroomContent::where('cls_id',$request->cls_id)->get();

                foreach ($con_id as $value) {
                    ClassroomComment::where('user_id',$request->user_id)->where('con_id',$value->con_id)->delete();
                }

                ClassroomDivisionUser::where('user_id',$request->user_id)->delete();

                ClassroomUser::where('user_id',$request->user_id)->where('cls_id',$request->cls_id)->delete();

                ClassroomContent::where('user_id',$request->user_id)->where('cls_id',$request->cls_id)->delete();

                $request->success = 'success';

                DB::commit();
                return response()->json($request);
                //return response()->json(['success' => 'เปลี่ยนข้อมูลสำเร็จ '.now(), 'name' => $request->content], 200);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['error' => 'เกิดข้อผิดพลาด '.now()], 500);
            }
        }
    }
}
