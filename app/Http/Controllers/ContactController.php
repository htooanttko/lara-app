<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // contact add
    public function addContact(Request $request){

        $data = [
            'user_id' => $request->userId,
            'add_user_id' => $request->addUserId,
        ];
        if(Contact::where('add_user_id',$request->addUserId)->where('user_id', $request->userId)->first()){
            return redirect()->route('chat#chatPage',$request->addUserId);
        }
        $contactID = Contact::create($data);
        return redirect()->route('chat#chatPage',$request->addUserId);
    }
}
