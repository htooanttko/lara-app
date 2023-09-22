<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- link  --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <style>
        #scroll::-webkit-scrollbar {
            display: none;
        }

        #detailScroll::-webkit-scrollbar {
            display: none;
        }

        #contactScroll::-webkit-scrollbar {
            display: none;
        }

        #groupScroll::-webkit-scrollbar {
            display: none;
        }

        .findPeople::-webkit-scrollbar {
            display: none;
        }

        .memberScroll::-webkit-scrollbar {
            display: none;
        }

        .preview {
            text-align: center;
            overflow: hidden;
            width: 160px;
            height: 160px;
            margin: auto;
            border: 2px solid black
        }

        .emoji-picker {
            border-radius: 10px;
            box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
        }

        .emoji-picker1 {
            border-radius: 10px;
            box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
        }

        .emoji-container {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 10px;
            margin-bottom: 10px;
        }

        .emoji-icon {
            cursor: pointer;
            font-size: 24px;
        }
    </style>

    <title>SnapView</title>
</head>

<body class=" bg-dark">
    @include('nav & body.nav')
    <section>
        <div class="row container-fluid">
            <!-- contact section start -->
            <div class="col-md">
                <div class="px-3 h-100 mt-2 rounded-3" style="background-color: rgb(51, 51, 51); ">

                    <div class="text-white fs-3 ps-3 mb-2" style=" border-bottom: 1px solid white;">Contacts</div>

                    <ul class="list-group list-group-flush overflow-auto" id="contactScroll"
                        style="border-bottom:1px solid black; height:35vh">
                        @foreach ($contact as $c)
                            <a href="{{ route('chat#chatPage', $c->add_user_id) }}"
                                class=" text-decoration-none rounded">
                                <li class="list-group-item d-flex my-1 text-white border-secondary"
                                    style="background-color: rgb(51, 51, 51); ">
                                    <div class="col-3">
                                        @if ($c->image == null)
                                            <img src="{{ asset('image/defaultpic.jpg') }}" alt=""
                                                class="w-100 rounded-circle">
                                        @else
                                            <img src="{{ asset('storage/' . $c->image) }}" alt=""
                                                class="w-100 rounded-circle">
                                        @endif
                                    </div>
                                    <div class="  pt-1 ms-3">
                                        <span class=" d-block">{{ $c->name }}</span>
                                        @if ($c->status == 'online')
                                            <small class=" text-white">{{ $c->status }}</small>
                                        @else
                                            @if (date('H') * 60 + date('i') - ($c->updated_at->format('H') * 60 + $c->updated_at->format('i')) > 60)
                                                <small class=" text-white-50">Active
                                                    {{ date('H') - $c->updated_at->format('H') }}
                                                    hours ago</small>
                                            @elseif (date('H') * 60 + date('i') - ($c->updated_at->format('H') * 60 + $c->updated_at->format('i')) == 0)
                                                <small class=" text-white-50">Active a minute ago
                                                </small>
                                            @elseif (date('H') * 60 + date('i') - ($c->updated_at->format('H') * 60 + $c->updated_at->format('i')) > 1140)
                                                <small class=" text-white-50">Active
                                                    {{ date('d') - $c->updated_at->format('d') }}
                                                    days ago</small>
                                            @elseif (date('H') * 60 + date('i') - ($c->updated_at->format('H') * 60 + $c->updated_at->format('i')) > 43200)
                                                <small class=" text-white-50">Active
                                                    {{ date('m') - $c->updated_at->format('m') }}
                                                    months ago</small>
                                            @elseif (date('H') * 60 + date('i') - ($c->updated_at->format('H') * 60 + $c->updated_at->format('i')) > 525600)
                                                <small class=" text-white-50">Active
                                                    {{ date('Y') - $c->updated_at->format('Y') }}
                                                    years ago</small>
                                            @else
                                                @if ($c->updated_at->format('H') * 60 + $c->updated_at->format('i') <= date('H') * 60 + date('i'))
                                                    <small class=" text-white-50">Active
                                                        {{ date('H') * 60 + date('i') - ($c->updated_at->format('H') * 60 + $c->updated_at->format('i')) }}
                                                        minute ago
                                                    </small>
                                                @endif
                                            @endif
                                        @endif
                                    </div>
                                </li>
                            </a>
                        @endforeach
                    </ul>
                    <!-- contact section end -->

                    <!-- group section start -->

                    <div class="text-white fs-3 ps-3 mb-2 mt-1" style=" border-bottom: 1px solid white;">Groups</div>
                    <ul class="list-group list-group-flush  overflow-auto" id="groupScroll" style="height:36vh">
                        @foreach ($group as $g)
                            <a href="{{ route('group#groupChatPage', $g->id) }}" class=" text-decoration-none rounded">
                                <li class="list-group-item d-flex my-1 text-white border-secondary"
                                    style="background-color: rgb(51, 51, 51); ">
                                    <div class=" col-3">
                                        @if ($g->group_image == null)
                                            <img src="{{ asset('image/defaultpic.jpg') }}" alt=""
                                                class=" w-100 rounded-circle">
                                        @else
                                            <img src="{{ asset('storage/' . $g->group_image) }}" alt=""
                                                class=" w-100 rounded-circle">
                                        @endif
                                    </div>
                                    <div class="col pt-1 ms-3">
                                        <span class=" d-block">{{ $g->group_name }}</span>
                                        @if (isset($g->sec_user_id) && !isset($g->a_user_id))
                                            <small class=" text-white-50">3 members</small>
                                        @endif
                                        @if (isset($g->a_user_id) && !isset($g->b_user_id))
                                            <small class=" text-white-50">4 members</small>
                                        @endif
                                        @if (isset($g->b_user_id) && !isset($g->c_user_id))
                                            <small class=" text-white-50">5 members</small>
                                        @endif
                                        @if (isset($g->c_user_id) && !isset($g->d_user_id))
                                            <small class=" text-white-50">6 members</small>
                                        @endif
                                        @if (isset($g->d_user_id) && !isset($g->e_user_id))
                                            <small class=" text-white-50">7 members</small>
                                        @endif
                                        @if (isset($g->e_user_id) && !isset($g->f_user_id))
                                            <small class=" text-white-50">8 members</small>
                                        @endif
                                        @if (isset($g->f_user_id) && !isset($g->g_user_id))
                                            <small class=" text-white-50">9 members</small>
                                        @endif
                                        @if (isset($g->g_user_id) && !isset($g->h_user_id))
                                            <small class=" text-white-50">10 members</small>
                                        @endif
                                        @if (isset($g->h_user_id))
                                            <small class=" text-white-50">11 members</small>
                                        @endif
                                    </div>
                                </li>
                            </a>
                        @endforeach
                    </ul>
                    <!-- group section end -->

                </div>

            </div>


            <!-- chat section start  -->
            <div class="col-md-7 mt-2 rounded-4" style="background-color:rgb(92, 92, 92); height: 87vh;">

                <div class="col ">
                    <div class="row rounded-top-4" style="height: 65px; background-color: rgb(59, 59, 59);">
                        <div class=" col-1 pt-2 ms-3">
                            @if ($groupChat->group_image == null)
                                <img src="{{ asset('image/defaultpic.jpg') }}" class="w-100 rounded-circle shadow-lg"
                                    alt="">
                            @else
                                <img src="{{ asset('storage/' . $groupChat->group_image) }}"
                                    class="w-100 rounded-circle shadow-lg" alt="">
                            @endif
                        </div>
                        <div class=" col-5 p-2">
                            <span class=" d-block text-white fs-5">{{ $groupChat->group_name }}</span>
                            <input type="hidden" id="groupID" value="{{ $groupChat->id }}">
                            @if (isset($groupChat->sec_user_id) && !isset($groupChat->a_user_id))
                                <small class=" text-white-50">3 members</small>
                            @endif
                            @if (isset($groupChat->a_user_id) && !isset($groupChat->b_user_id))
                                <small class=" text-white-50">4 members</small>
                            @endif
                            @if (isset($groupChat->b_user_id) && !isset($groupChat->c_user_id))
                                <small class=" text-white-50">5 members</small>
                            @endif
                            @if (isset($groupChat->c_user_id) && !isset($groupChat->d_user_id))
                                <small class=" text-white-50">6 members</small>
                            @endif
                            @if (isset($groupChat->d_user_id) && !isset($groupChat->e_user_id))
                                <small class=" text-white-50">7 members</small>
                            @endif
                            @if (isset($groupChat->e_user_id) && !isset($groupChat->f_user_id))
                                <small class=" text-white-50">8 members</small>
                            @endif
                            @if (isset($groupChat->f_user_id) && !isset($groupChat->g_user_id))
                                <small class=" text-white-50">9 members</small>
                            @endif
                            @if (isset($groupChat->g_user_id) && !isset($groupChat->h_user_id))
                                <small class=" text-white-50">10 members</small>
                            @endif
                            @if (isset($groupChat->h_user_id))
                                <small class=" text-white-50">11 members</small>
                            @endif
                        </div>
                        <div class=" offset-2 col-3 ps-5 py-3 text-end">
                            <div class="btn-group dropleft">
                                <div data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa-solid fa-circle-info fs-4 mt-2 text-white-50"></i>
                                </div>
                                <div class="dropdown-menu bg-dark">
                                    <div class=" text-white  border-bottom border-secondary text-center">
                                        {{-- Add Group Member --}}
                                        <!-- Button trigger modal-->
                                        <button type="button" class="btn btn-dark text-start" data-bs-toggle="modal"
                                            data-bs-target="#addMember">
                                            +Add Member
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- display message start  --}}
                <div class=" overflow-auto" id="scroll" style=" height: 80%; -webkit-overflow-scrolling: none">
                    @foreach ($message as $m)
                        @if (Auth::user()->id == $m->user_id)
                            <div class="offset-6 col-6">
                                @if ($m->text == null && $m->image == null)
                                    <div class="clickToReply">
                                        <div
                                            class=" form-control rounded-5 border-1 border-secondary  bg-secondary p-1 mt-4 text-white-50 text-end d-inline-block pe-4 shadow">
                                            You removed message
                                            <div class=" text-start ps-3 text-white-50">
                                                {{ $m->created_at->format('H:i A') }}
                                            </div>
                                        </div>
                                        <div class="reply" style=" display:none">
                                            <a href="{{ route('group#groupChatMessageDeletePar', $m->chat_code) }}"><i
                                                    class="fa-solid fa-trash  opacity-50 text-dark"></i></a>
                                        </div>
                                    </div>
                                @else
                                    @if ($m->image == null)
                                        <div class="clickToReply">
                                            <div
                                                class="form-control rounded-5 bg-dark border-0 p-1 mt-4 text-white text-end d-inline-block pe-4 shadow">
                                                @if ($m->reply_chat_code != null)
                                                    <div class=" opacity-25 text-start ms-3 border-bottom border-2"><i
                                                            class="fa-solid fa-reply pe-2 pt-3 text-white-50"></i>
                                                        @foreach ($message as $mg)
                                                            @if ($mg->chat_code == $m->reply_chat_code)
                                                                @if ($mg->text != null)
                                                                    {{ $mg->text }}
                                                                @else
                                                                    <span class=" text-danger">Deleted Message</span>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                @endif
                                                {{ $m->text }}
                                                <div class=" text-start ps-3 text-white-50">
                                                    @if (
                                                        $m->fir_status == 'seen' ||
                                                            $m->sec_status == 'seen' ||
                                                            $m->a_status == 'seen' ||
                                                            $m->b_status == 'seen' ||
                                                            $m->c_status == 'seen' ||
                                                            $m->d_status == 'seen' ||
                                                            $m->e_status == 'seen' ||
                                                            $m->f_status == 'seen' ||
                                                            $m->g_status == 'seen' ||
                                                            $m->h_status == 'seen')
                                                        <i class="fa-solid fa-circle-check px-2"></i>
                                                        {{ $m->created_at->format('H:i A') }}
                                                    @else
                                                        <i class="fa-regular fa-circle-check px-2"></i>
                                                        {{ $m->created_at->format('H:i A') }}
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="reply row" style=" display:none">
                                                <div class=" col-2">
                                                    <a
                                                        href="{{ route('group#groupChatMessageReply', $m->chat_code) }}"><i
                                                            class="fa-solid fa-reply  opacity-50 text-dark"></i></a>
                                                    <a
                                                        href="{{ route('group#groupChatMessageDelete', $m->chat_code) }}"><i
                                                            class="fa-solid fa-trash  opacity-50 text-dark"></i></a>
                                                </div>
                                                @if ($groupChat->user_id == Auth::user()->id)
                                                    @if (
                                                        $m->fir_status == 'seen' ||
                                                            $m->sec_status == 'seen' ||
                                                            $m->a_status == 'seen' ||
                                                            $m->b_status == 'seen' ||
                                                            $m->c_status == 'seen' ||
                                                            $m->d_status == 'seen' ||
                                                            $m->e_status == 'seen' ||
                                                            $m->f_status == 'seen' ||
                                                            $m->g_status == 'seen' ||
                                                            $m->h_status == 'seen')
                                                        <div class=" col text-end">
                                                            Seen By
                                                            @if ($m->fir_status == 'seen')
                                                                <small>{{ $firUser->name }},</small>
                                                            @endif
                                                            @if ($m->sec_status == 'seen')
                                                                <small>{{ $secUser->name }},</small>
                                                            @endif
                                                            @if ($m->a_status == 'seen')
                                                                <small>{{ $aUser->name }},</small>
                                                            @endif
                                                            @if ($m->b_status == 'seen')
                                                                <small>{{ $bUser->name }},</small>
                                                            @endif
                                                            @if ($m->c_status == 'seen')
                                                                <small>{{ $cUser->name }},</small>
                                                            @endif
                                                            @if ($m->d_status == 'seen')
                                                                <small>{{ $dUser->name }},</small>
                                                            @endif
                                                            @if ($m->e_status == 'seen')
                                                                <small>{{ $eUser->name }},</small>
                                                            @endif
                                                            @if ($m->f_status == 'seen')
                                                                <small>{{ $fUser->name }},</small>
                                                            @endif
                                                            @if ($m->g_status == 'seen')
                                                                <small>{{ $gUser->name }},</small>
                                                            @endif
                                                            @if ($m->h_status == 'seen')
                                                                <small>{{ $hUser->name }}</small>
                                                            @endif
                                                        </div>
                                                    @else
                                                    @endif
                                                @else
                                                @endif
                                            </div>
                                        </div>
                                    @else
                                        @if ($m->text == null)
                                            <div class="clickToReply">
                                                <div class=" mt-4">
                                                    @if ($m->reply_chat_code != null)
                                                        <div class=" opacity-50 text-start ms-3 rounded-5 border-2"><i
                                                                class="fa-solid fa-reply pe-2 pt-3"></i>
                                                            @foreach ($message as $mg)
                                                                @if ($mg->chat_code == $m->reply_chat_code)
                                                                    @if ($mg->text != null)
                                                                        {{ $mg->text }}
                                                                    @else
                                                                        <span class=" text-danger">Deleted
                                                                            Message</span>
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                    <div class=" position-relative">
                                                        <div class=" position-absolute bottom-0 text-white-50">
                                                            @if (
                                                                $m->fir_status == 'seen' ||
                                                                    $m->sec_status == 'seen' ||
                                                                    $m->a_status == 'seen' ||
                                                                    $m->b_status == 'seen' ||
                                                                    $m->c_status == 'seen' ||
                                                                    $m->d_status == 'seen' ||
                                                                    $m->e_status == 'seen' ||
                                                                    $m->f_status == 'seen' ||
                                                                    $m->g_status == 'seen' ||
                                                                    $m->h_status == 'seen')
                                                                <i class="fa-solid fa-circle-check px-2 mb-2 ms-2"></i>
                                                                {{ $m->created_at->format('H:i A') }}
                                                            @else
                                                                <i
                                                                    class="fa-regular fa-circle-check px-2 mb-2 ms-2"></i>
                                                                {{ $m->created_at->format('H:i A') }}
                                                            @endif
                                                        </div>
                                                        <img src="{{ asset('storage/' . $m->image) }}"
                                                            class=" w-100 rounded-4 shadow-lg" alt="">
                                                    </div>
                                                </div>
                                                <div class="reply row" style=" display:none">
                                                    <div class=" col-2">
                                                        <a
                                                            href="{{ route('group#groupChatMessageReply', $m->chat_code) }}"><i
                                                                class="fa-solid fa-reply  opacity-50 text-dark"></i></a>
                                                        <a
                                                            href="{{ route('group#groupChatMessageDelete', $m->chat_code) }}"><i
                                                                class="fa-solid fa-trash  opacity-50 text-dark"></i></a>
                                                    </div>
                                                    @if ($groupChat->user_id == Auth::user()->id)
                                                        @if (
                                                            $m->fir_status == 'seen' ||
                                                                $m->sec_status == 'seen' ||
                                                                $m->a_status == 'seen' ||
                                                                $m->b_status == 'seen' ||
                                                                $m->c_status == 'seen' ||
                                                                $m->d_status == 'seen' ||
                                                                $m->e_status == 'seen' ||
                                                                $m->f_status == 'seen' ||
                                                                $m->g_status == 'seen' ||
                                                                $m->h_status == 'seen')
                                                            <div class=" col text-end">
                                                                Seen By
                                                                @if ($m->fir_status == 'seen')
                                                                    <small>{{ $firUser->name }},</small>
                                                                @endif
                                                                @if ($m->sec_status == 'seen')
                                                                    <small>{{ $secUser->name }},</small>
                                                                @endif
                                                                @if ($m->a_status == 'seen')
                                                                    <small>{{ $aUser->name }},</small>
                                                                @endif
                                                                @if ($m->b_status == 'seen')
                                                                    <small>{{ $bUser->name }},</small>
                                                                @endif
                                                                @if ($m->c_status == 'seen')
                                                                    <small>{{ $cUser->name }},</small>
                                                                @endif
                                                                @if ($m->d_status == 'seen')
                                                                    <small>{{ $dUser->name }},</small>
                                                                @endif
                                                                @if ($m->e_status == 'seen')
                                                                    <small>{{ $eUser->name }},</small>
                                                                @endif
                                                                @if ($m->f_status == 'seen')
                                                                    <small>{{ $fUser->name }},</small>
                                                                @endif
                                                                @if ($m->g_status == 'seen')
                                                                    <small>{{ $gUser->name }},</small>
                                                                @endif
                                                                @if ($m->h_status == 'seen')
                                                                    <small>{{ $hUser->name }}</small>
                                                                @endif
                                                            </div>
                                                        @else
                                                        @endif
                                                    @else
                                                    @endif
                                                </div>
                                            </div>
                                        @else
                                            <div class="clickToReply">
                                                <div
                                                    class="form-control rounded-5 bg-dark border-0 p-1 mt-4 text-white text-end d-inline-block pe-4 shadow">
                                                    @if ($m->reply_chat_code != null)
                                                        <div
                                                            class=" opacity-25 text-start ms-3 border-bottom border-2">
                                                            <i class="fa-solid fa-reply pe-2 pt-3 text-white-50"></i>
                                                            @foreach ($message as $mg)
                                                                @if ($mg->chat_code == $m->reply_chat_code)
                                                                    @if ($mg->text != null)
                                                                        {{ $mg->text }}
                                                                    @else
                                                                        <span class=" text-danger">Deleted
                                                                            Message</span>
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                    {{ $m->text }}
                                                    <div class=" text-start ps-3 text-white-50">
                                                        @if (
                                                            $m->fir_status == 'seen' ||
                                                                $m->sec_status == 'seen' ||
                                                                $m->a_status == 'seen' ||
                                                                $m->b_status == 'seen' ||
                                                                $m->c_status == 'seen' ||
                                                                $m->d_status == 'seen' ||
                                                                $m->e_status == 'seen' ||
                                                                $m->f_status == 'seen' ||
                                                                $m->g_status == 'seen' ||
                                                                $m->h_status == 'seen')
                                                            <i class="fa-solid fa-circle-check px-2"></i>
                                                            {{ $m->created_at->format('H:i A') }}
                                                        @else
                                                            <i class="fa-regular fa-circle-check px-2"></i>
                                                            {{ $m->created_at->format('H:i A') }}
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class=" position-relative">
                                                    <div class=" position-absolute bottom-0 text-white-50">
                                                        @if (
                                                            $m->fir_status == 'seen' ||
                                                                $m->sec_status == 'seen' ||
                                                                $m->a_status == 'seen' ||
                                                                $m->b_status == 'seen' ||
                                                                $m->c_status == 'seen' ||
                                                                $m->d_status == 'seen' ||
                                                                $m->e_status == 'seen' ||
                                                                $m->f_status == 'seen' ||
                                                                $m->g_status == 'seen' ||
                                                                $m->h_status == 'seen')
                                                            <i class="fa-solid fa-circle-check px-2 mb-2 ms-2"></i>
                                                            {{ $m->created_at->format('H:i A') }}
                                                        @else
                                                            <i class="fa-regular fa-circle-check px-2 mb-2 ms-2"></i>
                                                            {{ $m->created_at->format('H:i A') }}
                                                        @endif
                                                    </div>
                                                    <img src="{{ asset('storage/' . $m->image) }}"
                                                        class=" w-100 rounded-4 shadow-lg" alt="">
                                                </div>
                                                <div class="reply row" style=" display:none">
                                                    <div class="col-2">
                                                        <a
                                                            href="{{ route('group#groupChatMessageReply', $m->chat_code) }}"><i
                                                                class="fa-solid fa-reply  opacity-50 text-dark"></i></a>
                                                        <a
                                                            href="{{ route('group#groupChatMessageDelete', $m->chat_code) }}"><i
                                                                class="fa-solid fa-trash  opacity-50 text-dark"></i></a>
                                                    </div>
                                                    @if ($groupChat->user_id == Auth::user()->id)
                                                        @if (
                                                            $m->fir_status == 'seen' ||
                                                                $m->sec_status == 'seen' ||
                                                                $m->a_status == 'seen' ||
                                                                $m->b_status == 'seen' ||
                                                                $m->c_status == 'seen' ||
                                                                $m->d_status == 'seen' ||
                                                                $m->e_status == 'seen' ||
                                                                $m->f_status == 'seen' ||
                                                                $m->g_status == 'seen' ||
                                                                $m->h_status == 'seen')
                                                            <div class=" col text-end">
                                                                Seen By
                                                                @if ($m->fir_status == 'seen')
                                                                    <small>{{ $firUser->name }},</small>
                                                                @endif
                                                                @if ($m->sec_status == 'seen')
                                                                    <small>{{ $secUser->name }},</small>
                                                                @endif
                                                                @if ($m->a_status == 'seen')
                                                                    <small>{{ $aUser->name }},</small>
                                                                @endif
                                                                @if ($m->b_status == 'seen')
                                                                    <small>{{ $bUser->name }},</small>
                                                                @endif
                                                                @if ($m->c_status == 'seen')
                                                                    <small>{{ $cUser->name }},</small>
                                                                @endif
                                                                @if ($m->d_status == 'seen')
                                                                    <small>{{ $dUser->name }},</small>
                                                                @endif
                                                                @if ($m->e_status == 'seen')
                                                                    <small>{{ $eUser->name }},</small>
                                                                @endif
                                                                @if ($m->f_status == 'seen')
                                                                    <small>{{ $fUser->name }},</small>
                                                                @endif
                                                                @if ($m->g_status == 'seen')
                                                                    <small>{{ $gUser->name }},</small>
                                                                @endif
                                                                @if ($m->h_status == 'seen')
                                                                    <small>{{ $hUser->name }}</small>
                                                                @endif
                                                            </div>
                                                        @else
                                                        @endif
                                                    @else
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                @endif
                            </div>
                        @elseif (
                            $m->user_id != $m->fir_user_id ||
                                $m->user_id == $m->fir_user_id ||
                                Auth::user()->id == $m->fir_user_id ||
                                Auth::user()->id == $m->sec_user_id ||
                                Auth::user()->id == $m->a_user_id ||
                                Auth::user()->id == $m->b_user_id ||
                                Auth::user()->id == $m->c_user_id ||
                                Auth::user()->id == $m->d_user_id ||
                                Auth::user()->id == $m->e_user_id ||
                                Auth::user()->id == $m->f_user_id ||
                                Auth::user()->id == $m->g_user_id ||
                                Auth::user()->id == $m->h_user_id)
                            <div class="col-7 row">

                                @if ($user != null && $m->user_id == $user->id)
                                    <div class=" col-2 pt-4">
                                        @if ($user->image == null)
                                            <img src="{{ asset('image/defaultpic.jpg') }}"
                                                class="w-100 rounded-circle shadow-lg" alt="">
                                        @else
                                            <img src="{{ asset('storage/' . $user->image) }}"
                                                class="w-100 rounded-circle shadow-lg" alt="">
                                        @endif
                                    </div>
                                @endif

                                @if ($firUser != null && $m->user_id == $firUser->id)
                                    <div class=" col-2 pt-4">
                                        @if ($firUser->image == null)
                                            <img src="{{ asset('image/defaultpic.jpg') }}"
                                                class="w-100 rounded-circle shadow-lg" alt="">
                                        @else
                                            <img src="{{ asset('storage/' . $firUser->image) }}"
                                                class="w-100 rounded-circle shadow-lg" alt="">
                                        @endif
                                    </div>
                                @endif

                                @if ($secUser != null && $m->user_id == $secUser->id)
                                    <div class=" col-2 pt-4">
                                        @if ($secUser->image == null)
                                            <img src="{{ asset('image/defaultpic.jpg') }}"
                                                class="w-100 rounded-circle shadow-lg" alt="">
                                        @else
                                            <img src="{{ asset('storage/' . $secUser->image) }}"
                                                class="w-100 rounded-circle shadow-lg" alt="">
                                        @endif
                                    </div>
                                @endif

                                @if ($aUser != null && $m->user_id == $aUser->id)
                                    <div class=" col-2 pt-4">
                                        @if ($aUser->image == null)
                                            <img src="{{ asset('image/defaultpic.jpg') }}"
                                                class="w-100 rounded-circle shadow-lg" alt="">
                                        @else
                                            <img src="{{ asset('storage/' . $aUser->image) }}"
                                                class="w-100 rounded-circle shadow-lg" alt="">
                                        @endif
                                    </div>
                                @endif

                                @if ($bUser != null && $m->user_id == $bUser->id)
                                    <div class=" col-2 pt-4">
                                        @if ($bUser->image == null)
                                            <img src="{{ asset('image/defaultpic.jpg') }}"
                                                class="w-100 rounded-circle shadow-lg" alt="">
                                        @else
                                            <img src="{{ asset('storage/' . $bUser->image) }}"
                                                class="w-100 rounded-circle shadow-lg" alt="">
                                        @endif
                                    </div>
                                @endif

                                @if ($cUser != null && $m->user_id == $cUser->id)
                                    <div class=" col-2 pt-4">
                                        @if ($cUser->image == null)
                                            <img src="{{ asset('image/defaultpic.jpg') }}"
                                                class="w-100 rounded-circle shadow-lg" alt="">
                                        @else
                                            <img src="{{ asset('storage/' . $cUser->image) }}"
                                                class="w-100 rounded-circle shadow-lg" alt="">
                                        @endif
                                    </div>
                                @endif

                                @if ($dUser != null && $m->user_id == $dUser->id)
                                    <div class=" col-2 pt-4">
                                        @if ($dUser->image == null)
                                            <img src="{{ asset('image/defaultpic.jpg') }}"
                                                class="w-100 rounded-circle shadow-lg" alt="">
                                        @else
                                            <img src="{{ asset('storage/' . $dUser->image) }}"
                                                class="w-100 rounded-circle shadow-lg" alt="">
                                        @endif
                                    </div>
                                @endif

                                @if ($eUser != null && $m->user_id == $eUser->id)
                                    <div class=" col-2 pt-4">
                                        @if ($eUser->image == null)
                                            <img src="{{ asset('image/defaultpic.jpg') }}"
                                                class="w-100 rounded-circle shadow-lg" alt="">
                                        @else
                                            <img src="{{ asset('storage/' . $eUser->image) }}"
                                                class="w-100 rounded-circle shadow-lg" alt="">
                                        @endif
                                    </div>
                                @endif

                                @if ($fUser != null && $m->user_id == $fUser->id)
                                    <div class=" col-2 pt-4">
                                        @if ($fUser->image == null)
                                            <img src="{{ asset('image/defaultpic.jpg') }}"
                                                class="w-100 rounded-circle shadow-lg" alt="">
                                        @else
                                            <img src="{{ asset('storage/' . $fUser->image) }}"
                                                class="w-100 rounded-circle shadow-lg" alt="">
                                        @endif
                                    </div>
                                @endif

                                @if ($gUser != null && $m->user_id == $gUser->id)
                                    <div class=" col-2 pt-4">
                                        @if ($gUser->image == null)
                                            <img src="{{ asset('image/defaultpic.jpg') }}"
                                                class="w-100 rounded-circle shadow-lg" alt="">
                                        @else
                                            <img src="{{ asset('storage/' . $gUser->image) }}"
                                                class="w-100 rounded-circle shadow-lg" alt="">
                                        @endif
                                    </div>
                                @endif

                                @if ($hUser != null && $m->user_id == $hUser->id)
                                    <div class=" col-2 pt-4">
                                        @if ($hUser->image == null)
                                            <img src="{{ asset('image/defaultpic.jpg') }}"
                                                class="w-100 rounded-circle shadow-lg" alt="">
                                        @else
                                            <img src="{{ asset('storage/' . $hUser->image) }}"
                                                class="w-100 rounded-circle shadow-lg" alt="">
                                        @endif
                                    </div>
                                @endif

                                @if ($m->text == null && $m->image == null)
                                    <div class=" col">
                                        @if ($user != null && $m->user_id == $user->id)
                                            <div
                                                class="  form-control rounded-5 border-1 border-secondary  bg-secondary p-1 mt-4 text-white-50 text-start d-inline-block ps-4 shadow">
                                                {{ $user->name }} removed message
                                                <div class=" text-end pe-3 text-white-50">
                                                    {{ $m->created_at->format('H:i A') }}
                                                </div>
                                            </div>
                                        @endif

                                        @if ($firUser != null && $m->user_id == $firUser->id)
                                            <div
                                                class="  form-control rounded-5 border-1 border-secondary  bg-secondary p-1 mt-4 text-white-50 text-start d-inline-block ps-4 shadow">
                                                {{ $firUser->name }} removed message
                                                <div class=" text-end pe-3 text-white-50">
                                                    {{ $m->created_at->format('H:i A') }}
                                                </div>
                                            </div>
                                        @endif

                                        @if ($secUser != null && $m->user_id == $secUser->id)
                                            <div
                                                class="  form-control rounded-5 border-1 border-secondary  bg-secondary p-1 mt-4 text-white-50 text-start d-inline-block ps-4 shadow">
                                                {{ $secUser->name }} removed message
                                                <div class=" text-end pe-3 text-white-50">
                                                    {{ $m->created_at->format('H:i A') }}
                                                </div>
                                            </div>
                                        @endif

                                        @if ($aUser != null && $m->user_id == $aUser->id)
                                            <div
                                                class="  form-control rounded-5 border-1 border-secondary  bg-secondary p-1 mt-4 text-white-50 text-start d-inline-block ps-4 shadow">
                                                {{ $aUser->name }} removed message
                                                <div class=" text-end pe-3 text-white-50">
                                                    {{ $m->created_at->format('H:i A') }}
                                                </div>
                                            </div>
                                        @endif

                                        @if ($bUser != null && $m->user_id == $aUser->id)
                                            <div
                                                class="  form-control rounded-5 border-1 border-secondary  bg-secondary p-1 mt-4 text-white-50 text-start d-inline-block ps-4 shadow">
                                                {{ $bUser->name }} removed message
                                                <div class=" text-end pe-3 text-white-50">
                                                    {{ $m->created_at->format('H:i A') }}
                                                </div>
                                            </div>
                                        @endif

                                        @if ($cUser != null && $m->user_id == $aUser->id)
                                            <div
                                                class="  form-control rounded-5 border-1 border-secondary  bg-secondary p-1 mt-4 text-white-50 text-start d-inline-block ps-4 shadow">
                                                {{ $cUser->name }} removed message
                                                <div class=" text-end pe-3 text-white-50">
                                                    {{ $m->created_at->format('H:i A') }}
                                                </div>
                                            </div>
                                        @endif

                                        @if ($dUser != null && $m->user_id == $aUser->id)
                                            <div
                                                class="  form-control rounded-5 border-1 border-secondary  bg-secondary p-1 mt-4 text-white-50 text-start d-inline-block ps-4 shadow">
                                                {{ $dUser->name }} removed message
                                                <div class=" text-end pe-3 text-white-50">
                                                    {{ $m->created_at->format('H:i A') }}
                                                </div>
                                            </div>
                                        @endif

                                        @if ($eUser != null && $m->user_id == $aUser->id)
                                            <div
                                                class="  form-control rounded-5 border-1 border-secondary  bg-secondary p-1 mt-4 text-white-50 text-start d-inline-block ps-4 shadow">
                                                {{ $eUser->name }} removed message
                                                <div class=" text-end pe-3 text-white-50">
                                                    {{ $m->created_at->format('H:i A') }}
                                                </div>
                                            </div>
                                        @endif

                                        @if ($fUser != null && $m->user_id == $aUser->id)
                                            <div
                                                class="  form-control rounded-5 border-1 border-secondary  bg-secondary p-1 mt-4 text-white-50 text-start d-inline-block ps-4 shadow">
                                                {{ $fUser->name }} removed message
                                                <div class=" text-end pe-3 text-white-50">
                                                    {{ $m->created_at->format('H:i A') }}
                                                </div>
                                            </div>
                                        @endif

                                        @if ($gUser != null && $m->user_id == $aUser->id)
                                            <div
                                                class="  form-control rounded-5 border-1 border-secondary  bg-secondary p-1 mt-4 text-white-50 text-start d-inline-block ps-4 shadow">
                                                {{ $gUser->name }} removed message
                                                <div class=" text-end pe-3 text-white-50">
                                                    {{ $m->created_at->format('H:i A') }}
                                                </div>
                                            </div>
                                        @endif

                                        @if ($hUser != null && $m->user_id == $aUser->id)
                                            <div
                                                class="  form-control rounded-5 border-1 border-secondary  bg-secondary p-1 mt-4 text-white-50 text-start d-inline-block ps-4 shadow">
                                                {{ $hUser->name }} removed message
                                                <div class=" text-end pe-3 text-white-50">
                                                    {{ $m->created_at->format('H:i A') }}
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @else
                                    @if ($m->image == null)
                                        <div class="clickToReply col">

                                            @if ($user != null && $m->user_id == $user->id)
                                                <small class=" text-white-50 ps-4">{{ $user->name }}</small>
                                            @endif

                                            @if ($firUser != null && $m->user_id == $firUser->id)
                                                <small class=" text-white-50 ps-4">{{ $firUser->name }}</small>
                                            @endif

                                            @if ($secUser != null && $m->user_id == $secUser->id)
                                                <small class=" text-white-50 ps-4">{{ $secUser->name }}</small>
                                            @endif

                                            @if ($aUser != null && $m->user_id == $aUser->id)
                                                <small class=" text-white-50 ps-4">{{ $aUser->name }}</small>
                                            @endif

                                            @if ($bUser != null && $m->user_id == $bUser->id)
                                                <small class=" text-white-50 ps-4">{{ $bUser->name }}</small>
                                            @endif

                                            @if ($cUser != null && $m->user_id == $cUser->id)
                                                <small class=" text-white-50 ps-4">{{ $cUser->name }}</small>
                                            @endif

                                            @if ($dUser != null && $m->user_id == $dUser->id)
                                                <small class=" text-white-50 ps-4">{{ $dUser->name }}</small>
                                            @endif

                                            @if ($eUser != null && $m->user_id == $eUser->id)
                                                <small class=" text-white-50 ps-4">{{ $eUser->name }}</small>
                                            @endif

                                            @if ($fUser != null && $m->user_id == $fUser->id)
                                                <small class=" text-white-50 ps-4">{{ $fUser->name }}</small>
                                            @endif

                                            @if ($gUser != null && $m->user_id == $gUser->id)
                                                <small class=" text-white-50 ps-4">{{ $gUser->name }}</small>
                                            @endif

                                            @if ($hUser != null && $m->user_id == $hUser->id)
                                                <small class=" text-white-50 ps-4">{{ $hUser->name }}</small>
                                            @endif

                                            <div
                                                class=" form-control rounded-5 bg-dark border-0 p-1  text-white text-start d-inline-block ps-4 shadow">
                                                @if ($m->reply_chat_code != null)
                                                    <div class=" opacity-25 text-end me-3 border-bottom border-2">
                                                        @foreach ($message as $mg)
                                                            @if ($mg->chat_code == $m->reply_chat_code)
                                                                @if ($mg->text != null)
                                                                    {{ $mg->text }}
                                                                @else
                                                                    <span class=" text-danger">Deleted Message</span>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                        <i class="fa-solid fa-reply pe-2 pt-3 text-white-50"></i>
                                                    </div>
                                                @endif
                                                {{ $m->text }}
                                                <div class=" text-end pe-3 text-white-50">
                                                    {{ $m->created_at->format('H:i A') }}
                                                </div>
                                            </div>
                                            <div class="reply row" style=" display:none">

                                                @if ($groupChat->user_id == Auth::user()->id)
                                                    @if (
                                                        $m->fir_status == 'seen' ||
                                                            $m->sec_status == 'seen' ||
                                                            $m->a_status == 'seen' ||
                                                            $m->b_status == 'seen' ||
                                                            $m->c_status == 'seen' ||
                                                            $m->d_status == 'seen' ||
                                                            $m->e_status == 'seen' ||
                                                            $m->f_status == 'seen' ||
                                                            $m->g_status == 'seen' ||
                                                            $m->h_status == 'seen')
                                                        <div class=" col text-start">
                                                            Seen By
                                                            @if ($m->fir_status == 'seen')
                                                                <small>{{ $firUser->name }},</small>
                                                            @endif
                                                            @if ($m->sec_status == 'seen')
                                                                <small>{{ $secUser->name }},</small>
                                                            @endif
                                                            @if ($m->a_status == 'seen')
                                                                <small>{{ $aUser->name }},</small>
                                                            @endif
                                                            @if ($m->b_status == 'seen')
                                                                <small>{{ $bUser->name }},</small>
                                                            @endif
                                                            @if ($m->c_status == 'seen')
                                                                <small>{{ $cUser->name }},</small>
                                                            @endif
                                                            @if ($m->d_status == 'seen')
                                                                <small>{{ $dUser->name }},</small>
                                                            @endif
                                                            @if ($m->e_status == 'seen')
                                                                <small>{{ $eUser->name }},</small>
                                                            @endif
                                                            @if ($m->f_status == 'seen')
                                                                <small>{{ $fUser->name }},</small>
                                                            @endif
                                                            @if ($m->g_status == 'seen')
                                                                <small>{{ $gUser->name }},</small>
                                                            @endif
                                                            @if ($m->h_status == 'seen')
                                                                <small>{{ $hUser->name }}</small>
                                                            @endif
                                                        </div>
                                                    @else
                                                    @endif
                                                @else
                                                <div class=" col"></div>
                                                @endif
                                                <div class="  col-2 text-end">
                                                    <a
                                                        href="{{ route('group#groupChatMessageReply', $m->chat_code) }}"><i
                                                            class="fa-solid fa-reply  opacity-50 text-dark"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        @if ($m->text == null)
                                            <div class="col clickToReply">
                                                @if ($user != null && $m->user_id == $user->id)
                                                <small class=" text-white-50 ps-4">{{ $user->name }}</small>
                                            @endif

                                            @if ($firUser != null && $m->user_id == $firUser->id)
                                                <small class=" text-white-50 ps-4">{{ $firUser->name }}</small>
                                            @endif

                                            @if ($secUser != null && $m->user_id == $secUser->id)
                                                <small class=" text-white-50 ps-4">{{ $secUser->name }}</small>
                                            @endif

                                            @if ($aUser != null && $m->user_id == $aUser->id)
                                                <small class=" text-white-50 ps-4">{{ $aUser->name }}</small>
                                            @endif

                                            @if ($bUser != null && $m->user_id == $bUser->id)
                                                <small class=" text-white-50 ps-4">{{ $bUser->name }}</small>
                                            @endif

                                            @if ($cUser != null && $m->user_id == $cUser->id)
                                                <small class=" text-white-50 ps-4">{{ $cUser->name }}</small>
                                            @endif

                                            @if ($dUser != null && $m->user_id == $dUser->id)
                                                <small class=" text-white-50 ps-4">{{ $dUser->name }}</small>
                                            @endif

                                            @if ($eUser != null && $m->user_id == $eUser->id)
                                                <small class=" text-white-50 ps-4">{{ $eUser->name }}</small>
                                            @endif

                                            @if ($fUser != null && $m->user_id == $fUser->id)
                                                <small class=" text-white-50 ps-4">{{ $fUser->name }}</small>
                                            @endif

                                            @if ($gUser != null && $m->user_id == $gUser->id)
                                                <small class=" text-white-50 ps-4">{{ $gUser->name }}</small>
                                            @endif

                                            @if ($hUser != null && $m->user_id == $hUser->id)
                                                <small class=" text-white-50 ps-4">{{ $hUser->name }}</small>
                                            @endif

                                                    @if ($m->reply_chat_code != null)
                                                        <div class=" opacity-50 text-end me-3 rounded-5 border-2">
                                                            @foreach ($message as $mg)
                                                                @if ($mg->chat_code == $m->reply_chat_code)
                                                                    @if ($mg->text != null)
                                                                        {{ $mg->text }}
                                                                    @else
                                                                        <span class=" text-danger">Deleted
                                                                            Message</span>
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                            <i class="fa-solid fa-reply pe-2 pt-3"></i>
                                                        </div>
                                                    @endif
                                                    <img src="{{ asset('storage/' . $m->image) }}"
                                                        class="w-100  rounded-4 shadow-lg" alt="">

                                                <div class="reply row " style=" display:none">
                                                    @if ($groupChat->user_id == Auth::user()->id)
                                                        @if (
                                                            $m->fir_status == 'seen' ||
                                                                $m->sec_status == 'seen' ||
                                                                $m->a_status == 'seen' ||
                                                                $m->b_status == 'seen' ||
                                                                $m->c_status == 'seen' ||
                                                                $m->d_status == 'seen' ||
                                                                $m->e_status == 'seen' ||
                                                                $m->f_status == 'seen' ||
                                                                $m->g_status == 'seen' ||
                                                                $m->h_status == 'seen')
                                                            <div class=" col text-start">
                                                                Seen By
                                                                @if ($m->fir_status == 'seen')
                                                                    <small>{{ $firUser->name }},</small>
                                                                @endif
                                                                @if ($m->sec_status == 'seen')
                                                                    <small>{{ $secUser->name }},</small>
                                                                @endif
                                                                @if ($m->a_status == 'seen')
                                                                    <small>{{ $aUser->name }},</small>
                                                                @endif
                                                                @if ($m->b_status == 'seen')
                                                                    <small>{{ $bUser->name }},</small>
                                                                @endif
                                                                @if ($m->c_status == 'seen')
                                                                    <small>{{ $cUser->name }},</small>
                                                                @endif
                                                                @if ($m->d_status == 'seen')
                                                                    <small>{{ $dUser->name }},</small>
                                                                @endif
                                                                @if ($m->e_status == 'seen')
                                                                    <small>{{ $eUser->name }},</small>
                                                                @endif
                                                                @if ($m->f_status == 'seen')
                                                                    <small>{{ $fUser->name }},</small>
                                                                @endif
                                                                @if ($m->g_status == 'seen')
                                                                    <small>{{ $gUser->name }},</small>
                                                                @endif
                                                                @if ($m->h_status == 'seen')
                                                                    <small>{{ $hUser->name }}</small>
                                                                @endif
                                                            </div>
                                                        @else
                                                        @endif
                                                    @else
                                                <div class=" col"></div>
                                                    @endif
                                                    <div class=" col-2 text-end">
                                                        <a
                                                            href="{{ route('group#groupChatMessageReply', $m->chat_code) }}"><i
                                                                class="fa-solid fa-reply  opacity-50 text-dark"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="clickToReply col">
                                                @if ($user != null && $m->user_id == $user->id)
                                                <small class=" text-white-50 ps-4">{{ $user->name }}</small>
                                            @endif

                                            @if ($firUser != null && $m->user_id == $firUser->id)
                                                <small class=" text-white-50 ps-4">{{ $firUser->name }}</small>
                                            @endif

                                            @if ($secUser != null && $m->user_id == $secUser->id)
                                                <small class=" text-white-50 ps-4">{{ $secUser->name }}</small>
                                            @endif

                                            @if ($aUser != null && $m->user_id == $aUser->id)
                                                <small class=" text-white-50 mt-4 ps-4">{{ $aUser->name }}</small>
                                            @endif

                                            @if ($bUser != null && $m->user_id == $bUser->id)
                                                <small class=" text-white-50 mt-4 ps-4">{{ $bUser->name }}</small>
                                            @endif

                                            @if ($cUser != null && $m->user_id == $cUser->id)
                                                <small class=" text-white-50 mt-4 ps-4">{{ $cUser->name }}</small>
                                            @endif

                                            @if ($dUser != null && $m->user_id == $dUser->id)
                                                <small class=" text-white-50 mt-4 ps-4">{{ $dUser->name }}</small>
                                            @endif

                                            @if ($eUser != null && $m->user_id == $eUser->id)
                                                <small class=" text-white-50 mt-4 ps-4">{{ $eUser->name }}</small>
                                            @endif

                                            @if ($fUser != null && $m->user_id == $fUser->id)
                                                <small class=" text-white-50 mt-4 ps-4">{{ $fUser->name }}</small>
                                            @endif

                                            @if ($gUser != null && $m->user_id == $gUser->id)
                                                <small class=" text-white-50 mt-4 ps-4">{{ $gUser->name }}</small>
                                            @endif

                                            @if ($hUser != null && $m->user_id == $hUser->id)
                                                <small class=" text-white-50 mt-4 ps-4">{{ $hUser->name }}</small>
                                            @endif
                                                <div
                                                    class=" form-control rounded-5 bg-dark border-0 p-1 text-white text-start d-inline-block ps-4 shadow">
                                                    @if ($m->reply_chat_code != null)
                                                        <div class=" opacity-25 text-end me-3 border-bottom border-2">
                                                            @foreach ($message as $mg)
                                                                @if ($mg->chat_code == $m->reply_chat_code)
                                                                    @if ($mg->text != null)
                                                                        {{ $mg->text }}
                                                                    @else
                                                                        <span class=" text-danger">Deleted
                                                                            Message</span>
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                            <i class="fa-solid fa-reply pe-2 pt-3 text-white-50"></i>
                                                        </div>
                                                    @endif
                                                    {{ $m->text }}
                                                    <div class=" text-end pe-3 text-white-50">
                                                        {{ $m->created_at->format('H:i A') }}
                                                    </div>
                                                </div>
                                                <div class=" offset-2">
                                                    <img src="{{ asset('storage/' . $m->image) }}"
                                                        class="w-100 mt-1 rounded-4 shadow-lg" alt="">
                                                </div>
                                                <div class="reply row" style=" display:none">
                                                    @if ($groupChat->user_id == Auth::user()->id)
                                                        @if (
                                                            $m->fir_status == 'seen' ||
                                                                $m->sec_status == 'seen' ||
                                                                $m->a_status == 'seen' ||
                                                                $m->b_status == 'seen' ||
                                                                $m->c_status == 'seen' ||
                                                                $m->d_status == 'seen' ||
                                                                $m->e_status == 'seen' ||
                                                                $m->f_status == 'seen' ||
                                                                $m->g_status == 'seen' ||
                                                                $m->h_status == 'seen')
                                                            <div class=" col text-start">
                                                                Seen By
                                                                @if ($m->fir_status == 'seen')
                                                                    <small>{{ $firUser->name }},</small>
                                                                @endif
                                                                @if ($m->sec_status == 'seen')
                                                                    <small>{{ $secUser->name }},</small>
                                                                @endif
                                                                @if ($m->a_status == 'seen')
                                                                    <small>{{ $aUser->name }},</small>
                                                                @endif
                                                                @if ($m->b_status == 'seen')
                                                                    <small>{{ $bUser->name }},</small>
                                                                @endif
                                                                @if ($m->c_status == 'seen')
                                                                    <small>{{ $cUser->name }},</small>
                                                                @endif
                                                                @if ($m->d_status == 'seen')
                                                                    <small>{{ $dUser->name }},</small>
                                                                @endif
                                                                @if ($m->e_status == 'seen')
                                                                    <small>{{ $eUser->name }},</small>
                                                                @endif
                                                                @if ($m->f_status == 'seen')
                                                                    <small>{{ $fUser->name }},</small>
                                                                @endif
                                                                @if ($m->g_status == 'seen')
                                                                    <small>{{ $gUser->name }},</small>
                                                                @endif
                                                                @if ($m->h_status == 'seen')
                                                                    <small>{{ $hUser->name }}</small>
                                                                @endif
                                                            </div>
                                                        @else
                                                        @endif
                                                    @else
                                                <div class=" col"></div>
                                                    @endif
                                                    <div class=" col-2 text-end">
                                                        <a
                                                            href="{{ route('group#groupChatMessageReply', $m->chat_code) }}"><i
                                                                class="fa-solid fa-reply  opacity-50 text-dark"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                @endif

                            </div>
                        @endif
                    @endforeach

                </div>
                {{-- display message end  --}}

                <div class="col ">
                    {{-- reply start --}}
                    <div id="replyText">
                        @if (isset($reply))
                            <div class=" container-fluid d-lg-flex"
                                style=" background-color: rgb(59, 59, 59); height:50px">
                                <div class="col-1"><i class="fa-solid fa-reply fs-3 pt-3 text-white-50"></i></div>
                                @if ($reply->text == null)
                                    <img src="{{ asset('storage/' . $reply->image) }}"
                                        class=" opacity-50 rounded-2 shadow" alt="">
                                    <div class="col-9"></div>
                                @else
                                    <div class="col-10 pt-3 text-white"> {{ $reply->text }}</div>
                                @endif
                                <a href="{{ route('group#groupChatPage', $reply->gp_id) }}" class="col"><i
                                        class="fa-solid fa-xmark text-dark fs-3 pt-3"></i></a>
                            </div>
                        @else
                        @endif
                    </div>
                    {{-- reply end  --}}
                    <!-- message send start -->
                    <form action="{{ route('group#groupChatMessage') }}" method="POST"
                        class="row py-1 rounded-bottom-4" style=" background-color: rgb(59, 59, 59);"
                        enctype="multipart/form-data">
                        @csrf

                        @if (isset($reply))
                            <input type="hidden" name="replyCode" value="{{ $reply->chat_code }}">
                        @endif

                        <div class="col-1 mt-2">
                            <button class="  rounded-circle btn btn-dark" id="scrollDown" type="button">
                                <i class="fa-solid fa-arrow-down"></i>
                            </button>
                        </div>

                        {{-- file upload start  --}}
                        <div class=" col-1 offset-1 pt-3 d-flex">
                            <i class="fa-solid fa-bars fs-4 text-white-50 me-3" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop1"></i>
                            <div class=" btn-group dropup" id="dropup">
                                <i class="fa-regular fa-face-smile text-white-50 fs-4" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false"></i>
                                <div class="dropdown-menu mb-3 bg-dark GpEmo" id="dropdown-menu">

                                    <div class="emoji-picker">
                                        <div class="emoji-container">

                                        </div>
                                    </div>

                                </div>
                            </div>

                            {{-- </button> --}}
                        </div>
                        {{-- file upload end  --}}

                        <div class="col-6">
                            <input class="form-control mt-2 text-white w-100 rounded-pill" id="message"
                                name="message"
                                style="border: 1px solid rgb(92, 92, 92); background-color: rgb(92, 92, 92);"
                                type="text" placeholder="Message ..." aria-label="Message ..." v-model="message">

                        </div>
                        <input type="hidden" name="gpId" value="{{ $groupChat->id }}">
                        <input type="hidden" name="userId" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="firstUser" value="{{ $groupChat->fir_user_id }}">
                        @if ($groupChat->sec_user_id != null)
                            <input type="hidden" name="secUser" value="{{ $groupChat->sec_user_id }}">
                        @endif
                        @if ($groupChat->a_user_id != null)
                            <input type="hidden" name="aUser" value="{{ $groupChat->a_user_id }}">
                        @endif
                        @if ($groupChat->b_user_id != null)
                            <input type="hidden" name="bUser" value="{{ $groupChat->b_user_id }}">
                        @endif
                        @if ($groupChat->c_user_id != null)
                            <input type="hidden" name="cUser" value="{{ $groupChat->c_user_id }}">
                        @endif
                        @if ($groupChat->d_user_id != null)
                            <input type="hidden" name="dUser" value="{{ $groupChat->d_user_id }}">
                        @endif
                        @if ($groupChat->e_user_id != null)
                            <input type="hidden" name="eUser" value="{{ $groupChat->e_user_id }}">
                        @endif
                        @if ($groupChat->f_user_id != null)
                            <input type="hidden" name="fUser" value="{{ $groupChat->f_user_id }}">
                        @endif
                        @if ($groupChat->g_user_id != null)
                            <input type="hidden" name="gUser" value="{{ $groupChat->g_user_id }}">
                        @endif
                        @if ($groupChat->h_user_id != null)
                            <input type="hidden" name="hUser" value="{{ $groupChat->h_user_id }}">
                        @endif

                        <div class=" col-2 btn">
                            <button class="btn btn-dark rounded-pill " type="submit">
                                <i class="fa-solid fa-paper-plane"></i>
                            </button>
                        </div>
                    </form>
                    <!-- message send end -->
                </div>
            </div>
            <!-- chat section end  -->

            <!-- detail start  -->
            <div class="col-md">
                <div class=" mt-2 rounded-3 overflow-auto" id="detailScroll"
                    style="background-color: rgb(51, 51, 51); height:87vh">
                    <div class="px-3 pt-2">


                        <div class="text-end">
                            <div class="btn-group dropleft">
                                <div type="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="fa-solid fa-ellipsis-vertical text-white fs-4"></i>
                                </div>
                                <div class="dropdown-menu bg-dark">
                                    <label for="gpPic" class="btn btn-dark text-start text-white px-3">
                                        Change Group Picture
                                        <input type="file" name="GpImage" class="GpImage" id="gpPic" hidden>
                                    </label>
                                    <div class=" text-white  border-bottom border-secondary">
                                        {{-- Change Group Name --}}
                                        <!-- Button trigger modal-->
                                        <button type="button" class="btn btn-dark text-start" data-bs-toggle="modal"
                                            data-bs-target="#changeGpName">
                                            Change Group Name
                                        </button>
                                    </div>
                                    <div class=" text-center mt-2">
                                        {{-- leave group or delete group  --}}
                                        @if (Auth::user()->id == $groupChat->user_id)
                                            <a href="{{ route('group#groupChatDelete', $groupChat->id) }}"
                                                class="btn btn-dark text-white text-decoration-none ">Delete
                                                Group</a>
                                        @else
                                            <a href="{{ route('group#groupChatLeave', $groupChat->id) }}"
                                                class=" btn btn-dark text-white text-decoration-none">Leave
                                                Group</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>


                        @if ($groupChat->group_image == null)
                            <img src="{{ asset('image/defaultpic.jpg') }}" class="w-100 rounded-circle shadow-lg"
                                alt="">
                        @else
                            <img src="{{ asset('storage/' . $groupChat->group_image) }}"
                                class="w-100 rounded-circle shadow-lg" alt="">
                        @endif

                        <div class="text-white fs-5 mt-2 ps-3 mb-2" style=" border-bottom: 1px solid white;">Info
                        </div>
                        <div class=" px-3 pb-3 mt-2" style=" border-bottom: 1px solid grey">
                            <div class="mt-2">
                                <span class=" text-white-50">username</span>
                                <h5 class="text-white">{{ $groupChat->group_name }}</h5>
                            </div>
                            <div class="mt-2">
                                <span class=" text-white-50 d-block">members</span>

                                <div class=" overflow-scroll memberScroll px-3" style="height:200px;">
                                    <div class=" row py-2 border-bottom border-secondary">
                                        <div class="col-3">
                                            @if ($user->image == null)
                                                <img src="{{ asset('image/defaultpic.jpg') }}"
                                                    class="w-100  mt-1 rounded-circle shadow-lg" alt="">
                                            @else
                                                <img src="{{ asset('storage/' . $user->image) }}"
                                                    class="w-100  rounded-circle mt-1 shadow-lg" alt="">
                                            @endif
                                        </div>
                                        <div class=" col ">
                                            <small class="text-white d-block">{{ $user->name }}</small>
                                            @if ($user->status == 'online')
                                                <small class=" text-white">{{ $user->status }}</small>
                                            @else
                                                @if (date('H') * 60 + date('i') - ($user->updated_at->format('H') * 60 + $user->updated_at->format('i')) > 60)
                                                    <small class=" text-white-50">Active
                                                        {{ date('H') - $user->updated_at->format('H') }}
                                                        hours ago</small>
                                                @elseif (date('H') * 60 + date('i') - ($user->updated_at->format('H') * 60 + $user->updated_at->format('i')) == 0)
                                                    <small class=" text-white-50">Active a minute ago
                                                    </small>
                                                @elseif (date('H') * 60 + date('i') - ($user->updated_at->format('H') * 60 + $user->updated_at->format('i')) > 1140)
                                                    <small class=" text-white-50">Active
                                                        {{ date('d') - $user->updated_at->format('d') }}
                                                        days ago</small>
                                                @elseif (date('H') * 60 + date('i') - ($user->updated_at->format('H') * 60 + $user->updated_at->format('i')) > 43200)
                                                    <small class=" text-white-50">Active
                                                        {{ date('m') - $user->updated_at->format('m') }}
                                                        months ago</small>
                                                @elseif (date('H') * 60 + date('i') - ($user->updated_at->format('H') * 60 + $user->updated_at->format('i')) > 525600)
                                                    <small class=" text-white-50">Active
                                                        {{ date('Y') - $user->updated_at->format('Y') }}
                                                        years ago</small>
                                                @else
                                                    @if ($user->updated_at->format('H') * 60 + $user->updated_at->format('i') <= date('H') * 60 + date('i'))
                                                        <small class=" text-white-50">Active
                                                            {{ date('H') * 60 + date('i') - ($user->updated_at->format('H') * 60 + $user->updated_at->format('i')) }}
                                                            minute ago
                                                        </small>
                                                    @endif
                                                @endif
                                            @endif
                                        </div>
                                        <div class=" col-3">
                                            <small class=" text-white-50 text-start d-block">admin</small>
                                        </div>
                                    </div>
                                    @if ($firUser != null)
                                        <div class=" row py-2 border-bottom border-secondary">
                                            <div class="col-3">
                                                @if ($firUser->image == null)
                                                    <img src="{{ asset('image/defaultpic.jpg') }}"
                                                        class="w-100  mt-1 rounded-circle shadow-lg" alt="">
                                                @else
                                                    <img src="{{ asset('storage/' . $firUser->image) }}"
                                                        class="w-100  rounded-circle mt-1 shadow-lg" alt="">
                                                @endif
                                            </div>
                                            <div class=" col ">
                                                <small class="text-white d-block">{{ $firUser->name }}</small>
                                                @if ($firUser->status == 'online')
                                                    <small class=" text-white">{{ $firUser->status }}</small>
                                                @else
                                                    @if (date('H') * 60 + date('i') - ($firUser->updated_at->format('H') * 60 + $firUser->updated_at->format('i')) > 60)
                                                        <small class=" text-white-50">Active
                                                            {{ date('H') - $firUser->updated_at->format('H') }}
                                                            hours ago</small>
                                                    @elseif (date('H') * 60 + date('i') - ($firUser->updated_at->format('H') * 60 + $firUser->updated_at->format('i')) == 0)
                                                        <small class=" text-white-50">Active a minute ago
                                                        </small>
                                                    @elseif (date('H') * 60 + date('i') - ($firUser->updated_at->format('H') * 60 + $firUser->updated_at->format('i')) > 1140)
                                                        <small class=" text-white-50">Active
                                                            {{ date('d') - $firUser->updated_at->format('d') }}
                                                            days ago</small>
                                                    @elseif (date('H') * 60 + date('i') - ($firUser->updated_at->format('H') * 60 + $firUser->updated_at->format('i')) > 43200)
                                                        <small class=" text-white-50">Active
                                                            {{ date('m') - $firUser->updated_at->format('m') }}
                                                            months ago</small>
                                                    @elseif (date('H') * 60 + date('i') - ($firUser->updated_at->format('H') * 60 + $firUser->updated_at->format('i')) > 525600)
                                                        <small class=" text-white-50">Active
                                                            {{ date('Y') - $firUser->updated_at->format('Y') }}
                                                            years ago</small>
                                                    @else
                                                        @if ($firUser->updated_at->format('H') * 60 + $firUser->updated_at->format('i') <= date('H') * 60 + date('i'))
                                                            <small class=" text-white-50">Active
                                                                {{ date('H') * 60 + date('i') - ($firUser->updated_at->format('H') * 60 + $firUser->updated_at->format('i')) }}
                                                                minute ago
                                                            </small>
                                                        @endif
                                                    @endif
                                                @endif
                                            </div>
                                            @if (Auth::user()->id == $firUser->id)
                                            @else
                                                <div class="btn-group dropleft  col-1">
                                                    <div data-bs-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <i class="fa-solid fa-ellipsis-vertical text-white pt-2"></i>
                                                    </div>
                                                    <div class="dropdown-menu bg-dark">
                                                        <div class=" text-center">
                                                            {{-- remove member & show profile --}}
                                                            @if (Auth::user()->id == $groupChat->user_id)
                                                                <a href="{{ route('group#groupChatRemoveMember', $firUser->id) }}"
                                                                    class=" d-block text-white text-decoration-none pb-2 border-bottom border-secondary border-1"><i
                                                                        class="fa-solid fa-trash pe-2 text-white-50"></i>Remove</a>
                                                            @else
                                                            @endif
                                                            <a href="{{ route('chat#chatPage', $firUser->id) }}"
                                                                class="d-block text-white text-decoration-none pb-2 pt-2"><i
                                                                    class="fa-solid fa-comment pe-2 text-white-50"></i>Message</a>
                                                            <a href="{{ route('chat#chatPage', $firUser->id) }}"
                                                                class="d-block text-white text-decoration-none pb-2 pt-2">Block</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                    @if ($secUser != null)
                                        <div class=" row py-2 border-bottom border-secondary">
                                            <div class="col-3">
                                                @if ($secUser->image == null)
                                                    <img src="{{ asset('image/defaultpic.jpg') }}"
                                                        class="w-100  mt-1 rounded-circle shadow-lg" alt="">
                                                @else
                                                    <img src="{{ asset('storage/' . $secUser->image) }}"
                                                        class="w-100  rounded-circle mt-1 shadow-lg" alt="">
                                                @endif
                                            </div>
                                            <div class=" col ">
                                                <small class="text-white d-block">{{ $secUser->name }}</small>
                                                @if ($secUser->status == 'online')
                                                    <small class=" text-white">{{ $secUser->status }}</small>
                                                @else
                                                    @if (date('H') * 60 + date('i') - ($secUser->updated_at->format('H') * 60 + $secUser->updated_at->format('i')) > 60)
                                                        <small class=" text-white-50">Active
                                                            {{ date('H') - $secUser->updated_at->format('H') }}
                                                            hours ago</small>
                                                    @elseif (date('H') * 60 + date('i') - ($secUser->updated_at->format('H') * 60 + $secUser->updated_at->format('i')) == 0)
                                                        <small class=" text-white-50">Active a minute ago
                                                        </small>
                                                    @elseif (date('H') * 60 + date('i') - ($secUser->updated_at->format('H') * 60 + $secUser->updated_at->format('i')) > 1140)
                                                        <small class=" text-white-50">Active
                                                            {{ date('d') - $secUser->updated_at->format('d') }}
                                                            days ago</small>
                                                    @elseif (date('H') * 60 + date('i') - ($secUser->updated_at->format('H') * 60 + $secUser->updated_at->format('i')) > 43200)
                                                        <small class=" text-white-50">Active
                                                            {{ date('m') - $secUser->updated_at->format('m') }}
                                                            months ago</small>
                                                    @elseif (date('H') * 60 + date('i') - ($secUser->updated_at->format('H') * 60 + $secUser->updated_at->format('i')) > 525600)
                                                        <small class=" text-white-50">Active
                                                            {{ date('Y') - $secUser->updated_at->format('Y') }}
                                                            years ago</small>
                                                    @else
                                                        @if ($secUser->updated_at->format('H') * 60 + $secUser->updated_at->format('i') <= date('H') * 60 + date('i'))
                                                            <small class=" text-white-50">Active
                                                                {{ date('H') * 60 + date('i') - ($secUser->updated_at->format('H') * 60 + $secUser->updated_at->format('i')) }}
                                                                minute ago
                                                            </small>
                                                        @endif
                                                    @endif
                                                @endif
                                            </div>
                                            @if (Auth::user()->id == $secUser->id)
                                            @else
                                                <div class="btn-group dropleft  col-1">
                                                    <div data-bs-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <i class="fa-solid fa-ellipsis-vertical text-white pt-2"></i>
                                                    </div>
                                                    <div class="dropdown-menu bg-dark">
                                                        <div class=" text-center">
                                                            {{-- remove member & show profile --}}
                                                            @if (Auth::user()->id == $groupChat->user_id)
                                                                <a href="{{ route('group#groupChatRemoveMember', $secUser->id) }}"
                                                                    class=" d-block text-white text-decoration-none pb-2 border-bottom border-secondary border-1"><i
                                                                        class="fa-solid fa-trash pe-2 text-white-50"></i>Remove</a>
                                                            @else
                                                            @endif
                                                            <a href="{{ route('chat#chatPage', $secUser->id) }}"
                                                                class="d-block text-white text-decoration-none pb-2 pt-2"><i
                                                                    class="fa-solid fa-comment pe-2 text-white-50"></i>Message</a>
                                                            <a href="{{ route('chat#chatPage', $secUser->id) }}"
                                                                class="d-block text-white text-decoration-none pb-2 pt-2">Block</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                    @if ($aUser != null)
                                        <div class=" row py-2 border-bottom border-secondary">
                                            <div class="col-3">
                                                @if ($aUser->image == null)
                                                    <img src="{{ asset('image/defaultpic.jpg') }}"
                                                        class="w-100  mt-1 rounded-circle shadow-lg" alt="">
                                                @else
                                                    <img src="{{ asset('storage/' . $aUser->image) }}"
                                                        class="w-100  rounded-circle mt-1 shadow-lg" alt="">
                                                @endif
                                            </div>
                                            <div class=" col ">
                                                <small class="text-white  d-block">{{ $aUser->name }}</small>
                                                @if ($aUser->status == 'online')
                                                    <small class=" text-white">{{ $aUser->status }}</small>
                                                @else
                                                    @if (date('H') * 60 + date('i') - ($aUser->updated_at->format('H') * 60 + $aUser->updated_at->format('i')) > 60)
                                                        <small class=" text-white-50">Active
                                                            {{ date('H') - $aUser->updated_at->format('H') }}
                                                            hours ago</small>
                                                    @elseif (date('H') * 60 + date('i') - ($aUser->updated_at->format('H') * 60 + $aUser->updated_at->format('i')) == 0)
                                                        <small class=" text-white-50">Active a minute ago
                                                        </small>
                                                    @elseif (date('H') * 60 + date('i') - ($aUser->updated_at->format('H') * 60 + $aUser->updated_at->format('i')) > 1140)
                                                        <small class=" text-white-50">Active
                                                            {{ date('d') - $aUser->updated_at->format('d') }}
                                                            days ago</small>
                                                    @elseif (date('H') * 60 + date('i') - ($aUser->updated_at->format('H') * 60 + $aUser->updated_at->format('i')) > 43200)
                                                        <small class=" text-white-50">Active
                                                            {{ date('m') - $aUser->updated_at->format('m') }}
                                                            months ago</small>
                                                    @elseif (date('H') * 60 + date('i') - ($aUser->updated_at->format('H') * 60 + $aUser->updated_at->format('i')) > 525600)
                                                        <small class=" text-white-50">Active
                                                            {{ date('Y') - $aUser->updated_at->format('Y') }}
                                                            years ago</small>
                                                    @else
                                                        @if ($aUser->updated_at->format('H') * 60 + $aUser->updated_at->format('i') <= date('H') * 60 + date('i'))
                                                            <small class=" text-white-50">Active
                                                                {{ date('H') * 60 + date('i') - ($aUser->updated_at->format('H') * 60 + $aUser->updated_at->format('i')) }}
                                                                minute ago
                                                            </small>
                                                        @endif
                                                    @endif
                                                @endif
                                            </div>
                                            @if (Auth::user()->id == $aUser->id)
                                            @else
                                                <div class="btn-group dropleft  col-1">
                                                    <div data-bs-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <i class="fa-solid fa-ellipsis-vertical text-white pt-2"></i>
                                                    </div>
                                                    <div class="dropdown-menu bg-dark">
                                                        <div class=" text-center">
                                                            {{-- remove member & show profile --}}
                                                            @if (Auth::user()->id == $groupChat->user_id)
                                                                <a href="{{ route('group#groupChatRemoveMember', $aUser->id) }}"
                                                                    class=" d-block text-white text-decoration-none pb-2 border-bottom border-secondary border-1"><i
                                                                        class="fa-solid fa-trash pe-2 text-white-50"></i>Remove</a>
                                                            @else
                                                            @endif
                                                            <a href="{{ route('chat#chatPage', $aUser->id) }}"
                                                                class="d-block text-white text-decoration-none pb-2 pt-2"><i
                                                                    class="fa-solid fa-comment pe-2 text-white-50"></i>Message</a>
                                                            <a href="{{ route('chat#chatPage', $aUser->id) }}"
                                                                class="d-block text-white text-decoration-none pb-2 pt-2">Block</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                    @if ($bUser != null)
                                        <div class=" row py-2 border-bottom border-secondary">
                                            <div class="col-3">
                                                @if ($bUser->image == null)
                                                    <img src="{{ asset('image/defaultpic.jpg') }}"
                                                        class="w-100  mt-1 rounded-circle shadow-lg" alt="">
                                                @else
                                                    <img src="{{ asset('storage/' . $bUser->image) }}"
                                                        class="w-100  rounded-circle mt-1 shadow-lg" alt="">
                                                @endif
                                            </div>
                                            <div class=" col ">
                                                <small class="text-white d-block">{{ $bUser->name }}</small>
                                                @if ($bUser->status == 'online')
                                                    <small class=" text-white">{{ $bUser->status }}</small>
                                                @else
                                                    @if (date('H') * 60 + date('i') - ($bUser->updated_at->format('H') * 60 + $bUser->updated_at->format('i')) > 60)
                                                        <small class=" text-white-50">Active
                                                            {{ date('H') - $bUser->updated_at->format('H') }}
                                                            hours ago</small>
                                                    @elseif (date('H') * 60 + date('i') - ($bUser->updated_at->format('H') * 60 + $bUser->updated_at->format('i')) == 0)
                                                        <small class=" text-white-50">Active a minute ago
                                                        </small>
                                                    @elseif (date('H') * 60 + date('i') - ($bUser->updated_at->format('H') * 60 + $bUser->updated_at->format('i')) > 1140)
                                                        <small class=" text-white-50">Active
                                                            {{ date('d') - $bUser->updated_at->format('d') }}
                                                            days ago</small>
                                                    @elseif (date('H') * 60 + date('i') - ($bUser->updated_at->format('H') * 60 + $bUser->updated_at->format('i')) > 43200)
                                                        <small class=" text-white-50">Active
                                                            {{ date('m') - $bUser->updated_at->format('m') }}
                                                            months ago</small>
                                                    @elseif (date('H') * 60 + date('i') - ($bUser->updated_at->format('H') * 60 + $bUser->updated_at->format('i')) > 525600)
                                                        <small class=" text-white-50">Active
                                                            {{ date('Y') - $bUser->updated_at->format('Y') }}
                                                            years ago</small>
                                                    @else
                                                        @if ($bUser->updated_at->format('H') * 60 + $bUser->updated_at->format('i') <= date('H') * 60 + date('i'))
                                                            <small class=" text-white-50">Active
                                                                {{ date('H') * 60 + date('i') - ($bUser->updated_at->format('H') * 60 + $bUser->updated_at->format('i')) }}
                                                                minute ago
                                                            </small>
                                                        @endif
                                                    @endif
                                                @endif
                                            </div>
                                            @if (Auth::user()->id == $bUser->id)
                                            @else
                                                <div class="btn-group dropleft  col-1">
                                                    <div data-bs-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <i class="fa-solid fa-ellipsis-vertical text-white pt-2"></i>
                                                    </div>
                                                    <div class="dropdown-menu bg-dark">
                                                        <div class=" text-center">
                                                            {{-- remove member & show profile --}}
                                                            @if (Auth::user()->id == $groupChat->user_id)
                                                                <a href="{{ route('group#groupChatRemoveMember', $bUser->id) }}"
                                                                    class=" d-block text-white text-decoration-none pb-2 border-bottom border-secondary border-1"><i
                                                                        class="fa-solid fa-trash pe-2 text-white-50"></i>Remove</a>
                                                            @else
                                                            @endif
                                                            <a href="{{ route('chat#chatPage', $bUser->id) }}"
                                                                class="d-block text-white text-decoration-none pb-2 pt-2"><i
                                                                    class="fa-solid fa-comment pe-2 text-white-50"></i>Message</a>
                                                            <a href="{{ route('chat#chatPage', $bUser->id) }}"
                                                                class="d-block text-white text-decoration-none pb-2 pt-2">Block</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                    @if ($cUser != null)
                                        <div class=" row py-2 border-bottom border-secondary">
                                            <div class="col-3">
                                                @if ($cUser->image == null)
                                                    <img src="{{ asset('image/defaultpic.jpg') }}"
                                                        class="w-100  mt-1 rounded-circle shadow-lg" alt="">
                                                @else
                                                    <img src="{{ asset('storage/' . $cUser->image) }}"
                                                        class="w-100  rounded-circle mt-1 shadow-lg" alt="">
                                                @endif
                                            </div>
                                            <div class=" col ">
                                                <small class="text-white d-block">{{ $cUser->name }}</small>
                                                @if ($cUser->status == 'online')
                                                    <small class=" text-white">{{ $cUser->status }}</small>
                                                @else
                                                    @if (date('H') * 60 + date('i') - ($cUser->updated_at->format('H') * 60 + $cUser->updated_at->format('i')) > 60)
                                                        <small class=" text-white-50">Active
                                                            {{ date('H') - $cUser->updated_at->format('H') }}
                                                            hours ago</small>
                                                    @elseif (date('H') * 60 + date('i') - ($cUser->updated_at->format('H') * 60 + $cUser->updated_at->format('i')) == 0)
                                                        <small class=" text-white-50">Active a minute ago
                                                        </small>
                                                    @elseif (date('H') * 60 + date('i') - ($cUser->updated_at->format('H') * 60 + $cUser->updated_at->format('i')) > 1140)
                                                        <small class=" text-white-50">Active
                                                            {{ date('d') - $cUser->updated_at->format('d') }}
                                                            days ago</small>
                                                    @elseif (date('H') * 60 + date('i') - ($cUser->updated_at->format('H') * 60 + $cUser->updated_at->format('i')) > 43200)
                                                        <small class=" text-white-50">Active
                                                            {{ date('m') - $cUser->updated_at->format('m') }}
                                                            months ago</small>
                                                    @elseif (date('H') * 60 + date('i') - ($cUser->updated_at->format('H') * 60 + $cUser->updated_at->format('i')) > 525600)
                                                        <small class=" text-white-50">Active
                                                            {{ date('Y') - $cUser->updated_at->format('Y') }}
                                                            years ago</small>
                                                    @else
                                                        @if ($cUser->updated_at->format('H') * 60 + $cUser->updated_at->format('i') <= date('H') * 60 + date('i'))
                                                            <small class=" text-white-50">Active
                                                                {{ date('H') * 60 + date('i') - ($cUser->updated_at->format('H') * 60 + $cUser->updated_at->format('i')) }}
                                                                minute ago
                                                            </small>
                                                        @endif
                                                    @endif
                                                @endif
                                            </div>
                                            @if (Auth::user()->id == $cUser->id)
                                            @else
                                                <div class="btn-group dropleft  col-1">
                                                    <div data-bs-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <i class="fa-solid fa-ellipsis-vertical text-white pt-2"></i>
                                                    </div>
                                                    <div class="dropdown-menu bg-dark">
                                                        <div class=" text-center">
                                                            {{-- remove member & show profile --}}
                                                            @if (Auth::user()->id == $groupChat->user_id)
                                                                <a href="{{ route('group#groupChatRemoveMember', $cUser->id) }}"
                                                                    class=" d-block text-white text-decoration-none pb-2 border-bottom border-secondary border-1"><i
                                                                        class="fa-solid fa-trash pe-2 text-white-50"></i>Remove</a>
                                                            @else
                                                            @endif
                                                            <a href="{{ route('chat#chatPage', $cUser->id) }}"
                                                                class="d-block text-white text-decoration-none pb-2 pt-2"><i
                                                                    class="fa-solid fa-comment pe-2 text-white-50"></i>Message</a>
                                                            <a href="{{ route('chat#chatPage', $cUser->id) }}"
                                                                class="d-block text-white text-decoration-none pb-2 pt-2">Block</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                    @if ($dUser != null)
                                        <div class=" row py-2 border-bottom border-secondary">
                                            <div class="col-3">
                                                @if ($dUser->image == null)
                                                    <img src="{{ asset('image/defaultpic.jpg') }}"
                                                        class="w-100  mt-1 rounded-circle shadow-lg" alt="">
                                                @else
                                                    <img src="{{ asset('storage/' . $dUser->image) }}"
                                                        class="w-100  rounded-circle mt-1 shadow-lg" alt="">
                                                @endif
                                            </div>
                                            <div class=" col ">
                                                <small class="text-white d-block">{{ $dUser->name }}</small>
                                                @if ($dUser->status == 'online')
                                                    <small class=" text-white">{{ $dUser->status }}</small>
                                                @else
                                                    @if (date('H') * 60 + date('i') - ($dUser->updated_at->format('H') * 60 + $dUser->updated_at->format('i')) > 60)
                                                        <small class=" text-white-50">Active
                                                            {{ date('H') - $dUser->updated_at->format('H') }}
                                                            hours ago</small>
                                                    @elseif (date('H') * 60 + date('i') - ($dUser->updated_at->format('H') * 60 + $dUser->updated_at->format('i')) == 0)
                                                        <small class=" text-white-50">Active a minute ago
                                                        </small>
                                                    @elseif (date('H') * 60 + date('i') - ($dUser->updated_at->format('H') * 60 + $dUser->updated_at->format('i')) > 1140)
                                                        <small class=" text-white-50">Active
                                                            {{ date('d') - $dUser->updated_at->format('d') }}
                                                            days ago</small>
                                                    @elseif (date('H') * 60 + date('i') - ($dUser->updated_at->format('H') * 60 + $dUser->updated_at->format('i')) > 43200)
                                                        <small class=" text-white-50">Active
                                                            {{ date('m') - $dUser->updated_at->format('m') }}
                                                            months ago</small>
                                                    @elseif (date('H') * 60 + date('i') - ($dUser->updated_at->format('H') * 60 + $dUser->updated_at->format('i')) > 525600)
                                                        <small class=" text-white-50">Active
                                                            {{ date('Y') - $dUser->updated_at->format('Y') }}
                                                            years ago</small>
                                                    @else
                                                        @if ($dUser->updated_at->format('H') * 60 + $dUser->updated_at->format('i') <= date('H') * 60 + date('i'))
                                                            <small class=" text-white-50">Active
                                                                {{ date('H') * 60 + date('i') - ($dUser->updated_at->format('H') * 60 + $dUser->updated_at->format('i')) }}
                                                                minute ago
                                                            </small>
                                                        @endif
                                                    @endif
                                                @endif
                                            </div>
                                            @if (Auth::user()->id == $dUser->id)
                                            @else
                                                <div class="btn-group dropleft  col-1">
                                                    <div data-bs-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <i class="fa-solid fa-ellipsis-vertical text-white pt-2"></i>
                                                    </div>
                                                    <div class="dropdown-menu bg-dark">
                                                        <div class=" text-center">
                                                            {{-- remove member & show profile --}}
                                                            @if (Auth::user()->id == $groupChat->user_id)
                                                                <a href="{{ route('group#groupChatRemoveMember', $dUser->id) }}"
                                                                    class=" d-block text-white text-decoration-none pb-2 border-bottom border-secondary border-1"><i
                                                                        class="fa-solid fa-trash pe-2 text-white-50"></i>Remove</a>
                                                            @else
                                                            @endif
                                                            <a href="{{ route('chat#chatPage', $dUser->id) }}"
                                                                class="d-block text-white text-decoration-none pb-2 pt-2"><i
                                                                    class="fa-solid fa-comment pe-2 text-white-50"></i>Message</a>
                                                            <a href="{{ route('chat#chatPage', $dUser->id) }}"
                                                                class="d-block text-white text-decoration-none pb-2 pt-2">Block</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                    @if ($eUser != null)
                                        <div class=" row py-2 border-bottom border-secondary">
                                            <div class="col-3">
                                                @if ($eUser->image == null)
                                                    <img src="{{ asset('image/defaultpic.jpg') }}"
                                                        class="w-100  mt-1 rounded-circle shadow-lg" alt="">
                                                @else
                                                    <img src="{{ asset('storage/' . $eUser->image) }}"
                                                        class="w-100  rounded-circle mt-1 shadow-lg" alt="">
                                                @endif
                                            </div>
                                            <div class=" col ">
                                                <small class="text-white d-block">{{ $eUser->name }}</small>
                                                @if ($eUser->status == 'online')
                                                    <small class=" text-white">{{ $eUser->status }}</small>
                                                @else
                                                    @if (date('H') * 60 + date('i') - ($eUser->updated_at->format('H') * 60 + $eUser->updated_at->format('i')) > 60)
                                                        <small class=" text-white-50">Active
                                                            {{ date('H') - $eUser->updated_at->format('H') }}
                                                            hours ago</small>
                                                    @elseif (date('H') * 60 + date('i') - ($eUser->updated_at->format('H') * 60 + $eUser->updated_at->format('i')) == 0)
                                                        <small class=" text-white-50">Active a minute ago
                                                        </small>
                                                    @elseif (date('H') * 60 + date('i') - ($eUser->updated_at->format('H') * 60 + $eUser->updated_at->format('i')) > 1140)
                                                        <small class=" text-white-50">Active
                                                            {{ date('d') - $eUser->updated_at->format('d') }}
                                                            days ago</small>
                                                    @elseif (date('H') * 60 + date('i') - ($eUser->updated_at->format('H') * 60 + $eUser->updated_at->format('i')) > 43200)
                                                        <small class=" text-white-50">Active
                                                            {{ date('m') - $eUser->updated_at->format('m') }}
                                                            months ago</small>
                                                    @elseif (date('H') * 60 + date('i') - ($eUser->updated_at->format('H') * 60 + $eUser->updated_at->format('i')) > 525600)
                                                        <small class=" text-white-50">Active
                                                            {{ date('Y') - $eUser->updated_at->format('Y') }}
                                                            years ago</small>
                                                    @else
                                                        @if ($eUser->updated_at->format('H') * 60 + $eUser->updated_at->format('i') <= date('H') * 60 + date('i'))
                                                            <small class=" text-white-50">Active
                                                                {{ date('H') * 60 + date('i') - ($eUser->updated_at->format('H') * 60 + $eUser->updated_at->format('i')) }}
                                                                minute ago
                                                            </small>
                                                        @endif
                                                    @endif
                                                @endif
                                            </div>
                                            @if (Auth::user()->id == $eUser->id)
                                            @else
                                                <div class="btn-group dropleft  col-1">
                                                    <div data-bs-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <i class="fa-solid fa-ellipsis-vertical text-white pt-2"></i>
                                                    </div>
                                                    <div class="dropdown-menu bg-dark">
                                                        <div class=" text-center">
                                                            {{-- remove member & show profile --}}
                                                            @if (Auth::user()->id == $groupChat->user_id)
                                                                <a href="{{ route('group#groupChatRemoveMember', $eUser->id) }}"
                                                                    class=" d-block text-white text-decoration-none pb-2 border-bottom border-secondary border-1"><i
                                                                        class="fa-solid fa-trash pe-2 text-white-50"></i>Remove</a>
                                                            @else
                                                            @endif
                                                            <a href="{{ route('chat#chatPage', $eUser->id) }}"
                                                                class="d-block text-white text-decoration-none pb-2 pt-2"><i
                                                                    class="fa-solid fa-comment pe-2 text-white-50"></i>Message</a>
                                                            <a href="{{ route('chat#chatPage', $eUser->id) }}"
                                                                class="d-block text-white text-decoration-none pb-2 pt-2">Block</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                    @if ($fUser != null)
                                        <div class=" row py-2 border-bottom border-secondary">
                                            <div class="col-3">
                                                @if ($fUser->image == null)
                                                    <img src="{{ asset('image/defaultpic.jpg') }}"
                                                        class="w-100  mt-1 rounded-circle shadow-lg" alt="">
                                                @else
                                                    <img src="{{ asset('storage/' . $fUser->image) }}"
                                                        class="w-100  rounded-circle mt-1 shadow-lg" alt="">
                                                @endif
                                            </div>
                                            <div class=" col ">
                                                <small class="text-white d-block">{{ $fUser->name }}</small>
                                                @if ($fUser->status == 'online')
                                                    <small class=" text-white">{{ $fUser->status }}</small>
                                                @else
                                                    @if (date('H') * 60 + date('i') - ($fUser->updated_at->format('H') * 60 + $fUser->updated_at->format('i')) > 60)
                                                        <small class=" text-white-50">Active
                                                            {{ date('H') - $fUser->updated_at->format('H') }}
                                                            hours ago</small>
                                                    @elseif (date('H') * 60 + date('i') - ($fUser->updated_at->format('H') * 60 + $fUser->updated_at->format('i')) == 0)
                                                        <small class=" text-white-50">Active a minute ago
                                                        </small>
                                                    @elseif (date('H') * 60 + date('i') - ($fUser->updated_at->format('H') * 60 + $fUser->updated_at->format('i')) > 1140)
                                                        <small class=" text-white-50">Active
                                                            {{ date('d') - $fUser->updated_at->format('d') }}
                                                            days ago</small>
                                                    @elseif (date('H') * 60 + date('i') - ($fUser->updated_at->format('H') * 60 + $fUser->updated_at->format('i')) > 43200)
                                                        <small class=" text-white-50">Active
                                                            {{ date('m') - $fUser->updated_at->format('m') }}
                                                            months ago</small>
                                                    @elseif (date('H') * 60 + date('i') - ($fUser->updated_at->format('H') * 60 + $fUser->updated_at->format('i')) > 525600)
                                                        <small class=" text-white-50">Active
                                                            {{ date('Y') - $fUser->updated_at->format('Y') }}
                                                            years ago</small>
                                                    @else
                                                        @if ($fUser->updated_at->format('H') * 60 + $fUser->updated_at->format('i') <= date('H') * 60 + date('i'))
                                                            <small class=" text-white-50">Active
                                                                {{ date('H') * 60 + date('i') - ($fUser->updated_at->format('H') * 60 + $fUser->updated_at->format('i')) }}
                                                                minute ago
                                                            </small>
                                                        @endif
                                                    @endif
                                                @endif
                                            </div>
                                            @if (Auth::user()->id == $fUser->id)
                                            @else
                                                <div class="btn-group dropleft  col-1">
                                                    <div data-bs-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <i class="fa-solid fa-ellipsis-vertical text-white pt-2"></i>
                                                    </div>
                                                    <div class="dropdown-menu bg-dark">
                                                        <div class=" text-center">
                                                            {{-- remove member & show profile --}}
                                                            @if (Auth::user()->id == $groupChat->user_id)
                                                                <a href="{{ route('group#groupChatRemoveMember', $fUser->id) }}"
                                                                    class=" d-block text-white text-decoration-none pb-2 border-bottom border-secondary border-1"><i
                                                                        class="fa-solid fa-trash pe-2 text-white-50"></i>Remove</a>
                                                            @else
                                                            @endif
                                                            <a href="{{ route('chat#chatPage', $fUser->id) }}"
                                                                class="d-block text-white text-decoration-none pb-2 pt-2"><i
                                                                    class="fa-solid fa-comment pe-2 text-white-50"></i>Message</a>
                                                            <a href="{{ route('chat#chatPage', $fUser->id) }}"
                                                                class="d-block text-white text-decoration-none pb-2 pt-2">Block</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                    @if ($gUser != null)
                                        <div class=" row py-2 border-bottom border-secondary">
                                            <div class="col-3">
                                                @if ($gUser->image == null)
                                                    <img src="{{ asset('image/defaultpic.jpg') }}"
                                                        class="w-100  mt-1 rounded-circle shadow-lg" alt="">
                                                @else
                                                    <img src="{{ asset('storage/' . $gUser->image) }}"
                                                        class="w-100  rounded-circle mt-1 shadow-lg" alt="">
                                                @endif
                                            </div>
                                            <div class=" col ">
                                                <small class="text-white d-block">{{ $gUser->name }}</small>
                                                @if ($gUser->status == 'online')
                                                    <small class=" text-white">{{ $gUser->status }}</small>
                                                @else
                                                    @if (date('H') * 60 + date('i') - ($gUser->updated_at->format('H') * 60 + $gUser->updated_at->format('i')) > 60)
                                                        <small class=" text-white-50">Active
                                                            {{ date('H') - $gUser->updated_at->format('H') }}
                                                            hours ago</small>
                                                    @elseif (date('H') * 60 + date('i') - ($gUser->updated_at->format('H') * 60 + $gUser->updated_at->format('i')) == 0)
                                                        <small class=" text-white-50">Active a minute ago
                                                        </small>
                                                    @elseif (date('H') * 60 + date('i') - ($gUser->updated_at->format('H') * 60 + $gUser->updated_at->format('i')) > 1140)
                                                        <small class=" text-white-50">Active
                                                            {{ date('d') - $gUser->updated_at->format('d') }}
                                                            days ago</small>
                                                    @elseif (date('H') * 60 + date('i') - ($gUser->updated_at->format('H') * 60 + $gUser->updated_at->format('i')) > 43200)
                                                        <small class=" text-white-50">Active
                                                            {{ date('m') - $gUser->updated_at->format('m') }}
                                                            months ago</small>
                                                    @elseif (date('H') * 60 + date('i') - ($gUser->updated_at->format('H') * 60 + $gUser->updated_at->format('i')) > 525600)
                                                        <small class=" text-white-50">Active
                                                            {{ date('Y') - $gUser->updated_at->format('Y') }}
                                                            years ago</small>
                                                    @else
                                                        @if ($gUser->updated_at->format('H') * 60 + $gUser->updated_at->format('i') <= date('H') * 60 + date('i'))
                                                            <small class=" text-white-50">Active
                                                                {{ date('H') * 60 + date('i') - ($gUser->updated_at->format('H') * 60 + $gUser->updated_at->format('i')) }}
                                                                minute ago
                                                            </small>
                                                        @endif
                                                    @endif
                                                @endif
                                            </div>
                                            @if (Auth::user()->id == $gUser->id)
                                            @else
                                                <div class="btn-group dropleft  col-1">
                                                    <div data-bs-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <i class="fa-solid fa-ellipsis-vertical text-white pt-2"></i>
                                                    </div>
                                                    <div class="dropdown-menu bg-dark">
                                                        <div class=" text-center">
                                                            {{-- remove member & show profile --}}
                                                            @if (Auth::user()->id == $groupChat->user_id)
                                                                <a href="{{ route('group#groupChatRemoveMember', $gUser->id) }}"
                                                                    class=" d-block text-white text-decoration-none pb-2 border-bottom border-secondary border-1"><i
                                                                        class="fa-solid fa-trash pe-2 text-white-50"></i>Remove</a>
                                                            @else
                                                            @endif
                                                            <a href="{{ route('chat#chatPage', $gUser->id) }}"
                                                                class="d-block text-white text-decoration-none pb-2 pt-2"><i
                                                                    class="fa-solid fa-comment pe-2 text-white-50"></i>Message</a>
                                                            <a href="{{ route('chat#chatPage', $gUser->id) }}"
                                                                class="d-block text-white text-decoration-none pb-2 pt-2">Block</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                    @if ($hUser != null)
                                        <div class=" row py-2 border-bottom border-secondary">
                                            <div class="col-3">
                                                @if ($hUser->image == null)
                                                    <img src="{{ asset('image/defaultpic.jpg') }}"
                                                        class="w-100  mt-1 rounded-circle shadow-lg" alt="">
                                                @else
                                                    <img src="{{ asset('storage/' . $hUser->image) }}"
                                                        class="w-100  rounded-circle mt-1 shadow-lg" alt="">
                                                @endif
                                            </div>
                                            <div class=" col ">
                                                <small class="text-white d-block">{{ $hUser->name }}</small>
                                                @if ($hUser->status == 'online')
                                                    <small class=" text-white">{{ $hUser->status }}</small>
                                                @else
                                                    @if (date('H') * 60 + date('i') - ($hUser->updated_at->format('H') * 60 + $hUser->updated_at->format('i')) > 60)
                                                        <small class=" text-white-50">Active
                                                            {{ date('H') - $hUser->updated_at->format('H') }}
                                                            hours ago</small>
                                                    @elseif (date('H') * 60 + date('i') - ($hUser->updated_at->format('H') * 60 + $hUser->updated_at->format('i')) == 0)
                                                        <small class=" text-white-50">Active a minute ago
                                                        </small>
                                                    @elseif (date('H') * 60 + date('i') - ($hUser->updated_at->format('H') * 60 + $hUser->updated_at->format('i')) > 1140)
                                                        <small class=" text-white-50">Active
                                                            {{ date('d') - $hUser->updated_at->format('d') }}
                                                            days ago</small>
                                                    @elseif (date('H') * 60 + date('i') - ($hUser->updated_at->format('H') * 60 + $hUser->updated_at->format('i')) > 43200)
                                                        <small class=" text-white-50">Active
                                                            {{ date('m') - $hUser->updated_at->format('m') }}
                                                            months ago</small>
                                                    @elseif (date('H') * 60 + date('i') - ($hUser->updated_at->format('H') * 60 + $hUser->updated_at->format('i')) > 525600)
                                                        <small class=" text-white-50">Active
                                                            {{ date('Y') - $hUser->updated_at->format('Y') }}
                                                            years ago</small>
                                                    @else
                                                        @if ($hUser->updated_at->format('H') * 60 + $hUser->updated_at->format('i') <= date('H') * 60 + date('i'))
                                                            <small class=" text-white-50">Active
                                                                {{ date('H') * 60 + date('i') - ($hUser->updated_at->format('H') * 60 + $hUser->updated_at->format('i')) }}
                                                                minute ago
                                                            </small>
                                                        @endif
                                                    @endif
                                                @endif
                                            </div>
                                            @if (Auth::user()->id == $hUser->id)
                                            @else
                                                <div class="btn-group dropleft  col-1">
                                                    <div data-bs-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <i class="fa-solid fa-ellipsis-vertical text-white pt-2"></i>
                                                    </div>
                                                    <div class="dropdown-menu bg-dark">
                                                        <div class=" text-center">
                                                            {{-- remove member & show profile --}}
                                                            @if (Auth::user()->id == $groupChat->user_id)
                                                                <a href="{{ route('group#groupChatRemoveMember', $hUser->id) }}"
                                                                    class=" d-block text-white text-decoration-none pb-2 border-bottom border-secondary border-1"><i
                                                                        class="fa-solid fa-trash pe-2 text-white-50"></i>Remove</a>
                                                            @else
                                                            @endif
                                                            <a href="{{ route('chat#chatPage', $hUser->id) }}"
                                                                class="d-block text-white text-decoration-none pb-2 pt-2"><i
                                                                    class="fa-solid fa-comment pe-2 text-white-50"></i>Message</a>
                                                            <a href="{{ route('chat#chatPage', $hUser->id) }}"
                                                                class="d-block text-white text-decoration-none pb-2 pt-2">Block</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class=" mt-3">
                            @foreach ($imageOrder as $io)
                                @if ($io->image == null)
                                @else
                                    <div class=" text-start " data-bs-toggle="modal"
                                        data-bs-target="#{{ $io->id }}">
                                        <div class=" overflow-hidden rounded-3  mb-2" style="height: 150px">
                                            <img src="{{ asset('storage/' . $io->image) }}"
                                                class="w-100 rounded  shadow-lg" alt="">
                                        </div>
                                    </div>

                                    {{-- Modal for Detail Group Image  --}}
                                    <div class="modal fade" id="{{ $io->id }}" data-bs-backdrop="static"
                                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header rounded bg-dark border-dark">
                                                    <img src="{{ asset('storage/' . $io->image) }}"
                                                        class="w-100 rounded shadow-lg" alt="">
                                                    <button type="button"
                                                        class="btn-close position-absolute fs-4 top-0 end-0 mt-4 me-4 "
                                                        data-bs-dismiss="modal" aria-label="Close"></button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- detail end  -->

        </div>
    </section>

    <!-- Modal for Group image Crop-->
    <div class="modal fade" id="GpImageCrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header  bg-secondary" style="border-bottom: 1px solid black">
                    <h1 class="modal-title fs-5 " id="staticBackdropLabel">Crop Picture</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class=" bg-dark py-3">
                    <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="id" id="id" value="{{ $groupChat->id }}">
                    <div class="preview"></div>
                </div>
                <div class="modal-body bg-dark overflow-hidden"
                    style="height: 45vh; border:1px solid black; filter:brightness(50%)">
                    <img src="" id="GpImage" hidden>

                </div>
                <div class="modal-footer bg-dark" style="border-top: 1px solid black">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="crop" class="btn btn-secondary text-dark my-2">
                        Crop & Save
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal for add Group Member  --}}
    <div class="modal fade" id="addMember" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="background-color: rgb(51, 51, 51); border-bottom: 1px solid black">
                    <h4 class="text-white">Add Member</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                @if ($groupChat->h_user_id != null)
                    <div class="modal-body bg-dark">
                        <div class=" text-white-50 text-center">Full Group Member</div>
                    </div>
                    <div class="modal-footer bg-dark" style="border-top: 1px solid grey">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                @else
                    <form action="{{ route('group#groupChatAddMember') }}" method="POST">
                        @csrf
                        <div class="modal-body bg-dark">
                            <ul class="list-group list-group-flush overflow-auto" id="contactScroll"
                                style=" height:40vh;">

                                @foreach ($contact as $c)
                                    @if (
                                        $groupChat->user_id == $c->add_user_id ||
                                            $groupChat->fir_user_id == $c->add_user_id ||
                                            $groupChat->sec_user_id == $c->add_user_id ||
                                            $groupChat->a_user_id == $c->add_user_id ||
                                            $groupChat->b_user_id == $c->add_user_id ||
                                            $groupChat->c_user_id == $c->add_user_id ||
                                            $groupChat->d_user_id == $c->add_user_id ||
                                            $groupChat->e_user_id == $c->add_user_id ||
                                            $groupChat->f_user_id == $c->add_user_id ||
                                            $groupChat->g_user_id == $c->add_user_id ||
                                            $groupChat->h_user_id == $c->add_user_id)
                                    @else
                                        <li class="list-group-item my-1 text-white rounded border-dark"
                                            style="background-color: rgb(51, 51, 51); ">
                                            <div class=" row">
                                                <label for="{{ $c->id }}" class=" form-check-label col">
                                                    @if ($c->image == null)
                                                        <img src="{{ asset('image/defaultpic.jpg') }}"
                                                            alt="" class=" col-2 rounded-circle">
                                                    @else
                                                        <img src="{{ asset('storage/' . $c->image) }}"
                                                            alt="" class=" col-2 rounded-circle">
                                                    @endif
                                                    <span class="col pt-3 ms-3">{{ $c->name }}</span>
                                                </label>
                                                <div class=" col-1 pt-3">
                                                    <input type="hidden" name="gpID"
                                                        value="{{ $groupChat->id }}">

                                                    <input type="checkbox" id="{{ $c->id }}"
                                                        name="{{ $c->add_user_id }}" class=" form-check-input"
                                                        value="{{ $c->add_user_id }}">
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                @endforeach

                            </ul>
                        </div>
                        <div class="modal-footer bg-dark" style="border-top: 1px solid grey">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-secondary text-dark">Add</button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>

    {{-- Modal for Change Group Name  --}}
    <div class="modal fade" id="changeGpName" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-secondary" style="border-bottom: 1px solid black">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('group#groupProfileChangeName') }}" method="POST">
                    @csrf
                    <div class="modal-body bg-dark">
                        <div class=" pb-3">
                            <input type="hidden" name="id" value="{{ $groupChat->id }}">
                            <input type="text" name="gpname" id="gpname"
                                class="form-control me-2  mt-2 text-white w-100  rounded"
                                style="border: 1px solid rgb(92, 92, 92); background-color: rgb(92, 92, 92);"
                                placeholder="Enter New Group Name">
                        </div>
                    </div>
                    <div class="modal-footer bg-dark" style="border-top: 1px solid grey">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-secondary text-dark">Save
                            Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal for file upload -->
    <div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-dark border-bottom-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('group#groupChatMessage') }}" enctype="multipart/form-data" method="post">
                    @csrf

                    <input type="hidden" name="gpId" value="{{ $groupChat->id }}">
                    <input type="hidden" name="userId" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="firstUser" value="{{ $groupChat->fir_user_id }}">
                    @if ($groupChat->sec_user_id != null)
                        <input type="hidden" name="secUser" value="{{ $groupChat->sec_user_id }}">
                    @endif
                    @if ($groupChat->a_user_id != null)
                        <input type="hidden" name="aUser" value="{{ $groupChat->a_user_id }}">
                    @endif
                    @if ($groupChat->b_user_id != null)
                        <input type="hidden" name="bUser" value="{{ $groupChat->b_user_id }}">
                    @endif
                    @if ($groupChat->c_user_id != null)
                        <input type="hidden" name="cUser" value="{{ $groupChat->c_user_id }}">
                    @endif
                    @if ($groupChat->d_user_id != null)
                        <input type="hidden" name="dUser" value="{{ $groupChat->d_user_id }}">
                    @endif
                    @if ($groupChat->e_user_id != null)
                        <input type="hidden" name="eUser" value="{{ $groupChat->e_user_id }}">
                    @endif
                    @if ($groupChat->f_user_id != null)
                        <input type="hidden" name="fUser" value="{{ $groupChat->f_user_id }}">
                    @endif
                    @if ($groupChat->g_user_id != null)
                        <input type="hidden" name="gUser" value="{{ $groupChat->g_user_id }}">
                    @endif
                    @if ($groupChat->h_user_id != null)
                        <input type="hidden" name="hUser" value="{{ $groupChat->h_user_id }}">
                    @endif

                    <div class="modal-body bg-dark">
                        <input type="file" name="image" class="form-control mb-3 text-white-50 w-100 rounded"
                            style="border: 1px solid rgb(92, 92, 92); background-color: rgb(92, 92, 92);">
                        <div class="row">
                            <div class="col-1 btn-group dropup ImageUpload">
                                <i class="fa-regular fa-face-smile text-white-50 fs-2" style="padding-top: 12px"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                <div class="dropdown-menu fromImageUpload mb-3 bg-dark">

                                    <div class="emoji-picker1">
                                        <div class="emoji-container1">

                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-9 pb-2">
                                <input class="form-control mt-2 text-white w-100 rounded-pill" id="message1"
                                    name="message"
                                    style="border: 1px solid rgb(92, 92, 92); background-color: rgb(92, 92, 92);"
                                    type="text" placeholder="Message ..." aria-label="Message ..."
                                    v-model="message">
                            </div>
                            <div class="rounded-pill col-2">
                                <button type="submit" class="btn mt-2 btn-secondary rounded-circle">
                                    <i class="fa-solid fa-paper-plane"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
    integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"
    integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(document).ready(function() {

        $.ajax({
            url: '/group/message/seen',
            type: 'GET',
            datatype: 'json',
            data: {
                'gpID': $('#groupID').val(),
            }
        })

        console.log($('#auth').val());
        console.log();

        $('#signOut').click(function() {
            $.ajax({
                url: '/status/offline',
                type: 'GET',
                datatype: 'json',
                data: {
                    'status': 'offline',
                }
            })
        })

        var $modal = $('#GpImageCrop');
        var image = document.getElementById('GpImage');
        var cropper;

        var element = document.getElementById("scroll");
        var scrolled = false;

        function updateScroll() {
            if (!scrolled) {
                element.scrollTop = element.scrollHeight;
            }
        }

        if ($('#exceedMember').html()) {
            $('.modalNewGroup').modal("show");
        }

        $("#scroll").on('scroll', function() {
            scrolled = true;
        });

        $(".clickToReply").mouseenter(function() {
            $(this).find('.reply').delay(400).fadeIn();
        })

        $(".clickToReply").mouseleave(function() {
            $(this).find('.reply').delay(300).fadeOut();
        })

        setInterval(updateScroll, 1000);

        $('#scrollDown').click(function() {
            $("#scroll").animate({
                scrollTop: $('#scroll')[0].scrollHeight
            }, 1000);
        })

        $("body").on("change", ".GpImage", function(e) {
            var files = e.target.files;
            var done = function(url) {
                image.src = url;
                $modal.modal('show');
            };

            var reader;
            var file;
            var url;

            if (files && files.length > 0) {
                file = files[0];

                if (URL) {
                    done(URL.createObjectURL(file));
                } else if (FileReader) {
                    reader = new FileReader();
                    reader.onload = function(e) {
                        done(reader.result);
                    };
                    reader.readAsDataURL(file);
                }
            }
        });

        $modal.on('shown.bs.modal', function() {
            cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 1,
                preview: '.preview'
            });
        }).on('hidden.bs.modal', function() {
            cropper.destroy();
            cropper = null;
        });

        $("#crop").click(function() {
            canvas = cropper.getCroppedCanvas({
                width: 160,
                height: 160,
            });

            canvas.toBlob(function(blob) {
                url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function() {
                    var base64data = reader.result;
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "/group/change/profile",
                        data: {
                            '_token': $('#_token').val(),
                            'id': $('#id').val(),
                            'image': base64data
                        },
                        success: function(data) {
                            $modal.modal('hide');
                            window.location.href = 'group/' + data.id;
                            console.log(data);
                        }
                    });
                }
            });
        });

        $('#dropup').click(function() {
            $('#dropdown-menu').dropdown('toggle');
        })


        $('.ImageUpload').click(function() {
            $('.fromImageUpload').dropdown('toggle');
        })

        const emojiContainer = document.querySelector('.emoji-container');
        const emojiContainer1 = document.querySelector('.emoji-container1');

        const messageInput = document.getElementById('message');
        const messageInput1 = document.getElementById('message1');


        const emojis = ['😀', '😢', '😄', '😉', '😡', '😕', '😴', '😍', '😚', '😘', '🎉', '🥳', '🚀', '🙌',
            '🔥', '❤️',
            '😆', '🤣', '😂', '👍', '👎', '😎', '😊', '🌈', '🍰', '🍨', '🍔', '🍟', '☕', '🍕', '☀️', '🎵',
            '🎥', '📸', '🌍', '✈️', '🕒', '⏰', '💋'
        ];

        emojis.forEach(emoji => {
            const emojiIcon = document.createElement('span');
            emojiIcon.className = 'emoji-icon';
            emojiIcon.textContent = emoji;
            emojiIcon.addEventListener('click', () => insertEmoji(emoji));
            emojiContainer.appendChild(emojiIcon);
        });

        emojis.forEach(emoji => {
            const emojiIcon = document.createElement('span');
            emojiIcon.className = 'emoji-icon';
            emojiIcon.textContent = emoji;
            emojiIcon.addEventListener('click', () => insertEmoji(emoji));
            emojiContainer1.appendChild(emojiIcon);
        });

        function insertEmoji(emoji) {
            const currentMessage = messageInput.value;
            const currentMessage1 = messageInput1.value;
            messageInput.value = currentMessage + emoji;
            messageInput1.value = currentMessage1 + emoji;
        }
    })
</script>

</html>
