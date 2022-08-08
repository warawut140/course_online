<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Pusher\Pusher;

class ChatController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function index()
    {
        $user_id = Auth::id();

        $profile = Profile::where('user_id','=',$user_id)->first();

//        $users = DB::table('users')
//            ->join('profiles','users.id','=','profiles.user_id')
//            ->leftJoin('messages', function($q) use ($user_id)
//            {
//                $q->on('users.id', '=', 'messages.from')
//                    ->where('messages.is_read', '=', 0)
//                    ->where('messages.to', '=', $user_id);
//            })
//            ->select('users.*','profiles.image_profile' ,'profiles.firstname','profiles.lastname' ,DB::raw('count(is_read) as unread'))
//            ->where('id ','!=',$user_id)
//            ->get();

        $check = DB::table('chat_user')->where('user_to','=',Auth::id())->get();

        if (count($check) > 0){
            $users = DB::select("select `users`.*, `profiles`.`image_profile`, `profiles`.`firstname`, `profiles`.`lastname`, count(is_read)  as `unread` 
from `users` 
inner join `profiles` on `users`.`id` = `profiles`.`user_id` 
RIGHT JOIN `chat_user` on `users`.`id` = `chat_user`.`user_from` 
left join `messages` on `users`.`id` = `messages`.`from` 
and `messages`.`is_read` = 0 
and `messages`.`to` = " . Auth::id() . "
WHERE users.id !=  " . Auth::id() . " and chat_user.user_to =  " . Auth::id() . " group by users.id, users.name, users.email");
        }else{
            $users = [];
        }

        return view('frontend.chat' , ['users' => $users , 'profile' => $profile]);
    }

    public function chat($id)
    {
        $check = DB::table('chat_user')
            ->where('user_from','=',$id)
            ->where('user_to','=',Auth::id())
            ->first();
        if($check == null){
            DB::table('chat_user')->insert([
                'user_from' => $id ,
                'user_to' => Auth::id() ,
            ]);
            DB::table('chat_user')->insert([
                'user_from' => Auth::id() ,
                'user_to' =>  $id,
            ]);
            return redirect('chat');
        }else{
            return redirect('chat');
        }
    }

    public function getMessage($user_id)
    {
        $my_id = Auth::id();

        // Make read all unread message
        DB::table('messages')->where(['from' => $user_id, 'to' => $my_id])->update(['is_read' => 1]);

        // Get all message from selected user
        $messages = DB::table('messages')->where(function ($query) use ($user_id, $my_id) {
            $query->where('from', $user_id)->where('to', $my_id);
        })->oRwhere(function ($query) use ($user_id, $my_id) {
            $query->where('from', $my_id)->where('to', $user_id);
        })->get();


        foreach ($messages as $key => $message){
            $data1 = Profile::where('user_id','=',$user_id)->first();
            $data2 = Profile::where('user_id','=',$my_id)->first();
            $messages[$key]->image_from = $data1->image_profile ;
            $messages[$key]->image_to = $data2->image_profile ;
        }

        return view('frontend.messages.index', ['messages' => $messages]);
    }

    public function sendMessage(Request $request)
    {
        $from = Auth::id();
        $to = $request->receiver_id;
        $message = $request->message;


        $check = DB::table('chat_user')
        ->where('user_from','=',$from)
        ->where('user_to','=',$to)
        ->get();

        if(count($check) == 0){
            $now = new DateTime();
            DB::table('chat_user')->insert([
                'user_from' => $from ,
                'user_to' => $to ,
                'date'=> $now ,
            ]);
        }

        DB::table('messages')->insert([
            'from' => $from ,
            'to' => $to ,
            'message' => $message , // message will be unread when sending message
            'is_read' => 0 ,
        ]);

        // pusher
        $options = array(
            'cluster' => 'ap2',
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



}
