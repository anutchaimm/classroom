<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\ClassroomComment;
class CommentController extends Controller
{
    public function store(Request $request)
    {
        DB::beginTransaction();
        if($request->ajax()){
            try{
                ClassroomComment::create([
                    'con_id' => $request->con_id,
                    'user_id'=> $request->user_id,
                    'cmt_message'=> $request->comment
                ]);
                DB::commit();


                // TODO ไว้รับค่า id comment ส่งกลับ


                return response()->json($request);
                //return response()->json(['success' => 'เปลี่ยนข้อมูลสำเร็จ '.now(), 'name' => $request->content], 200);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['error' => 'เกิดข้อผิดพลาด '.now()], 500);
            }
        }
    }

    public function destroy($id)
    {
        ClassroomComment::where('cmt_id',$id)->delete();
        return redirect()->back()->with('message', 'Data deleted successfully');
    }

}


