<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Group;
use App\Models\Contact;
use App\Models\Message;
use App\Models\BlockChat;
use App\Models\GroupChat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GroupChatController extends Controller
{
    // create group chat
    public function group(Request $request)
    {
        $key = array_keys($request->toArray());

        if (count($key) >= 14) {
            return back()->with(['exceedMember' => '...']);
        }

        if (count($key) < 5) {
            $m1 = Contact::where('add_user_id', $key[3])->first();
            $data = [
                'user_id' =>  $request->userId,
                'group_name' => $request->groupName,
                'fir_user_id' =>  $m1->add_user_id,
            ];
        } elseif (count($key) < 6) {
            $m1 = Contact::where('add_user_id', $key[3])->first();
            $m2 = Contact::where('add_user_id', $key[4])->first();
            $data = [
                'user_id' =>  $request->userId,
                'group_name' => $request->groupName,
                'fir_user_id' =>  $m1->add_user_id,
                'sec_user_id' =>  $m2->add_user_id
            ];
        } elseif (count($key) < 7) {
            $m1 = Contact::where('add_user_id', $key[3])->first();
            $m2 = Contact::where('add_user_id', $key[4])->first();
            $m3 = Contact::where('add_user_id', $key[5])->first();
            $data = [
                'user_id' =>  $request->userId,
                'group_name' => $request->groupName,
                'fir_user_id' =>  $m1->add_user_id,
                'sec_user_id' =>  $m2->add_user_id,
                'a_user_id' => $m3->add_user_id
            ];
        } elseif (count($key) < 8) {
            $m1 = Contact::where('add_user_id', $key[3])->first();
            $m2 = Contact::where('add_user_id', $key[4])->first();
            $m3 = Contact::where('add_user_id', $key[5])->first();
            $m4 = Contact::where('add_user_id', $key[6])->first();
            $data = [
                'user_id' =>  $request->userId,
                'group_name' => $request->groupName,
                'fir_user_id' =>  $m1->add_user_id,
                'sec_user_id' =>  $m2->add_user_id,
                'a_user_id' => $m3->add_user_id,
                'b_user_id' => $m4->add_user_id
            ];
        } elseif (count($key) < 9) {
            $m1 = Contact::where('add_user_id', $key[3])->first();
            $m2 = Contact::where('add_user_id', $key[4])->first();
            $m3 = Contact::where('add_user_id', $key[5])->first();
            $m4 = Contact::where('add_user_id', $key[6])->first();
            $m5 = Contact::where('add_user_id', $key[7])->first();
            $data = [
                'user_id' =>  $request->userId,
                'group_name' => $request->groupName,
                'fir_user_id' =>  $m1->add_user_id,
                'sec_user_id' =>  $m2->add_user_id,
                'a_user_id' => $m3->add_user_id,
                'b_user_id' => $m4->add_user_id,
                'c_user_id' => $m5->add_user_id
            ];
        } elseif (count($key) < 10) {
            $m1 = Contact::where('add_user_id', $key[3])->first();
            $m2 = Contact::where('add_user_id', $key[4])->first();
            $m3 = Contact::where('add_user_id', $key[5])->first();
            $m4 = Contact::where('add_user_id', $key[6])->first();
            $m5 = Contact::where('add_user_id', $key[7])->first();
            $m6 = Contact::where('add_user_id', $key[8])->first();
            $data = [
                'user_id' =>  $request->userId,
                'group_name' => $request->groupName,
                'fir_user_id' =>  $m1->add_user_id,
                'sec_user_id' =>  $m2->add_user_id,
                'a_user_id' => $m3->add_user_id,
                'b_user_id' => $m4->add_user_id,
                'c_user_id' => $m5->add_user_id,
                'd_user_id' => $m6->add_user_id
            ];
        } elseif (count($key) < 11) {
            $m1 = Contact::where('add_user_id', $key[3])->first();
            $m2 = Contact::where('add_user_id', $key[4])->first();
            $m3 = Contact::where('add_user_id', $key[5])->first();
            $m4 = Contact::where('add_user_id', $key[6])->first();
            $m5 = Contact::where('add_user_id', $key[7])->first();
            $m6 = Contact::where('add_user_id', $key[8])->first();
            $m7 = Contact::where('add_user_id', $key[9])->first();
            $data = [
                'user_id' =>  $request->userId,
                'group_name' => $request->groupName,
                'fir_user_id' =>  $m1->add_user_id,
                'sec_user_id' =>  $m2->add_user_id,
                'a_user_id' => $m3->add_user_id,
                'b_user_id' => $m4->add_user_id,
                'c_user_id' => $m5->add_user_id,
                'd_user_id' => $m6->add_user_id,
                'e_user_id' => $m7->add_user_id
            ];
        } elseif (count($key) < 12) {
            $m1 = Contact::where('add_user_id', $key[3])->first();
            $m2 = Contact::where('add_user_id', $key[4])->first();
            $m3 = Contact::where('add_user_id', $key[5])->first();
            $m4 = Contact::where('add_user_id', $key[6])->first();
            $m5 = Contact::where('add_user_id', $key[7])->first();
            $m6 = Contact::where('add_user_id', $key[8])->first();
            $m7 = Contact::where('add_user_id', $key[9])->first();
            $m8 = Contact::where('add_user_id', $key[10])->first();
            $data = [
                'user_id' =>  $request->userId,
                'group_name' => $request->groupName,
                'fir_user_id' =>  $m1->add_user_id,
                'sec_user_id' =>  $m2->add_user_id,
                'a_user_id' => $m3->add_user_id,
                'b_user_id' => $m4->add_user_id,
                'c_user_id' => $m5->add_user_id,
                'd_user_id' => $m6->add_user_id,
                'e_user_id' => $m7->add_user_id,
                'f_user_id' => $m8->add_user_id
            ];
        } elseif (count($key) < 13) {
            $m1 = Contact::where('add_user_id', $key[3])->first();
            $m2 = Contact::where('add_user_id', $key[4])->first();
            $m3 = Contact::where('add_user_id', $key[5])->first();
            $m4 = Contact::where('add_user_id', $key[6])->first();
            $m5 = Contact::where('add_user_id', $key[7])->first();
            $m6 = Contact::where('add_user_id', $key[8])->first();
            $m7 = Contact::where('add_user_id', $key[9])->first();
            $m8 = Contact::where('add_user_id', $key[10])->first();
            $m9 = Contact::where('add_user_id', $key[11])->first();
            $data = [
                'user_id' =>  $request->userId,
                'group_name' => $request->groupName,
                'fir_user_id' =>  $m1->add_user_id,
                'sec_user_id' =>  $m2->add_user_id,
                'a_user_id' => $m3->add_user_id,
                'b_user_id' => $m4->add_user_id,
                'c_user_id' => $m5->add_user_id,
                'd_user_id' => $m6->add_user_id,
                'e_user_id' => $m7->add_user_id,
                'f_user_id' => $m8->add_user_id,
                'g_user_id' => $m9->add_user_id
            ];
        } elseif (count($key) < 14) {
            $m1 = Contact::where('add_user_id', $key[3])->first();
            $m2 = Contact::where('add_user_id', $key[4])->first();
            $m3 = Contact::where('add_user_id', $key[5])->first();
            $m4 = Contact::where('add_user_id', $key[6])->first();
            $m5 = Contact::where('add_user_id', $key[7])->first();
            $m6 = Contact::where('add_user_id', $key[8])->first();
            $m7 = Contact::where('add_user_id', $key[9])->first();
            $m8 = Contact::where('add_user_id', $key[10])->first();
            $m9 = Contact::where('add_user_id', $key[11])->first();
            $m10 = Contact::where('add_user_id', $key[12])->first();
            $data = [
                'user_id' =>  $request->userId,
                'group_name' => $request->groupName,
                'fir_user_id' =>  $m1->add_user_id,
                'sec_user_id' =>  $m2->add_user_id,
                'a_user_id' => $m3->add_user_id,
                'b_user_id' => $m4->add_user_id,
                'c_user_id' => $m5->add_user_id,
                'd_user_id' => $m6->add_user_id,
                'e_user_id' => $m7->add_user_id,
                'f_user_id' => $m8->add_user_id,
                'g_user_id' => $m9->add_user_id,
                'h_user_id' => $m10->add_user_id
            ];
        }
        $groupChat = Group::create($data);
        $data1 = $this->CallBackGpChatPage1();
        $data = $this->CallBackGpChatPage($groupChat);

        $people = $data1[0];
        $contact = $data1[1];
        $group = $data1[2];
        $block = $data1[3];
        $blocked = $data1[4];

        $user    = $data[0];
        $firUser = $data[1];
        $secUser = $data[2];
        $aUser = $data[3];
        $bUser = $data[4];
        $cUser = $data[5];
        $dUser = $data[6];
        $eUser = $data[7];
        $fUser = $data[8];
        $gUser = $data[9];
        $hUser = $data[10];
        $message = $data[11];
        $imageOrder = $data[12];
        $memberPic = $data[13];

        return view('chat.groupchat', compact('people', 'contact', 'group', 'groupChat', 'message', 'imageOrder', 'user', 'firUser', 'secUser', 'aUser', 'bUser', 'cUser', 'dUser', 'eUser', 'fUser', 'gUser', 'hUser', 'block', 'blocked'));
    }

    // direct group chat page
    public function groupPage($id)
    {
        $groupChat = Group::where('id', $id)->first();

        $data1 = $this->CallBackGpChatPage1();
        $data = $this->CallBackGpChatPage($groupChat);

        $people = $data1[0];
        $contact = $data1[1];
        $group = $data1[2];
        $block = $data1[3];
        $blocked = $data1[4];

        $user = $data[0];
        $firUser = $data[1];
        $secUser = $data[2];
        $aUser = $data[3];
        $bUser = $data[4];
        $cUser = $data[5];
        $dUser = $data[6];
        $eUser = $data[7];
        $fUser = $data[8];
        $gUser = $data[9];
        $hUser = $data[10];
        $message = $data[11];
        $imageOrder = $data[12];
        $memberPic = $data[13];

        return view('chat.groupchat', compact('people', 'contact', 'group', 'groupChat', 'message', 'imageOrder', 'user', 'firUser', 'secUser', 'aUser', 'bUser', 'cUser', 'dUser', 'eUser', 'fUser', 'gUser', 'hUser', 'blocked', 'block'));
    }

    // group chat message
    public function groupMessage(Request $request)
    {
        $random = mt_rand(1, 1000000);
        $chat = [
            'gp_id' => $request->gpId,
            'user_id' => $request->userId,
            'fir_user_id' => $request->firstUser,
            'chat_code' => $random
        ];

        if (isset($request->secUser)) {
            $chat['sec_user_id'] = $request->secUser;
        };
        if (isset($request->aUser)) {
            $chat['a_user_id'] = $request->aUser;
        };
        if (isset($request->bUser)) {
            $chat['b_user_id'] = $request->bUser;
        };
        if (isset($request->cUser)) {
            $chat['c_user_id'] = $request->cUser;
        };
        if (isset($request->dUser)) {
            $chat['d_user_id'] = $request->dUser;
        };
        if (isset($request->eUser)) {
            $chat['e_user_id'] = $request->eUser;
        };
        if (isset($request->fUser)) {
            $chat['f_user_id'] = $request->fUser;
        };
        if (isset($request->gUser)) {
            $chat['g_user_id'] = $request->gUser;
        };
        if (isset($request->hUser)) {
            $chat['h_user_id'] = $request->hUser;
        };

        $message = [
            'text' => $request->message,
            'chat_code' => $random,
            'reply_chat_code' => $request->replyCode
        ];
        if ($request->hasFile('image')) {
            $fileName = uniqid() . "_" . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $fileName);
            $message['image'] = $fileName;
        }

        GroupChat::create($chat);
        Message::create($message);

        return redirect()->route('group#groupChatPage', $request->gpId);
    }

    // change group profile
    public function groupProfileChange(Request $request)
    {
        $oldPhotoName = Group::select('group_image')->where('id', $request->id)->first();
        $oldPhotoName = $oldPhotoName['group_image'];

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

        $upload['group_image'] = $imageName;

        Group::where('id', $request->id)->update($upload);

        return response()->json([
            'id' => $request->id,
        ]);
    }

    // group change name
    public function groupProfileChangeName(Request $request)
    {
        $data = ['group_name' => $request->gpname];
        Group::where('id', $request->id)->update($data);
        return back();
    }

    // group delete
    public function groupDelete($id)
    {
        Group::where('id', $id)->delete();

        $data1 = $this->CallBackGpChatPage1();

        $people = $data1[0];
        $contact = $data1[1];
        $group = $data1[2];
        $block = $data1[3];
        $blocked = $data1[4];

        return view('dashboard', compact('people', 'contact', 'group', 'block', 'blocked'));
    }

    // group leave
    public function groupLeave($id)
    {

        if (Group::where('fir_user_id', Auth::user()->id)->first()) {
            $deleteUser = ['fir_user_id' => null];
        } elseif (Group::where('sec_user_id', Auth::user()->id)->first()) {
            $deleteUser = ['sec_user_id' => null];
        } elseif (Group::where('a_user_id', Auth::user()->id)->first()) {
            $deleteUser = ['a_user_id' => null];
        } elseif (Group::where('b_user_id', Auth::user()->id)->first()) {
            $deleteUser = ['b_user_id' => null];
        } elseif (Group::where('c_user_id', Auth::user()->id)->first()) {
            $deleteUser = ['c_user_id' => null];
        } elseif (Group::where('d_user_id', Auth::user()->id)->first()) {
            $deleteUser = ['d_user_id' => null];
        } elseif (Group::where('e_user_id', Auth::user()->id)->first()) {
            $deleteUser = ['e_user_id' => null];
        } elseif (Group::where('f_user_id', Auth::user()->id)->first()) {
            $deleteUser = ['f_user_id' => null];
        } elseif (Group::where('g_user_id', Auth::user()->id)->first()) {
            $deleteUser = ['g_user_id' => null];
        } elseif (Group::where('h_user_id', Auth::user()->id)->first()) {
            $deleteUser = ['h_user_id' => null];
        }

        Group::where('id', $id)->update($deleteUser);

        GroupChat::select('group_chats.*', 'messages.*')
            ->leftJoin("messages", 'group_chats.chat_code', 'messages.chat_code')
            ->where('group_chats.user_id', Auth::user()->id)
            ->delete();

        $data1 = $this->CallBackGpChatPage1();

        $people = $data1[0];
        $contact = $data1[1];
        $group = $data1[2];
        $block = $data1[3];
        $blocked = $data1[4];

        return view('dashboard', compact('people', 'contact', 'group', 'block', 'blocked'));
    }

    // add member
    public function groupAddMember(Request $request)
    {
        $key = array_keys($request->toArray());

        $member = Group::where('id', $request->gpID)->first();

        if ($member->sec_user_id == null) {
            if (count($key) < 4) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $data = ['sec_user_id' =>  $m1->add_user_id];
            } elseif (count($key) < 5) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $m2 = Contact::where('add_user_id', $key[3])->first();
                $data = [
                    'sec_user_id' =>  $m1->add_user_id,
                    'a_user_id' =>  $m2->add_user_id
                ];
            } elseif (count($key) < 6) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $m2 = Contact::where('add_user_id', $key[3])->first();
                $m3 = Contact::where('add_user_id', $key[4])->first();
                $data = [
                    'sec_user_id' =>  $m1->add_user_id,
                    'a_user_id' =>  $m2->add_user_id,
                    'b_user_id' => $m3->add_user_id
                ];
            } elseif (count($key) < 7) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $m2 = Contact::where('add_user_id', $key[3])->first();
                $m3 = Contact::where('add_user_id', $key[4])->first();
                $m4 = Contact::where('add_user_id', $key[5])->first();
                $data = [
                    'sec_user_id' =>  $m1->add_user_id,
                    'a_user_id' =>  $m2->add_user_id,
                    'b_user_id' => $m3->add_user_id,
                    'c_user_id' => $m4->add_user_id
                ];
            } elseif (count($key) < 8) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $m2 = Contact::where('add_user_id', $key[3])->first();
                $m3 = Contact::where('add_user_id', $key[4])->first();
                $m4 = Contact::where('add_user_id', $key[5])->first();
                $m5 = Contact::where('add_user_id', $key[6])->first();
                $data = [
                    'sec_user_id' =>  $m1->add_user_id,
                    'a_user_id' =>  $m2->add_user_id,
                    'b_user_id' => $m3->add_user_id,
                    'c_user_id' => $m4->add_user_id,
                    'd_user_id' => $m5->add_user_id
                ];
            } elseif (count($key) < 9) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $m2 = Contact::where('add_user_id', $key[3])->first();
                $m3 = Contact::where('add_user_id', $key[4])->first();
                $m4 = Contact::where('add_user_id', $key[5])->first();
                $m5 = Contact::where('add_user_id', $key[6])->first();
                $m6 = Contact::where('add_user_id', $key[7])->first();
                $data = [
                    'sec_user_id' =>  $m1->add_user_id,
                    'a_user_id' =>  $m2->add_user_id,
                    'b_user_id' => $m3->add_user_id,
                    'c_user_id' => $m4->add_user_id,
                    'd_user_id' => $m5->add_user_id,
                    'e_user_id' => $m6->add_user_id
                ];
            } elseif (count($key) < 10) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $m2 = Contact::where('add_user_id', $key[3])->first();
                $m3 = Contact::where('add_user_id', $key[4])->first();
                $m4 = Contact::where('add_user_id', $key[5])->first();
                $m5 = Contact::where('add_user_id', $key[6])->first();
                $m6 = Contact::where('add_user_id', $key[7])->first();
                $m7 = Contact::where('add_user_id', $key[8])->first();
                $data = [
                    'sec_user_id' =>  $m1->add_user_id,
                    'a_user_id' =>  $m2->add_user_id,
                    'b_user_id' => $m3->add_user_id,
                    'c_user_id' => $m4->add_user_id,
                    'd_user_id' => $m5->add_user_id,
                    'e_user_id' => $m6->add_user_id,
                    'f_user_id' => $m7->add_user_id
                ];
            } elseif (count($key) < 11) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $m2 = Contact::where('add_user_id', $key[3])->first();
                $m3 = Contact::where('add_user_id', $key[4])->first();
                $m4 = Contact::where('add_user_id', $key[5])->first();
                $m5 = Contact::where('add_user_id', $key[6])->first();
                $m6 = Contact::where('add_user_id', $key[7])->first();
                $m7 = Contact::where('add_user_id', $key[8])->first();
                $m8 = Contact::where('add_user_id', $key[9])->first();
                $data = [
                    'sec_user_id' =>  $m1->add_user_id,
                    'a_user_id' =>  $m2->add_user_id,
                    'b_user_id' => $m3->add_user_id,
                    'c_user_id' => $m4->add_user_id,
                    'd_user_id' => $m5->add_user_id,
                    'e_user_id' => $m6->add_user_id,
                    'f_user_id' => $m7->add_user_id,
                    'g_user_id' => $m8->add_user_id
                ];
            } elseif (count($key) < 12) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $m2 = Contact::where('add_user_id', $key[3])->first();
                $m3 = Contact::where('add_user_id', $key[4])->first();
                $m4 = Contact::where('add_user_id', $key[5])->first();
                $m5 = Contact::where('add_user_id', $key[6])->first();
                $m6 = Contact::where('add_user_id', $key[7])->first();
                $m7 = Contact::where('add_user_id', $key[8])->first();
                $m8 = Contact::where('add_user_id', $key[9])->first();
                $m9 = Contact::where('add_user_id', $key[10])->first();
                $data = [
                    'sec_user_id' =>  $m1->add_user_id,
                    'a_user_id' =>  $m2->add_user_id,
                    'b_user_id' => $m3->add_user_id,
                    'c_user_id' => $m4->add_user_id,
                    'd_user_id' => $m5->add_user_id,
                    'e_user_id' => $m6->add_user_id,
                    'f_user_id' => $m7->add_user_id,
                    'g_user_id' => $m8->add_user_id,
                    'h_user_id' => $m9->add_user_id
                ];
            }
        } elseif ($member->sec_user_id != null && $member->a_user_id == null) {
            if (count($key) < 4) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $data = ['a_user_id' =>  $m1->add_user_id];
            } elseif (count($key) < 5) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $m2 = Contact::where('add_user_id', $key[3])->first();
                $data = [
                    'a_user_id' =>  $m1->add_user_id,
                    'b_user_id' =>  $m2->add_user_id
                ];
            } elseif (count($key) < 6) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $m2 = Contact::where('add_user_id', $key[3])->first();
                $m3 = Contact::where('add_user_id', $key[4])->first();
                $data = [
                    'a_user_id' =>  $m1->add_user_id,
                    'b_user_id' =>  $m2->add_user_id,
                    'c_user_id' => $m3->add_user_id
                ];
            } elseif (count($key) < 7) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $m2 = Contact::where('add_user_id', $key[3])->first();
                $m3 = Contact::where('add_user_id', $key[4])->first();
                $m4 = Contact::where('add_user_id', $key[5])->first();
                $data = [
                    'a_user_id' =>  $m1->add_user_id,
                    'b_user_id' =>  $m2->add_user_id,
                    'c_user_id' => $m3->add_user_id,
                    'd_user_id' => $m4->add_user_id
                ];
            } elseif (count($key) < 8) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $m2 = Contact::where('add_user_id', $key[3])->first();
                $m3 = Contact::where('add_user_id', $key[4])->first();
                $m4 = Contact::where('add_user_id', $key[5])->first();
                $m5 = Contact::where('add_user_id', $key[6])->first();
                $data = [
                    'a_user_id' =>  $m1->add_user_id,
                    'b_user_id' =>  $m2->add_user_id,
                    'c_user_id' => $m3->add_user_id,
                    'd_user_id' => $m4->add_user_id,
                    'e_user_id' => $m5->add_user_id
                ];
            } elseif (count($key) < 9) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $m2 = Contact::where('add_user_id', $key[3])->first();
                $m3 = Contact::where('add_user_id', $key[4])->first();
                $m4 = Contact::where('add_user_id', $key[5])->first();
                $m5 = Contact::where('add_user_id', $key[6])->first();
                $m6 = Contact::where('add_user_id', $key[7])->first();
                $data = [
                    'a_user_id' =>  $m1->add_user_id,
                    'b_user_id' =>  $m2->add_user_id,
                    'c_user_id' => $m3->add_user_id,
                    'd_user_id' => $m4->add_user_id,
                    'e_user_id' => $m5->add_user_id,
                    'f_user_id' => $m6->add_user_id
                ];
            } elseif (count($key) < 10) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $m2 = Contact::where('add_user_id', $key[3])->first();
                $m3 = Contact::where('add_user_id', $key[4])->first();
                $m4 = Contact::where('add_user_id', $key[5])->first();
                $m5 = Contact::where('add_user_id', $key[6])->first();
                $m6 = Contact::where('add_user_id', $key[7])->first();
                $m7 = Contact::where('add_user_id', $key[8])->first();
                $data = [
                    'a_user_id' =>  $m1->add_user_id,
                    'b_user_id' =>  $m2->add_user_id,
                    'c_user_id' => $m3->add_user_id,
                    'd_user_id' => $m4->add_user_id,
                    'e_user_id' => $m5->add_user_id,
                    'f_user_id' => $m6->add_user_id,
                    'g_user_id' => $m7->add_user_id
                ];
            } elseif (count($key) < 11) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $m2 = Contact::where('add_user_id', $key[3])->first();
                $m3 = Contact::where('add_user_id', $key[4])->first();
                $m4 = Contact::where('add_user_id', $key[5])->first();
                $m5 = Contact::where('add_user_id', $key[6])->first();
                $m6 = Contact::where('add_user_id', $key[7])->first();
                $m7 = Contact::where('add_user_id', $key[8])->first();
                $m8 = Contact::where('add_user_id', $key[9])->first();
                $data = [
                    'a_user_id' =>  $m1->add_user_id,
                    'b_user_id' =>  $m2->add_user_id,
                    'c_user_id' => $m3->add_user_id,
                    'd_user_id' => $m4->add_user_id,
                    'e_user_id' => $m5->add_user_id,
                    'f_user_id' => $m6->add_user_id,
                    'g_user_id' => $m7->add_user_id,
                    'h_user_id' => $m8->add_user_id
                ];
            }
        } elseif ($member->sec_user_id != null && $member->a_user_id != null && $member->b_user_id == null) {
            if (count($key) < 4) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $data = ['b_user_id' =>  $m1->add_user_id];
            } elseif (count($key) < 5) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $m2 = Contact::where('add_user_id', $key[3])->first();
                $data = [
                    'b_user_id' =>  $m1->add_user_id,
                    'c_user_id' =>  $m2->add_user_id
                ];
            } elseif (count($key) < 6) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $m2 = Contact::where('add_user_id', $key[3])->first();
                $m3 = Contact::where('add_user_id', $key[4])->first();
                $data = [
                    'b_user_id' =>  $m1->add_user_id,
                    'c_user_id' =>  $m2->add_user_id,
                    'd_user_id' => $m3->add_user_id
                ];
            } elseif (count($key) < 7) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $m2 = Contact::where('add_user_id', $key[3])->first();
                $m3 = Contact::where('add_user_id', $key[4])->first();
                $m4 = Contact::where('add_user_id', $key[5])->first();
                $data = [
                    'b_user_id' =>  $m1->add_user_id,
                    'c_user_id' =>  $m2->add_user_id,
                    'd_user_id' => $m3->add_user_id,
                    'e_user_id' => $m4->add_user_id
                ];
            } elseif (count($key) < 8) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $m2 = Contact::where('add_user_id', $key[3])->first();
                $m3 = Contact::where('add_user_id', $key[4])->first();
                $m4 = Contact::where('add_user_id', $key[5])->first();
                $m5 = Contact::where('add_user_id', $key[6])->first();
                $data = [
                    'b_user_id' =>  $m1->add_user_id,
                    'c_user_id' =>  $m2->add_user_id,
                    'd_user_id' => $m3->add_user_id,
                    'e_user_id' => $m4->add_user_id,
                    'f_user_id' => $m5->add_user_id
                ];
            } elseif (count($key) < 9) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $m2 = Contact::where('add_user_id', $key[3])->first();
                $m3 = Contact::where('add_user_id', $key[4])->first();
                $m4 = Contact::where('add_user_id', $key[5])->first();
                $m5 = Contact::where('add_user_id', $key[6])->first();
                $m6 = Contact::where('add_user_id', $key[7])->first();
                $data = [
                    'b_user_id' =>  $m1->add_user_id,
                    'c_user_id' =>  $m2->add_user_id,
                    'd_user_id' => $m3->add_user_id,
                    'e_user_id' => $m4->add_user_id,
                    'f_user_id' => $m5->add_user_id,
                    'g_user_id' => $m6->add_user_id
                ];
            } elseif (count($key) < 10) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $m2 = Contact::where('add_user_id', $key[3])->first();
                $m3 = Contact::where('add_user_id', $key[4])->first();
                $m4 = Contact::where('add_user_id', $key[5])->first();
                $m5 = Contact::where('add_user_id', $key[6])->first();
                $m6 = Contact::where('add_user_id', $key[7])->first();
                $m7 = Contact::where('add_user_id', $key[8])->first();
                $data = [
                    'b_user_id' =>  $m1->add_user_id,
                    'c_user_id' =>  $m2->add_user_id,
                    'd_user_id' => $m3->add_user_id,
                    'e_user_id' => $m4->add_user_id,
                    'f_user_id' => $m5->add_user_id,
                    'g_user_id' => $m6->add_user_id,
                    'h_user_id' => $m7->add_user_id
                ];
            }
        } elseif ($member->sec_user_id != null && $member->a_user_id != null && $member->b_user_id != null && $member->c_user_id == null) {
            if (count($key) < 4) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $data = ['c_user_id' =>  $m1->add_user_id];
            } elseif (count($key) < 5) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $m2 = Contact::where('add_user_id', $key[3])->first();
                $data = [
                    'c_user_id' =>  $m1->add_user_id,
                    'd_user_id' =>  $m2->add_user_id
                ];
            } elseif (count($key) < 6) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $m2 = Contact::where('add_user_id', $key[3])->first();
                $m3 = Contact::where('add_user_id', $key[4])->first();
                $data = [
                    'c_user_id' =>  $m1->add_user_id,
                    'd_user_id' =>  $m2->add_user_id,
                    'e_user_id' => $m3->add_user_id
                ];
            } elseif (count($key) < 7) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $m2 = Contact::where('add_user_id', $key[3])->first();
                $m3 = Contact::where('add_user_id', $key[4])->first();
                $m4 = Contact::where('add_user_id', $key[5])->first();
                $data = [
                    'c_user_id' =>  $m1->add_user_id,
                    'd_user_id' =>  $m2->add_user_id,
                    'e_user_id' => $m3->add_user_id,
                    'f_user_id' => $m4->add_user_id
                ];
            } elseif (count($key) < 8) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $m2 = Contact::where('add_user_id', $key[3])->first();
                $m3 = Contact::where('add_user_id', $key[4])->first();
                $m4 = Contact::where('add_user_id', $key[5])->first();
                $m5 = Contact::where('add_user_id', $key[6])->first();
                $data = [
                    'c_user_id' =>  $m1->add_user_id,
                    'd_user_id' =>  $m2->add_user_id,
                    'e_user_id' => $m3->add_user_id,
                    'f_user_id' => $m4->add_user_id,
                    'g_user_id' => $m5->add_user_id
                ];
            } elseif (count($key) < 9) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $m2 = Contact::where('add_user_id', $key[3])->first();
                $m3 = Contact::where('add_user_id', $key[4])->first();
                $m4 = Contact::where('add_user_id', $key[5])->first();
                $m5 = Contact::where('add_user_id', $key[6])->first();
                $m6 = Contact::where('add_user_id', $key[7])->first();
                $data = [
                    'c_user_id' =>  $m1->add_user_id,
                    'd_user_id' =>  $m2->add_user_id,
                    'e_user_id' => $m3->add_user_id,
                    'f_user_id' => $m4->add_user_id,
                    'g_user_id' => $m5->add_user_id,
                    'h_user_id' => $m6->add_user_id
                ];
            }
        } elseif ($member->sec_user_id != null && $member->a_user_id != null && $member->b_user_id != null && $member->c_user_id != null && $member->d_user_id == null) {
            if (count($key) < 4) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $data = ['d_user_id' =>  $m1->add_user_id];
            } elseif (count($key) < 5) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $m2 = Contact::where('add_user_id', $key[3])->first();
                $data = [
                    'd_user_id' =>  $m1->add_user_id,
                    'e_user_id' =>  $m2->add_user_id
                ];
            } elseif (count($key) < 6) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $m2 = Contact::where('add_user_id', $key[3])->first();
                $m3 = Contact::where('add_user_id', $key[4])->first();
                $data = [
                    'd_user_id' =>  $m1->add_user_id,
                    'e_user_id' =>  $m2->add_user_id,
                    'f_user_id' => $m3->add_user_id
                ];
            } elseif (count($key) < 7) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $m2 = Contact::where('add_user_id', $key[3])->first();
                $m3 = Contact::where('add_user_id', $key[4])->first();
                $m4 = Contact::where('add_user_id', $key[5])->first();
                $data = [
                    'd_user_id' =>  $m1->add_user_id,
                    'e_user_id' =>  $m2->add_user_id,
                    'f_user_id' => $m3->add_user_id,
                    'g_user_id' => $m4->add_user_id
                ];
            } elseif (count($key) < 8) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $m2 = Contact::where('add_user_id', $key[3])->first();
                $m3 = Contact::where('add_user_id', $key[4])->first();
                $m4 = Contact::where('add_user_id', $key[5])->first();
                $m5 = Contact::where('add_user_id', $key[6])->first();
                $data = [
                    'd_user_id' =>  $m1->add_user_id,
                    'e_user_id' =>  $m2->add_user_id,
                    'f_user_id' => $m3->add_user_id,
                    'g_user_id' => $m4->add_user_id,
                    'h_user_id' => $m5->add_user_id
                ];
            }
        } elseif ($member->sec_user_id != null && $member->a_user_id != null && $member->b_user_id != null && $member->c_user_id != null && $member->d_user_id != null && $member->e_user_id == null) {
            if (count($key) < 4) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $data = ['e_user_id' =>  $m1->add_user_id];
            } elseif (count($key) < 5) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $m2 = Contact::where('add_user_id', $key[3])->first();
                $data = [
                    'e_user_id' =>  $m1->add_user_id,
                    'f_user_id' =>  $m2->add_user_id
                ];
            } elseif (count($key) < 6) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $m2 = Contact::where('add_user_id', $key[3])->first();
                $m3 = Contact::where('add_user_id', $key[4])->first();
                $data = [
                    'e_user_id' =>  $m1->add_user_id,
                    'f_user_id' =>  $m2->add_user_id,
                    'g_user_id' => $m3->add_user_id
                ];
            } elseif (count($key) < 7) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $m2 = Contact::where('add_user_id', $key[3])->first();
                $m3 = Contact::where('add_user_id', $key[4])->first();
                $m4 = Contact::where('add_user_id', $key[5])->first();
                $data = [
                    'e_user_id' =>  $m1->add_user_id,
                    'f_user_id' =>  $m2->add_user_id,
                    'g_user_id' => $m3->add_user_id,
                    'h_user_id' => $m4->add_user_id
                ];
            }
        } elseif ($member->sec_user_id != null && $member->a_user_id != null && $member->b_user_id != null && $member->c_user_id != null && $member->d_user_id != null && $member->e_user_id != null && $member->f_user_id == null) {
            if (count($key) < 4) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $data = ['f_user_id' =>  $m1->add_user_id];
            } elseif (count($key) < 5) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $m2 = Contact::where('add_user_id', $key[3])->first();
                $data = [
                    'f_user_id' =>  $m1->add_user_id,
                    'g_user_id' =>  $m2->add_user_id
                ];
            } elseif (count($key) < 6) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $m2 = Contact::where('add_user_id', $key[3])->first();
                $m3 = Contact::where('add_user_id', $key[4])->first();
                $data = [
                    'f_user_id' =>  $m1->add_user_id,
                    'g_user_id' =>  $m2->add_user_id,
                    'h_user_id' => $m3->add_user_id
                ];
            }
        } elseif ($member->sec_user_id != null && $member->a_user_id != null && $member->b_user_id != null && $member->c_user_id != null && $member->d_user_id != null && $member->e_user_id != null && $member->f_user_id != null && $member->g_user_id == null) {
            if (count($key) < 4) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $data = ['g_user_id' =>  $m1->add_user_id];
            } elseif (count($key) < 5) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $m2 = Contact::where('add_user_id', $key[3])->first();
                $data = [
                    'g_user_id' =>  $m1->add_user_id,
                    'h_user_id' =>  $m2->add_user_id
                ];
            }
        } elseif ($member->sec_user_id != null && $member->a_user_id != null && $member->b_user_id != null && $member->c_user_id != null && $member->d_user_id != null && $member->e_user_id != null && $member->f_user_id != null && $member->g_user_id != null && $member->h_user_id == null) {
            if (count($key) < 4) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $data = ['h_user_id' =>  $m1->add_user_id];
            }
        }
        Group::where('id', $request->gpID)->update($data);
        return back();
    }

    // remove member
    public function groupRemoveMember($id)
    {
        if (Group::where('fir_user_id', $id)->first()) {
            $remove = Group::where('fir_user_id', $id)->first();
            $data = [
                'fir_user_id' => $remove->sec_user_id,
                'sec_user_id' => $remove->a_user_id,
                'a_user_id' => $remove->b_user_id,
                'b_user_id' => $remove->c_user_id,
                'c_user_id' => $remove->d_user_id,
                'd_user_id' => $remove->e_user_id,
                'e_user_id' => $remove->f_user_id,
                'f_user_id' => $remove->g_user_id,
                'g_user_id' => $remove->h_user_id,
                'h_user_id' => null
            ];
        } elseif (Group::where('sec_user_id', $id)->first()) {
            $remove = Group::where('sec_user_id', $id)->first();
            $data = [
                'sec_user_id' => $remove->a_user_id,
                'a_user_id' => $remove->b_user_id,
                'b_user_id' => $remove->c_user_id,
                'c_user_id' => $remove->d_user_id,
                'd_user_id' => $remove->e_user_id,
                'e_user_id' => $remove->f_user_id,
                'f_user_id' => $remove->g_user_id,
                'g_user_id' => $remove->h_user_id,
                'h_user_id' => null
            ];
        } elseif (Group::where('a_user_id', $id)->first()) {
            $remove = Group::where('a_user_id', $id)->first();
            $data = [
                'a_user_id' => $remove->b_user_id,
                'b_user_id' => $remove->c_user_id,
                'c_user_id' => $remove->d_user_id,
                'd_user_id' => $remove->e_user_id,
                'e_user_id' => $remove->f_user_id,
                'f_user_id' => $remove->g_user_id,
                'g_user_id' => $remove->h_user_id,
                'h_user_id' => null
            ];
        } elseif (Group::where('b_user_id', $id)->first()) {
            $remove = Group::where('b_user_id', $id)->first();
            $data = [
                'b_user_id' => $remove->c_user_id,
                'c_user_id' => $remove->d_user_id,
                'd_user_id' => $remove->e_user_id,
                'e_user_id' => $remove->f_user_id,
                'f_user_id' => $remove->g_user_id,
                'g_user_id' => $remove->h_user_id,
                'h_user_id' => null
            ];
        } elseif (Group::where('c_user_id', $id)->first()) {
            $remove = Group::where('c_user_id', $id)->first();
            $data = [
                'c_user_id' => $remove->d_user_id,
                'd_user_id' => $remove->e_user_id,
                'e_user_id' => $remove->f_user_id,
                'f_user_id' => $remove->g_user_id,
                'g_user_id' => $remove->h_user_id,
                'h_user_id' => null
            ];
        } elseif (Group::where('d_user_id', $id)->first()) {
            $remove = Group::where('d_user_id', $id)->first();
            $data = [
                'd_user_id' => $remove->e_user_id,
                'e_user_id' => $remove->f_user_id,
                'f_user_id' => $remove->g_user_id,
                'g_user_id' => $remove->h_user_id,
                'h_user_id' => null
            ];
        } elseif (Group::where('e_user_id', $id)->first()) {
            $remove = Group::where('e_user_id', $id)->first();
            $data = [
                'e_user_id' => $remove->f_user_id,
                'f_user_id' => $remove->g_user_id,
                'g_user_id' => $remove->h_user_id,
                'h_user_id' => null
            ];
        } elseif (Group::where('f_user_id', $id)->first()) {
            $remove = Group::where('f_user_id', $id)->first();
            $data = [
                'f_user_id' => $remove->g_user_id,
                'g_user_id' => $remove->h_user_id,
                'h_user_id' => null
            ];
        } elseif (Group::where('g_user_id', $id)->first()) {
            $remove = Group::where('g_user_id', $id)->first();
            $data = [
                'g_user_id' => $remove->h_user_id,
                'h_user_id' => null
            ];
        } elseif (Group::where('h_user_id', $id)->first()) {
            $data = [
                'h_user_id' => null
            ];
        }

        Group::where('fir_user_id', $id)->orwhere('sec_user_id', $id)
            ->orwhere('a_user_id', $id)->orwhere('b_user_id', $id)
            ->orwhere('c_user_id', $id)->orwhere('d_user_id', $id)
            ->orwhere('e_user_id', $id)->orwhere('f_user_id', $id)
            ->orwhere('g_user_id', $id)->orwhere('h_user_id', $id)->update($data);

        return back();
    }

    // group chat message delete
    public function groupMessageDelete($code)
    {
        Message::where('chat_code', $code)->update(['text' => null]);
        return back();
    }

    // chat message par delete
    public function groupMessageDeletePar($code)
    {
        Message::where('chat_code', $code)->delete();
        return back();
    }

    // group chat message reply
    public function groupMessageReply($code)
    {
        $reply = GroupChat::select('messages.*', 'group_chats.*')
            ->leftJoin('messages', 'group_chats.chat_code', 'messages.chat_code')
            ->where('group_chats.chat_code', $code)->first();

        $groupChat = Group::where('id', $reply->gp_id)->first();

        $data1 = $this->CallBackGpChatPage1();
        $data = $this->CallBackGpChatPage($groupChat);

        $people = $data1[0];
        $contact = $data1[1];
        $group = $data1[2];
        $block = $data1[3];
        $blocked = $data1[4];

        $user = $data[0];
        $firUser = $data[1];
        $secUser = $data[2];
        $aUser = $data[3];
        $bUser = $data[4];
        $cUser = $data[5];
        $dUser = $data[6];
        $eUser = $data[7];
        $fUser = $data[8];
        $gUser = $data[9];
        $hUser = $data[10];
        $message = $data[11];
        $imageOrder = $data[12];
        $memberPic = $data[13];

        return view('chat.groupchat', compact('reply', 'people', 'contact', 'group', 'groupChat', 'message', 'imageOrder', 'user', 'firUser', 'secUser', 'aUser', 'bUser', 'cUser', 'dUser', 'eUser', 'fUser', 'gUser', 'hUser', 'block', 'blocked'));
    }

    // group message seen
    public function groupSeen(Request $request)
    {
        if (GroupChat::where('gp_id', $request->gpID)->where('fir_user_id', Auth::user()->id)->first()) {
            $data = ['fir_status' => 'seen'];
        }
        if (GroupChat::where('gp_id', $request->gpID)->where('sec_user_id', Auth::user()->id)->first()) {
            $data = ['sec_status' => 'seen'];
        }
        if (GroupChat::where('gp_id', $request->gpID)->where('a_user_id', Auth::user()->id)->first()) {
            $data = ['a_status' => 'seen'];
        }
        if (GroupChat::where('gp_id', $request->gpID)->where('b_user_id', Auth::user()->id)->first()) {
            $data = ['b_status' => 'seen'];
        }
        if (GroupChat::where('gp_id', $request->gpID)->where('c_user_id', Auth::user()->id)->first()) {
            $data = ['c_status' => 'seen'];
        }
        if (GroupChat::where('gp_id', $request->gpID)->where('d_user_id', Auth::user()->id)->first()) {
            $data = ['d_status' => 'seen'];
        }
        if (GroupChat::where('gp_id', $request->gpID)->where('e_user_id', Auth::user()->id)->first()) {
            $data = ['e_status' => 'seen'];
        }
        if (GroupChat::where('gp_id', $request->gpID)->where('f_user_id', Auth::user()->id)->first()) {
            $data = ['f_status' => 'seen'];
        }
        if (GroupChat::where('gp_id', $request->gpID)->where('g_user_id', Auth::user()->id)->first()) {
            $data = ['g_status' => 'seen'];
        }
        if (GroupChat::where('gp_id', $request->gpID)->where('h_user_id', Auth::user()->id)->first()) {
            $data = ['h_status' => 'seen'];
        }

            GroupChat::where('gp_id', $request->gpID)
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
                ->orwhere('h_user_id', Auth::user()->id)->update($data);

    }

    // call back for gp chat page
    private function CallBackGpChatPage($id)
    {
        $user = User::where('id', $id->user_id)->first();
        $firUser = User::where('id', $id->fir_user_id)->first();
        $secUser = User::where('id', $id->sec_user_id)->first();
        $aUser = User::where('id', $id->a_user_id)->first();
        $bUser = User::where('id', $id->b_user_id)->first();
        $cUser = User::where('id', $id->c_user_id)->first();
        $dUser = User::where('id', $id->d_user_id)->first();
        $eUser = User::where('id', $id->e_user_id)->first();
        $fUser = User::where('id', $id->f_user_id)->first();
        $gUser = User::where('id', $id->g_user_id)->first();
        $hUser = User::where('id', $id->h_user_id)->first();

        $message = GroupChat::select('group_chats.*', 'messages.*')
            ->rightJoin('messages', 'group_chats.chat_code', 'messages.chat_code')
            ->where('group_chats.gp_id', $id->id)
            ->get();

        $imageOrder = GroupChat::select('group_chats.*', 'messages.*')
            ->leftJoin('messages', 'group_chats.chat_code', 'messages.chat_code')
            ->where('group_chats.gp_id', $id->id)
            ->orderBy('messages.created_at', 'desc')
            ->get();

        $memberPic = GroupChat::select('group_chats.*', 'users.*')
            ->leftJoin('users', 'group_chats.user_id', 'users.id')->where('users.id', 'group_chats.user_id')->get();

        return [$user, $firUser, $secUser, $aUser, $bUser, $cUser, $dUser, $eUser, $fUser, $gUser, $hUser, $message, $imageOrder, $memberPic];
    }

    // call back chat page 2
    private function CallBackGpChatPage1()
    {
        $people = User::get();
        $contact = Contact::select('users.*', 'contacts.id', 'contacts.user_id', 'contacts.add_user_id')
            ->leftJoin('users', 'contacts.add_user_id', 'users.id')
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

        $block = BlockChat::select('block_chats.*', 'users.*')
            ->leftJoin('users', 'block_chats.blocked_id', 'users.id')
            ->where('block_chats.user_id', Auth::user()->id)->get();

        $blocked = BlockChat::select('block_chats.*', 'users.*')
            ->leftJoin('users', 'block_chats.blocked_id', 'users.id')
            ->where('block_chats.blocked_id', Auth::user()->id)->get();

        return [$people, $contact, $group, $block, $blocked];
    }
}
