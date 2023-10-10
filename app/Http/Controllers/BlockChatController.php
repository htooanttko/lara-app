<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Group;
use App\Models\Contact;
use App\Models\ChatList;
use App\Models\BlockChat;
use App\Models\ChatLists;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlockChatController extends Controller
{
    // block peolpe
    public function block($id){
        $data = [
            "user_id" => Auth::user()->id,
            "blocked_id" => $id
        ];

        BlockChat::create($data);
        ChatLists::where('fir_user_id',Auth::user()->id)->where('sec_user_id',$id)->delete();
        ChatLists::where('sec_user_id',Auth::user()->id)->where('fir_user_id',$id)->delete();

        if(Contact::where('user_id',Auth::user()->id)->where('add_user_id',$id)->first()){
            Contact::where('user_id',Auth::user()->id)->where('add_user_id',$id)->delete();
        }
        if(Contact::where('add_user_id',Auth::user()->id)->where('user_id',$id)->first()){
            Contact::where('add_user_id',Auth::user()->id)->where('user_id',$id)->delete();
        }
        return redirect()->route('dashboard');
    }

    // unblock
    public function unblock($id){
        BlockChat::where('user_id',Auth::user()->id)->where('blocked_id',$id)->delete();
        ChatLists::create([
            'fir_user_id' => Auth::user()->id,
            'sec_user_id' => $id
        ]);
        ChatLists::create([
            'fir_user_id' => $id,
            'sec_user_id' => Auth::user()->id
        ]);

        return redirect()->route('chat#chatPage',$id);
    }

    // ajax block member
    public function blockMemberAjax(){
        $block = BlockChat::where('user_id',Auth::user()->id)->get();
        return response()->json(['block'=>$block]);
    }
}
