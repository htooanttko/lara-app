<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Group;
use App\Models\Contact;
use App\Models\BlockChat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
            ->where('contacts.user_id', Auth::user()->id)
            ->get();

        $group = Group::where('user_id', Auth::user()->id)
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

        return view('dashboard', compact('people', 'contact', 'group','block','blocked'));
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

    // update user name
    public function accountName(Request $request)
    {
        User::where('id', Auth::user()->id)->update(['name' => $request->name]);
        return back();
    }

    // update user phone
    public function accountPhone(Request $request)
    {
        User::where('id', Auth::user()->id)->update(['phone' => $request->phone]);
        return back();
    }

    // update user email
    public function accountEmail(Request $request)
    {
        User::where('id', Auth::user()->id)->update(['email' => $request->email]);
        return back();
    }

    // update user bio
    public function accountBio(Request $request)
    {
        User::where('id', Auth::user()->id)->update(['bio' => $request->bio]);
        return back();
    }

    // update user bio
    public function accountImage(Request $request)
    {
        $oldPhotoName = User::select('image')->where('id', Auth::user()->id)->first();
        $oldPhotoName = $oldPhotoName['image'];

        if ($oldPhotoName != null) {
            Storage::delete('public/' . $oldPhotoName);
        }

        $folderPath = public_path('storage/');

        $image_parts = explode(";base64,", $request->image); // data:image/png
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];       // png
        $image_base64 = base64_decode($image_parts[1]);

        $imageName = uniqid() . '.png';
        $imageFullPath = $folderPath . $imageName;
        file_put_contents($imageFullPath, $image_base64);

        $upload['image'] = $imageName;

        User::where('id', Auth::user()->id)->update($upload);

        return response()->json();
    }

    // account change password
    public function passwordChange(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->first();
        $dbPassword = $user->password;

        if (Hash::check($request->oldPassword, $dbPassword)) {
            $data = ['password' => Hash::make($request->confirmNewPassword)];
            User::where('id', Auth::user()->id)->update($data);
            return back()->with(['success' => " You've changed your Password"]);
        }
        return back()->with(['notMatch' => 'The old password does not match! Try again...']);
    }
}
