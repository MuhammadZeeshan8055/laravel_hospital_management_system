<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Messages;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class ChatController extends Controller
{
    public function index(){

       $chats=User::where('usertype', 0)->get();
       return view('admin.chats',compact('chats'));
       
        // if(Auth::id()){
        //     $id=Auth::id();

        //     $chat = Messages::where('to_id', $id)->get();

        //     if(!empty($chat)){
        //         $chats = Messages::join('users', 'messages.from_id', '=', 'users.id')
        //         ->select('messages.from_id', 'users.name','users.usertype')
        //         ->where('usertype','!=', 1)
        //         ->distinct()
        //         ->get();
        //         return view('admin.chats',compact('chats'));

        //     }else{

        //         $chats="No Chat Found";
        //         return view('admin.chats',compact('chats'));

        //     }

            

        // }
        // else{
        //     return view('login');
        // }
    }
    public function show_chat($id){
        
        // $chat = Messages::where('from_id', $id)->get();

       
        $auth_id=Auth::id();

        $user_name=User::find($id);

        $chat = Messages::where('from_id', $id)
        ->where('to_id', $auth_id) // Additional condition
        ->orWhere('from_id', $auth_id)
        ->where('to_id', $id)
        ->get();

      
        
        return view('admin.show_chat', ['chat' => $chat],['user_name' => $user_name]);

    }
    public function send_message(Request $request){

        $cDate	= date('Y-m-d');
        $cTime	= date("h:i A");

        $new_message=new Messages();
        $new_message->from_id=$request->from_id;
        $new_message->to_id=$request->to_id;
        $new_message->message=$request->message;
        $new_message->time=$cTime;
        $new_message->date=$cTime;
        $new_message->save();

        return redirect()->back()->with('message','Message Sent Successfully'); ;

    }

    public function patient_chat(){
        
        $auth_id=Auth::id();

        
        $chat = Messages::where('from_id', $auth_id)
        ->where('to_id', 2) // Additional condition
        ->orWhere('from_id', 2)
        ->where('to_id', $auth_id)
        ->get();

        return view('admin.patient_chat', ['chat' => $chat]);
    }
}
