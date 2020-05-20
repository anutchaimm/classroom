<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Profile;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{

    public function index(User $id)
    {
        // TODO เป็นการ where ด้วย Relation

        $data = $id->profile;

        //dd($data);

        // TODO เป็นการ where จาก Database
        //$data = DB::table('profiles')->where('user_id', $id->id)->first();

        //  return view('backend.profile');
        return view('backend.profile', compact('data'));
    }

    public function update(Request $request,User $id)
    {

        $message = [
            'prf_lastname.required' => "กรุณากรอกข้อมูล",
        ];

        $validate = Validator::make($request->all(), [
            'prf_imgcover' => 'image',
            'prf_img' => 'image',
            'title' => 'string|max:10',
            'firstname' => 'required|string|max:50',
            'lastname' => 'required|string|max:50',
            'birthday' => 'Date',
            'country' => 'string|max:50',
            'job' => 'string|max:50',
            'graduated' => 'string|max:50',
            'workplace' => 'string|max:100',
            'telephone' => 'string|max:20',
            'contact' => 'string|max:100'
        ], $message);

        if($validate->fails()){
            return redirect()->route('profile.show', ['id' => $id->id])->withErrors($validate)->withInput();
        }

        DB::beginTransaction();
        try {
            if($request->imgprofile){
                $imgprofilePath =  $request->file('imgprofile')->store('profiles', 'public');
                $imgprofile = Image::make(public_path("storage/{$imgprofilePath}"))->fit(256,256);
                $imgprofile->save();

                $flight = Profile::where('user_id', $id->id)
                    ->update([
                        'prf_img' => $imgprofilePath,
                    ]
                );
                DB::commit();
            }
            if($request->imgcover){
                $imgcoverPath =  $request->file('imgcover')->store('profiles_cover', 'public');
                $imgcover = Image::make(public_path("storage/{$imgcoverPath}"))->fit(1200,768);
                $imgcover->save();
                $flight = Profile::where('user_id', $id->id)
                ->update([
                    'prf_imgcover' => $imgcoverPath,
                    ]
                );
                DB::commit();
            }

            $flight = Profile::where('user_id', $id->id)
                ->update([
                    'prf_title' => $request->title,
                    'prf_firstname' => $request->firstname,
                    'prf_lastname' => $request->lastname,
                    'prf_birthday'=> $request->birthday,
                    'cty_code' => $request->country,
                    'crr_id' => $request->job,
                    'grd_id' => $request->graduated,
                    'prf_workaddress' => $request->workplace,
                    'prf_tel' => $request->telephone,
                    'prf_status' => 1,
                    'prf_contact' => $request->contact
                ]
            );
            DB::commit();
            return redirect('control')->with('status', 'เพิ่มข้อมูลสำเร็จ');
        } catch (\Exception $e) {
            return 'Fails';
            DB::rollback();
            //return redirect('/profile/'.auth()->user()->id)->with('status', 'เพิ่มข้อมูลไม่สำเร็จ');
        }
    }

}
