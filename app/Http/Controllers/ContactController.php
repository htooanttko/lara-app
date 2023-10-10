<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    // search contact
    public function searchContact(Request $request){
        $contact = User::where('email',$request->addEmail)->where('phone',$request->addPhone)->first();
        if($contact->id == Auth::user()->id) return;
        return response()->json(['contact' => $contact]);
    }

    // contact add
    public function addContact(Request $request){

        $data = [
            'user_id' => Auth::user()->id,
            'add_user_id' => $request->addUserId,
        ];
        if(Contact::where('add_user_id',$request->addUserId)->where('user_id', Auth::user()->id)->first()){
            return back()->with(['error' => 'already exit']);
        }
        Contact::create($data);
        return back();
    }

    // delete contact
    public function deleteContact($id){
        Contact::where('user_id',Auth::user()->id)->where('add_user_id',$id)->delete();
        return back();
    }

    // add contact contact by id
    public function addContactByid($id){
        $data = [
            'user_id' => Auth::user()->id,
            'add_user_id' => $id,
        ];
        if(Contact::where('add_user_id',$id)->where('user_id', Auth::user()->id)->first()){
            return back()->with(['errorchat' => 'already exit']);
        }
        Contact::create($data);
        return back();
    }
}
