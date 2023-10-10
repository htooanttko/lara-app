<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use App\Models\Group;
use App\Models\Contact;
use App\Models\Message;
use App\Models\ChatList;
use App\Models\BlockChat;
use App\Models\ChatLists;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // status online
    public function online(Request $request){
        User::where('id',Auth::user()->id)->update(['status'=>$request->status]);
    }

    // status offine
    public function offline(Request $request){
        User::where('id',Auth::user()->id)->update(['status'=>$request->status]);
    }

    // direct dashboard
    public function dashboard()
    {
        $people = User::when(request('search'), function ($query) {
                        $query->orWhere('name', 'like', '%' . request('search') . '%')
                            ->orWhere('phone', 'like', '%' . request('search') . '%')
                            ->orWhere('email', 'like', '%' . request('search') . '%');
                        })
                    ->get();

        $contact = Contact::select('users.*', 'contacts.id','contacts.user_id','contacts.add_user_id')
            ->rightJoin('users', 'contacts.add_user_id', 'users.id')
            ->when(request('searchContact'), function ($query) {
                $query->orWhere('users.name', 'like', '%' . request('searchContact') . '%');
                })
            ->where('contacts.user_id', Auth::user()->id)
            ->get();

        $group = Group::where('user_id', Auth::user()->id)
            ->when(request('searchGroup'), function ($query) {
                $query->orWhere('group_name', 'like', '%' . request('searchGroup') . '%');
                })
            ->orwhere('user_id', Auth::user()->id)
            ->orwhere('fir_user_id', Auth::user()->id)
            ->orwhere('sec_user_id', Auth::user()->id)
            ->orwhere('a_user_id', Auth::user()->id)
            ->orwhere('b_user_id', Auth::user()->id)
            ->orwhere('c_user_id', Auth::user()->id)
            ->orwhere('d_user_id', Auth::user()->id)
            ->orwhere('e_user_id', Auth::user()->id)
            ->orwhere('f_user_id', Auth::user()->id)
            ->orwhere('g_user_id', Auth::user()->id)
            ->orwhere('h_user_id', Auth::user()->id)->get();

        $block = BlockChat::select('block_chats.*','users.*')
            ->leftJoin('users','block_chats.blocked_id','users.id')
            ->where('block_chats.user_id',Auth::user()->id)->get();

        $blocked = BlockChat::select('block_chats.*','users.*')
            ->leftJoin('users','block_chats.blocked_id','users.id')
            ->where('block_chats.blocked_id',Auth::user()->id)->get();

        $chatlist = ChatLists::select('chat_lists.fir_user_id','chat_lists.sec_user_id','users.*')
            ->rightJoin('users','chat_lists.sec_user_id','users.id')
            ->when(request('searchChat'), function ($query) {
                $query->orWhere('users.name', 'like', '%' . request('searchChat') . '%');
                })
            ->where('chat_lists.fir_user_id',Auth::user()->id)
            ->get();

        return view('dashboard', compact('chatlist','people', 'contact', 'group','block','blocked'));
    }

    // direct account page
    public function accountPage()
    {
        $people = User::when(request('search'), function ($query) {
            $query->orWhere('name', 'like', '%' . request('search') . '%')
                ->orWhere('phone', 'like', '%' . request('search') . '%')
                ->orWhere('email', 'like', '%' . request('search') . '%');
            })
        ->get();

        $contact = Contact::select('users.*','contacts.id','contacts.user_id','contacts.add_user_id')
            ->leftJoin('users', 'contacts.add_user_id', 'users.id')
            ->where('contacts.user_id', Auth::user()->id)
            ->get();

        $block = BlockChat::select('block_chats.*','users.*')
            ->leftJoin('users','block_chats.blocked_id','users.id')
            ->where('block_chats.user_id',Auth::user()->id)->get();

        $blocked = BlockChat::select('block_chats.*','users.*')
            ->leftJoin('users','block_chats.blocked_id','users.id')
            ->where('block_chats.blocked_id',Auth::user()->id)->get();


        return view('profile.account', compact('people', 'contact','block','blocked'));
    }

    // account delete
    public function accountDelete(){
        User::where('id',Auth::user()->id)->delete();
    }

    // update user
    public function accountUpdate(Request $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'bio' => $request->bio
        ];
        User::where('id', Auth::user()->id)->update($data);
        return back();
    }

    // update user image
    public function accountImage(Request $request)
    {
        $oldPhotoName = User::select('image')->where('id', Auth::user()->id)->first();
        $oldPhotoName = $oldPhotoName['image'];

        if ($oldPhotoName != null) {
            Storage::delete('public/' . $oldPhotoName);
        }

        $folderPath = public_path('storage/');

        $image_parts = explode(";base64,", $request->image); // data:image/png
        $image_base = base64_decode($image_parts[1]);

        $imageName = uniqid() . '.png';
        $imageFullPath = $folderPath . $imageName;
        file_put_contents($imageFullPath, $image_base);

        $upload['image'] = $imageName;

        User::where('id', Auth::user()->id)->update($upload);

        return response()->json();
    }

    // direct password change page
    public function passwordChangePage()
    {
        return view('profile.pwReset');
    }

    // account change password
    public function passwordChange(Request $request)
    {
        $request->validate([
            'oldPassword' => 'required|min:5',
            'newPassword' => 'required|min:5',
            'confirmNewPassword' => 'required|min:5|same:newPassword'
        ]);
        $user = User::where('id', Auth::user()->id)->first();
        $dbPassword = $user->password;

        if (Hash::check($request->oldPassword, $dbPassword)) {
            $data = ['password' => Hash::make($request->confirmNewPassword)];
            User::where('id', Auth::user()->id)->update($data);
            return back();
        }
        return back()->with(['notMatch' => 'The old password does not match! Try again...']);
    }
}
