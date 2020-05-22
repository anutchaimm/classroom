<?php

namespace App\Http\Controllers;

use App\Chat;
use Illuminate\Http\Request;
use App\ClassroomParing;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Pusher\Pusher;
use App\Profile;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $we = DB::select("select users.id, users.name, users.email, count(is_read) as unread
        from users LEFT  JOIN  chats ON users.id = chats.from and is_read = 0 and chats.to = " . Auth::id() . "
        where users.id != " . Auth::id() . "
        group by users.id, users.name, users.email");

        $users = ClassroomParing::select('usr_paring', 'par_status as par_status')
        ->where('user_id', Auth::id())
        ->where('par_status', 'Like')
        ->get();

        foreach ($users as $key => $user) {

            $count = ClassroomParing::where('user_id', $user->usr_paring)
                ->where('usr_paring', Auth::id())
                ->where('par_status', 'Like')
                ->count();

                if($count > 0 ){
                    $user->profile->match = "pair";
                }else{
                    $user->profile->match = "unpair";
                }

            $user->profile->unread = Chat::where('to', Auth::id())
            ->where('is_read', 0)
            ->where('from', $user->usr_paring)
            ->count();

        }

       // dd($user);
       return view('messages.pair', ['users' => $users]);
    }

    public function getMessage($user_id)
    {
        $my_id = Auth::id();

        // Make read all unread message
        Chat::where(['from' => $user_id, 'to' => $my_id])->update(['is_read' => 1]);

        // Get all message from selected user
        $messages = Chat::where(function ($query) use ($user_id, $my_id) {
            $query->where('from', $user_id)->where('to', $my_id);
        })->oRwhere(function ($query) use ($user_id, $my_id) {
            $query->where('from', $my_id)->where('to', $user_id);
        })->get();

        $friend = Profile::where('user_id',$user_id)->first();
       // dd($friend);
        return view('messages.index', compact('messages','friend'));
    }


    public function sendMessage(Request $request)
    {
        $from = Auth::id();
        $to = $request->receiver_id;
        $message = $request->message;

        $data = new Chat();
        $data->from = $from;
        $data->to = $to;
        $data->message = $message;
        $data->is_read = 0; // message will be unread when sending message
        $data->save();

         // pusher
        $options = array(
            'cluster' => 'ap1',
            'useTLS' => true
        );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $data = ['from' => $from, 'to' => $to]; // sending from and to user id when pressed enter
        $pusher->trigger('my-channel', 'my-event', $data);
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
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function show(Chat $chat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function edit(Chat $chat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chat $chat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chat $chat)
    {
        //
    }
}
