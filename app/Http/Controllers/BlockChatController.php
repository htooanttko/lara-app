<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Group;
use App\Models\Contact;
use App\Models\BlockChat;
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
        return back();
    }

    // unblock
    public function unblock($id){
        BlockChat::where('blocked_id',$id)->delete();

        return redirect()->route('chat#chatPage',$id);
    }
}
