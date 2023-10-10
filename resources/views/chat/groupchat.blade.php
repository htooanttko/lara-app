<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('image/icons8-leaf-48.png') }}">

    {{-- link  --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('css/group.css') }}">
        <link rel="stylesheet" href="{{ asset('css/light_dark.css') }}">
    <style>
        #displayMemberList::-webkit-scrollbar {
            display: none;
        }
        .blockedacc::-webkit-scrollbar {
            display: none;
        }
        #displayDetailFile::-webkit-scrollbar {
            display: none;
        }
        .displaySearchMessage::-webkit-scrollbar {
            display: none;
        }
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
            border: 2px solid #536dfe;
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

        body::-webkit-scrollbar {
            display: none;
        }

        .chat-body::-webkit-scrollbar {
            display: none;
        }

        .contact-body::-webkit-scrollbar {
            display: none;
        }

        .group-body::-webkit-scrollbar {
            display: none;
        }

        .setting-body::-webkit-scrollbar {
            display: none;
        }

        .display-message::-webkit-scrollbar {
            display: none;
        }
    </style>

    <title>SnapView</title>
</head>
<body class="row container-fluid">
    <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">

    @include('nav_&_aside')

    <main class=" col main-deskgroup">
        <div class=" group-chatting-section">
            <header class=" py-2 d-flex justify-content-between">
                <a href="{{ route('dashboard') }}" class="backDashboard"><i class=" fa-solid fa-angle-left tex-muted opacity-50"></i></a>
                <div class="group-name container">
                    <div class="row ">
                        <div class=" pt-2 ms-3" style="width: 68px">
                            <input type="hidden" id="groupID" value="{{ $groupChat->id }}">
                            <input type="hidden" id="AuthID" value="{{ Auth::user()->id }}">

                            @if ($groupChat->group_image == null)
                                <img src="{{ asset('image/gpDefault.jpg') }}" class="w-100 rounded-circle"
                                    alt="">
                            @else
                                <img src="{{ asset('storage/' . $groupChat->group_image) }}"
                                    class="w-100 rounded-circle" alt="">
                            @endif
                        </div>
                        <div class=" col mt-1">
                            <span class=" d-block lightTextClass fw-bold">{{ $groupChat->group_name }}</span>
                            @if (isset($groupChat->fir_user_id) && !isset($groupChat->sec_user_id))
                                <small class=" lightTextClass">2 members</small>
                            @endif
                            @if (isset($groupChat->sec_user_id) && !isset($groupChat->a_user_id))
                                <small class=" lightTextClass">3 members</small>
                            @endif
                            @if (isset($groupChat->a_user_id) && !isset($groupChat->b_user_id))
                                <small class=" lightTextClass">4 members</small>
                            @endif
                            @if (isset($groupChat->b_user_id) && !isset($groupChat->c_user_id))
                                <small class=" lightTextClass">5 members</small>
                            @endif
                            @if (isset($groupChat->c_user_id) && !isset($groupChat->d_user_id))
                                <small class=" lightTextClass">6 members</small>
                            @endif
                            @if (isset($groupChat->d_user_id) && !isset($groupChat->e_user_id))
                                <small class=" lightTextClass">7 members</small>
                            @endif
                            @if (isset($groupChat->e_user_id) && !isset($groupChat->f_user_id))
                                <small class=" lightTextClass">8 members</small>
                            @endif
                            @if (isset($groupChat->f_user_id) && !isset($groupChat->g_user_id))
                                <small class=" lightTextClass">9 members</small>
                            @endif
                            @if (isset($groupChat->g_user_id) && !isset($groupChat->h_user_id))
                                <small class=" lightTextClass">10 members</small>
                            @endif
                            @if (isset($groupChat->h_user_id))
                                <small class=" lightTextClass">11 members</small>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="set d-flex pt-2">
                    <i class="fa-solid fa-magnifying-glass lightTextClass pt-1" data-bs-toggle="modal" data-bs-target="#searchMessage"></i>
                    <div class="dropdown">
                        <i class="fa-solid fa-ellipsis-vertical lightTextClass ps-5 "  data-bs-toggle="dropdown" aria-expanded="false"></i>

                        <ul class="dropdown-menu">
                        <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#groupDetail"><small class=" lightTextClass "><i class="fa-solid fa-circle-info me-2 opacity-50"></i>Group Information</small></a></li>
                        @if ($groupChat->user_id == Auth::user()->id)
                            <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#addGpMember"><small class=" lightTextClass "><i class="fa-regular fa-square-plus me-2 opacity-50"></i>add member</small></a></li>
                            <li><a class="dropdown-item" href="{{ route('group#groupChatDelete',$groupChat->id) }}"><small  class=" text-danger"><i class="fa-regular fa-trash-can me-2"></i>delete group</small></a></li>
                        @else
                            <li><a class="dropdown-item" href="{{ route('group#groupChatLeave',$groupChat->id) }}"><small  class=" text-danger"><i class="fa-solid fa-right-to-bracket me-2"></i>exit group</small></a></li>
                        @endif
                        </ul>
                    </div>
                        {{-- modal for add member group --}}
                        <div class="modal fade" id="addGpMember" data-bs-backdrop="static" data-bs-keyboard="false"
                            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" style="width: 280px">
                                <div class="modal-content ">
                                    <div class="modal-header border-bottom-0">
                                        <h5 class="col-6 lightTextClass">Add member</h5>
                                        <button type="button" class="btn position-absolute mt-2 me-1 top-0 end-0"
                                            data-bs-dismiss="modal" aria-label="Close"><i
                                                class="fa-solid fa-xmark"></i></button>
                                    </div>
                                    <form action="{{ route('group#groupChatAddMember') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            @if(session('errorselect'))
                                                <div class="alert alert-warning alert-dismissible fade show errorselect" role="alert">
                                                    <span class="errorselectText">{{ session('errorselect') }}</span>

                                                </div>
                                            @endif

                                        <ul class=" list-unstyled overflow-x-scroll" id="contactScroll"
                                            style=" height:20vh;">

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
                                                <li class=" my-2 lightTextClass rounded border-dark">
                                                    <div class=" d-flex mx-3">
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
                                                        <div class=" col-1 pt-1">
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
                                        <div class="modal-footer ">
                                            <button type="submit" class=" btn btn-primary col opacity-75">Add Member</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    {{-- modal for add member group --}}
                    <!-- Modal for group detail start -->
                <div class="modal fade" id="groupDetail" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" style="width: 280px">
                        <div class="modal-content">
                        <div id="groupInfo">
                            <div class="modal-header border-bottom-0">
                                <h5 class="col-6 lightTextClass">Group Info</h5>
                                <button type="button" class="btn position-absolute mt-2 me-1 top-0 end-0" data-bs-dismiss="modal"
                                    aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
                            </div>
                            <div class="modal-body" style="border-bottom: 1px solid #eeeeee">
                            <div class="row">
                                <div class=" pt-2 ms-3" style="width: 68px">

                                    @if ($groupChat->group_image == null)
                                        <img src="{{ asset('image/gpDefault.jpg') }}" class="w-100 rounded-circle"
                                            alt="">
                                    @else
                                        <img src="{{ asset('storage/' . $groupChat->group_image) }}"
                                            class="w-100 rounded-circle" alt="">
                                    @endif
                                </div>
                                <div class=" col">
                                    <span class=" d-block lightTextClass fs-5">{{ $groupChat->group_name }}</span>
                                    @if (isset($groupChat->fir_user_id) && !isset($groupChat->sec_user_id))
                                        <small class=" lightTextClass">2 members</small>
                                    @endif
                                    @if (isset($groupChat->sec_user_id) && !isset($groupChat->a_user_id))
                                        <small class=" lightTextClass">3 members</small>
                                    @endif
                                    @if (isset($groupChat->a_user_id) && !isset($groupChat->b_user_id))
                                        <small class=" lightTextClass">4 members</small>
                                    @endif
                                    @if (isset($groupChat->b_user_id) && !isset($groupChat->c_user_id))
                                        <small class=" lightTextClass">5 members</small>
                                    @endif
                                    @if (isset($groupChat->c_user_id) && !isset($groupChat->d_user_id))
                                        <small class=" lightTextClass">6 members</small>
                                    @endif
                                    @if (isset($groupChat->d_user_id) && !isset($groupChat->e_user_id))
                                        <small class=" lightTextClass">7 members</small>
                                    @endif
                                    @if (isset($groupChat->e_user_id) && !isset($groupChat->f_user_id))
                                        <small class=" lightTextClass">8 members</small>
                                    @endif
                                    @if (isset($groupChat->f_user_id) && !isset($groupChat->g_user_id))
                                        <small class=" lightTextClass">9 members</small>
                                    @endif
                                    @if (isset($groupChat->g_user_id) && !isset($groupChat->h_user_id))
                                        <small class=" lightTextClass">10 members</small>
                                    @endif
                                    @if (isset($groupChat->h_user_id))
                                        <small class=" lightTextClass">11 members</small>
                                    @endif
                                </div>
                                <div class="col-2 text-right">
                                    <i class="fa-regular fa-pen-to-square fs-6 lightTextClass opacity-50 pt-3" style="font-size: smaller"  data-bs-toggle="modal" data-bs-target="#editGp"></i>
                                </div>

                            </div>
                            </div>
                            <div class="pt-3 ps-3" style="border-bottom: 1px solid #eeeeee">

                                <div class="lightTextClass d-flex " id="member" style="cursor: pointer"><p class="col"><i class="fa-regular fa-user px-3 opacity-50"></i>Members</p><p class=" pe-4" style="width: 10px"><i class="fa-solid fa-angle-right"></i></p></div>
                                <div class="lightTextClass d-flex " id="sharedMedia" style="cursor: pointer"><p class="col"><i class="fa-solid fa-share-nodes px-3 opacity-50"></i>Shared Media</p><p class=" pe-4" style="width: 10px"><i class="fa-solid fa-angle-right"></i></p></div>

                        </div>
                        <div class="pt-3 ps-3">

                            <a href="{{ route('group#groupChatLeave',$groupChat->id) }}" class=" text-decoration-none"><p class="text-danger"><i class="fa-solid fa-right-to-bracket px-3"></i>exit group</p></a>
                    </div>
                        </div>

                            <div id="displayMember"  style="display: none"  >
                                <div class="modal-header border-bottom-0">
                                    <h5 class="col-8 lightTextClass">Members</h5>
                                    <button type="button" class="btn position-absolute mt-2 me-1 top-0 end-0" id="backMember"><i class="fa-solid fa-angles-left opacity-50"></i></button>
                                </div>
                                <div class="modal-body overflow-y-scroll" id="displayMemberList"  style="height: 45vh;">
                                    <div class=" row py-2 " >
                                        <input type="hidden" id="user" name="user" value="{{ $user->id }}">
                                        <input type="hidden" id="userName" name="userName" value="{{ $user->name }}">
                                        <div style="width: 68px">
                                            @if ($user->image == null)
                                                <img src="{{ asset('image/defaultpic.jpg') }}"
                                                    class="w-100  mt-1 rounded-circle " id="userImageDef" alt="">
                                            @else
                                                <img src="{{ asset('storage/' . $user->image) }}"
                                                    class="w-100  rounded-circle mt-1 " id="userImage" alt="">
                                            @endif
                                        </div>
                                        <div class=" col ">
                                            @if ($user->id == Auth::user()->id)
                                            <span class="lightTextClass fw-bold d-block">You</span>
                                            @else
                                            <span class="lightTextClass fw-bold d-block">{{ $user->name }}</span>
                                            @endif
                                            @if ($user->status == 'online')
                                                <small class=" lightTextClass">{{ $user->status }}</small>
                                            @else
                                                @if (date('H') * 60 + date('i') - ($user->updated_at->format('H') * 60 + $user->updated_at->format('i')) > 60)
                                                    <small class=" lightTextClass">Active
                                                        {{ date('H') - $user->updated_at->format('H') }}
                                                        hours ago</small>
                                                @elseif (date('H') * 60 + date('i') - ($user->updated_at->format('H') * 60 + $user->updated_at->format('i')) == 0)
                                                    <small class=" lightTextClass">Active a minute ago
                                                    </small>
                                                @elseif (date('H') * 60 + date('i') - ($user->updated_at->format('H') * 60 + $user->updated_at->format('i')) > 1140)
                                                    <small class=" lightTextClass">Active
                                                        {{ date('d') - $user->updated_at->format('d') }}
                                                        days ago</small>
                                                @elseif (date('H') * 60 + date('i') - ($user->updated_at->format('H') * 60 + $user->updated_at->format('i')) > 43200)
                                                    <small class=" lightTextClass">Active
                                                        {{ date('m') - $user->updated_at->format('m') }}
                                                        months ago</small>
                                                @elseif (date('H') * 60 + date('i') - ($user->updated_at->format('H') * 60 + $user->updated_at->format('i')) > 525600)
                                                    <small class=" lightTextClass">Active
                                                        {{ date('Y') - $user->updated_at->format('Y') }}
                                                        years ago</small>
                                                @else
                                                    @if ($user->updated_at->format('H') * 60 + $user->updated_at->format('i') <= date('H') * 60 + date('i'))
                                                        <small class=" lightTextClass">Active
                                                            {{ date('H') * 60 + date('i') - ($user->updated_at->format('H') * 60 + $user->updated_at->format('i')) }}
                                                            minute ago
                                                        </small>
                                                    @endif
                                                @endif
                                            @endif
                                        </div>
                                        <div class=" col-3">
                                            <small class=" text-info text-start d-block" style="font-size:smaller">admin</small>
                                        </div>

                                    </div>

                                    @if (isset($firUser))
                                        <div class=" row py-2">
                                        <input type="hidden" id="firUserName" name="firUserName" value="{{ $firUser->name }}">

                                            <div style="width: 68px">
                                                @if ($firUser->image == null)
                                                    <img src="{{ asset('image/defaultpic.jpg') }}"
                                                        class="w-100  mt-1 rounded-circle "  id="firUserImageDef" alt="">
                                                @else
                                                    <img src="{{ asset('storage/' . $firUser->image) }}"
                                                        class="w-100  rounded-circle mt-1 " id="firUserImage" alt="">
                                                @endif
                                            </div>
                                            <div class=" col ">
                                                @if ($firUser->id == Auth::user()->id)
                                            <span class="lightTextClass fw-bold d-block">You</span>
                                            @else
                                            <span class="lightTextClass fw-bold d-block">{{ $firUser->name }}</span>
                                            @endif
                                                @if ($firUser->status == 'online')
                                                    <small class=" lightTextClass">{{ $firUser->status }}</small>
                                                @else
                                                    @if (date('H') * 60 + date('i') - ($firUser->updated_at->format('H') * 60 + $firUser->updated_at->format('i')) > 60)
                                                        <small class=" lightTextClass">Active
                                                            {{ date('H') - $firUser->updated_at->format('H') }}
                                                            hours ago</small>
                                                    @elseif (date('H') * 60 + date('i') - ($firUser->updated_at->format('H') * 60 + $firUser->updated_at->format('i')) == 0)
                                                        <small class=" lightTextClass">Active a minute ago
                                                        </small>
                                                    @elseif (date('H') * 60 + date('i') - ($firUser->updated_at->format('H') * 60 + $firUser->updated_at->format('i')) > 1140)
                                                        <small class=" lightTextClass">Active
                                                            {{ date('d') - $firUser->updated_at->format('d') }}
                                                            days ago</small>
                                                    @elseif (date('H') * 60 + date('i') - ($firUser->updated_at->format('H') * 60 + $firUser->updated_at->format('i')) > 43200)
                                                        <small class=" lightTextClass">Active
                                                            {{ date('m') - $firUser->updated_at->format('m') }}
                                                            months ago</small>
                                                    @elseif (date('H') * 60 + date('i') - ($firUser->updated_at->format('H') * 60 + $firUser->updated_at->format('i')) > 525600)
                                                        <small class=" lightTextClass">Active
                                                            {{ date('Y') - $firUser->updated_at->format('Y') }}
                                                            years ago</small>
                                                    @else
                                                        @if ($firUser->updated_at->format('H') * 60 + $firUser->updated_at->format('i') <= date('H') * 60 + date('i'))
                                                            <small class=" lightTextClass">Active
                                                                {{ date('H') * 60 + date('i') - ($firUser->updated_at->format('H') * 60 + $firUser->updated_at->format('i')) }}
                                                                minute ago
                                                            </small>
                                                        @endif
                                                    @endif
                                                @endif
                                            </div>

                                        </div>
                                    @endif
                                    @if (isset($secUser))
                                        <div class=" row py-2">
                                        <input type="hidden" id="secUserName" name="secUserName" value="{{ $secUser->name }}">

                                            <div style="width: 68px">
                                                @if ($secUser->image == null)
                                                    <img src="{{ asset('image/defaultpic.jpg') }}"
                                                        class="w-100  mt-1 rounded-circle" id="secUserImageDef" alt="">
                                                @else
                                                    <img src="{{ asset('storage/' . $secUser->image) }}"
                                                        class="w-100  rounded-circle mt-1" id="secUserImage" alt="">
                                                @endif
                                            </div>
                                            <div class=" col ">
                                                @if ($secUser->id == Auth::user()->id)
                                            <span class="lightTextClass fw-bold d-block">You</span>
                                            @else
                                            <span class="lightTextClass fw-bold d-block">{{ $secUser->name }}</span>
                                            @endif
                                                @if ($secUser->status == 'online')
                                                    <small class=" lightTextClass">{{ $secUser->status }}</small>
                                                @else
                                                    @if (date('H') * 60 + date('i') - ($secUser->updated_at->format('H') * 60 + $secUser->updated_at->format('i')) > 60)
                                                        <small class=" lightTextClass">Active
                                                            {{ date('H') - $secUser->updated_at->format('H') }}
                                                            hours ago</small>
                                                    @elseif (date('H') * 60 + date('i') - ($secUser->updated_at->format('H') * 60 + $secUser->updated_at->format('i')) == 0)
                                                        <small class=" lightTextClass">Active a minute ago
                                                        </small>
                                                    @elseif (date('H') * 60 + date('i') - ($secUser->updated_at->format('H') * 60 + $secUser->updated_at->format('i')) > 1140)
                                                        <small class=" lightTextClass">Active
                                                            {{ date('d') - $secUser->updated_at->format('d') }}
                                                            days ago</small>
                                                    @elseif (date('H') * 60 + date('i') - ($secUser->updated_at->format('H') * 60 + $secUser->updated_at->format('i')) > 43200)
                                                        <small class=" lightTextClass">Active
                                                            {{ date('m') - $secUser->updated_at->format('m') }}
                                                            months ago</small>
                                                    @elseif (date('H') * 60 + date('i') - ($secUser->updated_at->format('H') * 60 + $secUser->updated_at->format('i')) > 525600)
                                                        <small class=" lightTextClass">Active
                                                            {{ date('Y') - $secUser->updated_at->format('Y') }}
                                                            years ago</small>
                                                    @else
                                                        @if ($secUser->updated_at->format('H') * 60 + $secUser->updated_at->format('i') <= date('H') * 60 + date('i'))
                                                            <small class=" lightTextClass">Active
                                                                {{ date('H') * 60 + date('i') - ($secUser->updated_at->format('H') * 60 + $secUser->updated_at->format('i')) }}
                                                                minute ago
                                                            </small>
                                                        @endif
                                                    @endif
                                                @endif
                                            </div>

                                        </div>
                                    @endif
                                    @if (isset($aUser))
                                        <div class=" row py-2">
                                            <input type="hidden" id="aUserName" name="aUserName" value="{{ $aUser->name }}">

                                            <div style="width: 68px">
                                                @if ($aUser->image == null)
                                                    <img src="{{ asset('image/defaultpic.jpg') }}"
                                                        class="w-100  mt-1 rounded-circle " id="aUserImageDef" alt="">
                                                @else
                                                    <img src="{{ asset('storage/' . $aUser->image) }}"
                                                        class="w-100  rounded-circle mt-1 " id="aUserImage"  alt="">
                                                @endif
                                            </div>
                                            <div class=" col ">
                                                @if ($aUser->id == Auth::user()->id)
                                                <span class="lightTextClass fw-bold d-block">You</span>
                                                @else
                                                <span class="lightTextClass fw-bold d-block">{{ $aUser->name }}</span>
                                                @endif
                                                @if ($aUser->status == 'online')
                                                    <small class=" lightTextClass">{{ $aUser->status }}</small>
                                                @else
                                                    @if (date('H') * 60 + date('i') - ($aUser->updated_at->format('H') * 60 + $aUser->updated_at->format('i')) > 60)
                                                        <small class=" lightTextClass">Active
                                                            {{ date('H') - $aUser->updated_at->format('H') }}
                                                            hours ago</small>
                                                    @elseif (date('H') * 60 + date('i') - ($aUser->updated_at->format('H') * 60 + $aUser->updated_at->format('i')) == 0)
                                                        <small class=" lightTextClass">Active a minute ago
                                                        </small>
                                                    @elseif (date('H') * 60 + date('i') - ($aUser->updated_at->format('H') * 60 + $aUser->updated_at->format('i')) > 1140)
                                                        <small class=" lightTextClass">Active
                                                            {{ date('d') - $aUser->updated_at->format('d') }}
                                                            days ago</small>
                                                    @elseif (date('H') * 60 + date('i') - ($aUser->updated_at->format('H') * 60 + $aUser->updated_at->format('i')) > 43200)
                                                        <small class=" lightTextClass">Active
                                                            {{ date('m') - $aUser->updated_at->format('m') }}
                                                            months ago</small>
                                                    @elseif (date('H') * 60 + date('i') - ($aUser->updated_at->format('H') * 60 + $aUser->updated_at->format('i')) > 525600)
                                                        <small class=" lightTextClass">Active
                                                            {{ date('Y') - $aUser->updated_at->format('Y') }}
                                                            years ago</small>
                                                    @else
                                                        @if ($aUser->updated_at->format('H') * 60 + $aUser->updated_at->format('i') <= date('H') * 60 + date('i'))
                                                            <small class=" lightTextClass">Active
                                                                {{ date('H') * 60 + date('i') - ($aUser->updated_at->format('H') * 60 + $aUser->updated_at->format('i')) }}
                                                                minute ago
                                                            </small>
                                                        @endif
                                                    @endif
                                                @endif
                                            </div>

                                        </div>
                                    @endif
                                    @if (isset($bUser))
                                        <div class=" row py-2">
                                            <input type="hidden" id="bUserName" name="bUserName" value="{{ $bUser->name }}">

                                            <div style="width: 68px">
                                                @if ($bUser->image == null)
                                                    <img src="{{ asset('image/defaultpic.jpg') }}"
                                                        class="w-100  mt-1 rounded-circle " id="bUserImageDef" alt="">
                                                @else
                                                    <img src="{{ asset('storage/' . $bUser->image) }}"
                                                        class="w-100  rounded-circle mt-1 "  id="bUserImage" alt="">
                                                @endif
                                            </div>
                                            <div class=" col ">
                                                @if ($bUser->id == Auth::user()->id)
                                                <span class="lightTextClass fw-bold d-block">You</span>
                                                @else
                                                <span class="lightTextClass fw-bold d-block">{{ $bUser->name }}</span>
                                                @endif
                                                @if ($bUser->status == 'online')
                                                    <small class=" lightTextClass">{{ $bUser->status }}</small>
                                                @else
                                                    @if (date('H') * 60 + date('i') - ($bUser->updated_at->format('H') * 60 + $bUser->updated_at->format('i')) > 60)
                                                        <small class=" lightTextClass">Active
                                                            {{ date('H') - $bUser->updated_at->format('H') }}
                                                            hours ago</small>
                                                    @elseif (date('H') * 60 + date('i') - ($bUser->updated_at->format('H') * 60 + $bUser->updated_at->format('i')) == 0)
                                                        <small class=" lightTextClass">Active a minute ago
                                                        </small>
                                                    @elseif (date('H') * 60 + date('i') - ($bUser->updated_at->format('H') * 60 + $bUser->updated_at->format('i')) > 1140)
                                                        <small class=" lightTextClass">Active
                                                            {{ date('d') - $bUser->updated_at->format('d') }}
                                                            days ago</small>
                                                    @elseif (date('H') * 60 + date('i') - ($bUser->updated_at->format('H') * 60 + $bUser->updated_at->format('i')) > 43200)
                                                        <small class=" lightTextClass">Active
                                                            {{ date('m') - $bUser->updated_at->format('m') }}
                                                            months ago</small>
                                                    @elseif (date('H') * 60 + date('i') - ($bUser->updated_at->format('H') * 60 + $bUser->updated_at->format('i')) > 525600)
                                                        <small class=" lightTextClass">Active
                                                            {{ date('Y') - $bUser->updated_at->format('Y') }}
                                                            years ago</small>
                                                    @else
                                                        @if ($bUser->updated_at->format('H') * 60 + $bUser->updated_at->format('i') <= date('H') * 60 + date('i'))
                                                            <small class=" lightTextClass">Active
                                                                {{ date('H') * 60 + date('i') - ($bUser->updated_at->format('H') * 60 + $bUser->updated_at->format('i')) }}
                                                                minute ago
                                                            </small>
                                                        @endif
                                                    @endif
                                                @endif
                                            </div>

                                        </div>
                                    @endif
                                    @if (isset($cUser))
                                        <div class=" row py-2">
                                            <input type="hidden" id="cUserName" name="cUserName" value="{{ $cUser->name }}">

                                            <div style="width: 68px">
                                                @if ($cUser->image == null)
                                                    <img src="{{ asset('image/defaultpic.jpg') }}"
                                                        class="w-100  mt-1 rounded-circle " id="cUserImageDef" alt="">
                                                @else
                                                    <img src="{{ asset('storage/' . $cUser->image) }}"
                                                        class="w-100  rounded-circle mt-1 "  id="cUserImage" alt="">
                                                @endif
                                            </div>
                                            <div class=" col ">
                                                @if ($cUser->id == Auth::user()->id)
                                                <span class="lightTextClass fw-bold d-block">You</span>
                                                @else
                                                <span class="lightTextClass fw-bold d-block">{{ $cUser->name }}</span>
                                                @endif
                                                @if ($cUser->status == 'online')
                                                    <small class=" lightTextClass">{{ $cUser->status }}</small>
                                                @else
                                                    @if (date('H') * 60 + date('i') - ($cUser->updated_at->format('H') * 60 + $cUser->updated_at->format('i')) > 60)
                                                        <small class=" lightTextClass">Active
                                                            {{ date('H') - $cUser->updated_at->format('H') }}
                                                            hours ago</small>
                                                    @elseif (date('H') * 60 + date('i') - ($cUser->updated_at->format('H') * 60 + $cUser->updated_at->format('i')) == 0)
                                                        <small class=" lightTextClass">Active a minute ago
                                                        </small>
                                                    @elseif (date('H') * 60 + date('i') - ($cUser->updated_at->format('H') * 60 + $cUser->updated_at->format('i')) > 1140)
                                                        <small class=" lightTextClass">Active
                                                            {{ date('d') - $cUser->updated_at->format('d') }}
                                                            days ago</small>
                                                    @elseif (date('H') * 60 + date('i') - ($cUser->updated_at->format('H') * 60 + $cUser->updated_at->format('i')) > 43200)
                                                        <small class=" lightTextClass">Active
                                                            {{ date('m') - $cUser->updated_at->format('m') }}
                                                            months ago</small>
                                                    @elseif (date('H') * 60 + date('i') - ($cUser->updated_at->format('H') * 60 + $cUser->updated_at->format('i')) > 525600)
                                                        <small class=" lightTextClass">Active
                                                            {{ date('Y') - $cUser->updated_at->format('Y') }}
                                                            years ago</small>
                                                    @else
                                                        @if ($cUser->updated_at->format('H') * 60 + $cUser->updated_at->format('i') <= date('H') * 60 + date('i'))
                                                            <small class=" lightTextClass">Active
                                                                {{ date('H') * 60 + date('i') - ($cUser->updated_at->format('H') * 60 + $cUser->updated_at->format('i')) }}
                                                                minute ago
                                                            </small>
                                                        @endif
                                                    @endif
                                                @endif
                                            </div>

                                        </div>
                                    @endif
                                    @if (isset($dUser))
                                        <div class=" row py-2">
                                            <input type="hidden" id="dUserName" name="dUserName" value="{{ $dUser->name }}">

                                            <div  style="width: 68px">
                                                @if ($dUser->image == null)
                                                    <img src="{{ asset('image/defaultpic.jpg') }}"
                                                        class="w-100  mt-1 rounded-circle " id="dUserImageDef" alt="">
                                                @else
                                                    <img src="{{ asset('storage/' . $dUser->image) }}"
                                                        class="w-100  rounded-circle mt-1 " id="dUserImage" alt="">
                                                @endif
                                            </div>
                                            <div class=" col ">
                                                @if ($dUser->id == Auth::user()->id)
                                                <span class="lightTextClass fw-bold d-block">You</span>
                                                @else
                                                <span class="lightTextClass fw-bold d-block">{{ $dUser->name }}</span>
                                                @endif
                                                @if ($dUser->status == 'online')
                                                    <small class=" lightTextClass">{{ $dUser->status }}</small>
                                                @else
                                                    @if (date('H') * 60 + date('i') - ($dUser->updated_at->format('H') * 60 + $dUser->updated_at->format('i')) > 60)
                                                        <small class=" lightTextClass">Active
                                                            {{ date('H') - $dUser->updated_at->format('H') }}
                                                            hours ago</small>
                                                    @elseif (date('H') * 60 + date('i') - ($dUser->updated_at->format('H') * 60 + $dUser->updated_at->format('i')) == 0)
                                                        <small class=" lightTextClass">Active a minute ago
                                                        </small>
                                                    @elseif (date('H') * 60 + date('i') - ($dUser->updated_at->format('H') * 60 + $dUser->updated_at->format('i')) > 1140)
                                                        <small class=" lightTextClass">Active
                                                            {{ date('d') - $dUser->updated_at->format('d') }}
                                                            days ago</small>
                                                    @elseif (date('H') * 60 + date('i') - ($dUser->updated_at->format('H') * 60 + $dUser->updated_at->format('i')) > 43200)
                                                        <small class=" lightTextClass">Active
                                                            {{ date('m') - $dUser->updated_at->format('m') }}
                                                            months ago</small>
                                                    @elseif (date('H') * 60 + date('i') - ($dUser->updated_at->format('H') * 60 + $dUser->updated_at->format('i')) > 525600)
                                                        <small class=" lightTextClass">Active
                                                            {{ date('Y') - $dUser->updated_at->format('Y') }}
                                                            years ago</small>
                                                    @else
                                                        @if ($dUser->updated_at->format('H') * 60 + $dUser->updated_at->format('i') <= date('H') * 60 + date('i'))
                                                            <small class=" lightTextClass">Active
                                                                {{ date('H') * 60 + date('i') - ($dUser->updated_at->format('H') * 60 + $dUser->updated_at->format('i')) }}
                                                                minute ago
                                                            </small>
                                                        @endif
                                                    @endif
                                                @endif
                                            </div>

                                        </div>
                                    @endif
                                    @if (isset($eUser))
                                        <div class=" row py-2">
                                            <input type="hidden" id="eUserName" name="eUserName" value="{{ $eUser->name }}">

                                            <div style="width: 68px">
                                                @if ($eUser->image == null)
                                                    <img src="{{ asset('image/defaultpic.jpg') }}"
                                                        class="w-100  mt-1 rounded-circle " id="eUserImageDef" alt="">
                                                @else
                                                    <img src="{{ asset('storage/' . $eUser->image) }}"
                                                        class="w-100  rounded-circle mt-1 " id="eUserImage" alt="">
                                                @endif
                                            </div>
                                            <div class=" col ">
                                                @if ($eUser->id == Auth::user()->id)
                                                <span class="lightTextClass fw-bold d-block">You</span>
                                                @else
                                                <span class="lightTextClass fw-bold d-block">{{ $eUser->name }}</span>
                                                @endif
                                                @if ($eUser->status == 'online')
                                                    <small class=" lightTextClass">{{ $eUser->status }}</small>
                                                @else
                                                    @if (date('H') * 60 + date('i') - ($eUser->updated_at->format('H') * 60 + $eUser->updated_at->format('i')) > 60)
                                                        <small class=" lightTextClass">Active
                                                            {{ date('H') - $eUser->updated_at->format('H') }}
                                                            hours ago</small>
                                                    @elseif (date('H') * 60 + date('i') - ($eUser->updated_at->format('H') * 60 + $eUser->updated_at->format('i')) == 0)
                                                        <small class=" lightTextClass">Active a minute ago
                                                        </small>
                                                    @elseif (date('H') * 60 + date('i') - ($eUser->updated_at->format('H') * 60 + $eUser->updated_at->format('i')) > 1140)
                                                        <small class=" lightTextClass">Active
                                                            {{ date('d') - $eUser->updated_at->format('d') }}
                                                            days ago</small>
                                                    @elseif (date('H') * 60 + date('i') - ($eUser->updated_at->format('H') * 60 + $eUser->updated_at->format('i')) > 43200)
                                                        <small class=" lightTextClass">Active
                                                            {{ date('m') - $eUser->updated_at->format('m') }}
                                                            months ago</small>
                                                    @elseif (date('H') * 60 + date('i') - ($eUser->updated_at->format('H') * 60 + $eUser->updated_at->format('i')) > 525600)
                                                        <small class=" lightTextClass">Active
                                                            {{ date('Y') - $eUser->updated_at->format('Y') }}
                                                            years ago</small>
                                                    @else
                                                        @if ($eUser->updated_at->format('H') * 60 + $eUser->updated_at->format('i') <= date('H') * 60 + date('i'))
                                                            <small class=" lightTextClass">Active
                                                                {{ date('H') * 60 + date('i') - ($eUser->updated_at->format('H') * 60 + $eUser->updated_at->format('i')) }}
                                                                minute ago
                                                            </small>
                                                        @endif
                                                    @endif
                                                @endif
                                            </div>

                                        </div>
                                    @endif
                                    @if (isset($fUser))
                                        <div class=" row py-2 ">
                                            <input type="hidden" id="fUserName" name="fUserName" value="{{ $fUser->name }}">

                                            <div style="width: 68px">
                                                @if ($fUser->image == null)
                                                    <img src="{{ asset('image/defaultpic.jpg') }}"
                                                        class="w-100  mt-1 rounded-circle " id="fUserImageDef" alt="">
                                                @else
                                                    <img src="{{ asset('storage/' . $fUser->image) }}"
                                                        class="w-100  rounded-circle mt-1 " id="fUserImage" alt="">
                                                @endif
                                            </div>
                                            <div class=" col ">
                                                @if ($fUser->id == Auth::user()->id)
                                                <span class="lightTextClass fw-bold d-block">You</span>
                                                @else
                                                <span class="lightTextClass fw-bold d-block">{{ $fUser->name }}</span>
                                                @endif
                                                @if ($fUser->status == 'online')
                                                    <small class=" lightTextClass">{{ $fUser->status }}</small>
                                                @else
                                                    @if (date('H') * 60 + date('i') - ($fUser->updated_at->format('H') * 60 + $fUser->updated_at->format('i')) > 60)
                                                        <small class=" lightTextClass">Active
                                                            {{ date('H') - $fUser->updated_at->format('H') }}
                                                            hours ago</small>
                                                    @elseif (date('H') * 60 + date('i') - ($fUser->updated_at->format('H') * 60 + $fUser->updated_at->format('i')) == 0)
                                                        <small class=" lightTextClass">Active a minute ago
                                                        </small>
                                                    @elseif (date('H') * 60 + date('i') - ($fUser->updated_at->format('H') * 60 + $fUser->updated_at->format('i')) > 1140)
                                                        <small class=" lightTextClass">Active
                                                            {{ date('d') - $fUser->updated_at->format('d') }}
                                                            days ago</small>
                                                    @elseif (date('H') * 60 + date('i') - ($fUser->updated_at->format('H') * 60 + $fUser->updated_at->format('i')) > 43200)
                                                        <small class=" lightTextClass">Active
                                                            {{ date('m') - $fUser->updated_at->format('m') }}
                                                            months ago</small>
                                                    @elseif (date('H') * 60 + date('i') - ($fUser->updated_at->format('H') * 60 + $fUser->updated_at->format('i')) > 525600)
                                                        <small class=" lightTextClass">Active
                                                            {{ date('Y') - $fUser->updated_at->format('Y') }}
                                                            years ago</small>
                                                    @else
                                                        @if ($fUser->updated_at->format('H') * 60 + $fUser->updated_at->format('i') <= date('H') * 60 + date('i'))
                                                            <small class=" lightTextClass">Active
                                                                {{ date('H') * 60 + date('i') - ($fUser->updated_at->format('H') * 60 + $fUser->updated_at->format('i')) }}
                                                                minute ago
                                                            </small>
                                                        @endif
                                                    @endif
                                                @endif
                                            </div>

                                        </div>
                                    @endif
                                    @if (isset($gUser))
                                        <div class=" row py-2 ">
                                            <input type="hidden" id="gUserName" name="gUserName" value="{{ $gUser->name }}">

                                            <div style="width: 68px">
                                                @if ($gUser->image == null)
                                                    <img src="{{ asset('image/defaultpic.jpg') }}"
                                                        class="w-100  mt-1 rounded-circle "  id="gUserImageDef" alt="">
                                                @else
                                                    <img src="{{ asset('storage/' . $gUser->image) }}"
                                                        class="w-100  rounded-circle mt-1 " id="gUserImage" alt="">
                                                @endif
                                            </div>
                                            <div class=" col ">
                                                @if ($gUser->id == Auth::user()->id)
                                                <span class="lightTextClass fw-bold d-block">You</span>
                                                @else
                                                <span class="lightTextClass fw-bold d-block">{{ $gUser->name }}</span>
                                                @endif
                                                @if ($gUser->status == 'online')
                                                    <small class=" lightTextClass">{{ $gUser->status }}</small>
                                                @else
                                                    @if (date('H') * 60 + date('i') - ($gUser->updated_at->format('H') * 60 + $gUser->updated_at->format('i')) > 60)
                                                        <small class=" lightTextClass">Active
                                                            {{ date('H') - $gUser->updated_at->format('H') }}
                                                            hours ago</small>
                                                    @elseif (date('H') * 60 + date('i') - ($gUser->updated_at->format('H') * 60 + $gUser->updated_at->format('i')) == 0)
                                                        <small class=" lightTextClass">Active a minute ago
                                                        </small>
                                                    @elseif (date('H') * 60 + date('i') - ($gUser->updated_at->format('H') * 60 + $gUser->updated_at->format('i')) > 1140)
                                                        <small class=" lightTextClass">Active
                                                            {{ date('d') - $gUser->updated_at->format('d') }}
                                                            days ago</small>
                                                    @elseif (date('H') * 60 + date('i') - ($gUser->updated_at->format('H') * 60 + $gUser->updated_at->format('i')) > 43200)
                                                        <small class=" lightTextClass">Active
                                                            {{ date('m') - $gUser->updated_at->format('m') }}
                                                            months ago</small>
                                                    @elseif (date('H') * 60 + date('i') - ($gUser->updated_at->format('H') * 60 + $gUser->updated_at->format('i')) > 525600)
                                                        <small class=" lightTextClass">Active
                                                            {{ date('Y') - $gUser->updated_at->format('Y') }}
                                                            years ago</small>
                                                    @else
                                                        @if ($gUser->updated_at->format('H') * 60 + $gUser->updated_at->format('i') <= date('H') * 60 + date('i'))
                                                            <small class=" lightTextClass">Active
                                                                {{ date('H') * 60 + date('i') - ($gUser->updated_at->format('H') * 60 + $gUser->updated_at->format('i')) }}
                                                                minute ago
                                                            </small>
                                                        @endif
                                                    @endif
                                                @endif
                                            </div>

                                        </div>
                                    @endif
                                    @if (isset($hUser))
                                        <div class=" row py-2">
                                            <input type="hidden" id="hUserName" name="hUserName" value="{{ $hUser->name }}">

                                            <div style="width: 68px">
                                                @if ($hUser->image == null)
                                                    <img src="{{ asset('image/defaultpic.jpg') }}"
                                                        class="w-100  mt-1 rounded-circle " id="hUserImageDef" alt="">
                                                @else
                                                    <img src="{{ asset('storage/' . $hUser->image) }}"
                                                        class="w-100  rounded-circle mt-1 " id="hUserImage" alt="">
                                                @endif
                                            </div>
                                            <div class=" col ">
                                                @if ($hUser->id == Auth::user()->id)
                                                <span class="lightTextClass fw-bold d-block">You</span>
                                                @else
                                                <span class="lightTextClass fw-bold d-block">{{ $hUser->name }}</span>
                                                @endif
                                                @if ($hUser->status == 'online')
                                                    <small class=" lightTextClass">{{ $hUser->status }}</small>
                                                @else
                                                    @if (date('H') * 60 + date('i') - ($hUser->updated_at->format('H') * 60 + $hUser->updated_at->format('i')) > 60)
                                                        <small class=" lightTextClass">Active
                                                            {{ date('H') - $hUser->updated_at->format('H') }}
                                                            hours ago</small>
                                                    @elseif (date('H') * 60 + date('i') - ($hUser->updated_at->format('H') * 60 + $hUser->updated_at->format('i')) == 0)
                                                        <small class=" lightTextClass">Active a minute ago
                                                        </small>
                                                    @elseif (date('H') * 60 + date('i') - ($hUser->updated_at->format('H') * 60 + $hUser->updated_at->format('i')) > 1140)
                                                        <small class=" lightTextClass">Active
                                                            {{ date('d') - $hUser->updated_at->format('d') }}
                                                            days ago</small>
                                                    @elseif (date('H') * 60 + date('i') - ($hUser->updated_at->format('H') * 60 + $hUser->updated_at->format('i')) > 43200)
                                                        <small class=" lightTextClass">Active
                                                            {{ date('m') - $hUser->updated_at->format('m') }}
                                                            months ago</small>
                                                    @elseif (date('H') * 60 + date('i') - ($hUser->updated_at->format('H') * 60 + $hUser->updated_at->format('i')) > 525600)
                                                        <small class=" lightTextClass">Active
                                                            {{ date('Y') - $hUser->updated_at->format('Y') }}
                                                            years ago</small>
                                                    @else
                                                        @if ($hUser->updated_at->format('H') * 60 + $hUser->updated_at->format('i') <= date('H') * 60 + date('i'))
                                                            <small class=" lightTextClass">Active
                                                                {{ date('H') * 60 + date('i') - ($hUser->updated_at->format('H') * 60 + $hUser->updated_at->format('i')) }}
                                                                minute ago
                                                            </small>
                                                        @endif
                                                    @endif
                                                @endif
                                            </div>

                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div  id="displaySharedMedia" style="display: none"  >
                                <div class="modal-header border-bottom-0">
                                    <h5 class="col-8 lightTextClass">Shared Media</h5>
                                    <button type="button" class="btn position-absolute mt-2 me-1 top-0 end-0" id="backDetail"><i class="fa-solid fa-angles-left opacity-50"></i></button>
                                </div>
                                <div class="modal-body overflow-y-scroll d-grid" id="displayDetailFile"  style="height: 45vh;grid-template-columns:auto auto auto;">
                                    @if (isset($imageOrder->image,$imageOrder->video))
                                    @foreach ($imageOrder as $io)
                                        @if ($io->image != null)
                                            <div class="p-1  overflow-hidden" style="width: 82px; height:70px">
                                                <img src="{{ asset('storage/'.$io->image) }}" class="w-100" id="detailImage" alt="">
                                            </div>

                                        @elseif ($io->video != null)
                                            <div  class="p-1 position-relative overflow-hidden" style="width: 82px;height:70px" >
                                                <video class=" w-100">
                                                    <source src="{{ asset('storage/'.$io->video) }}">
                                                </video>
                                                <i class="fa-solid fa-circle-play position-absolute text-white fs-6"
                                                style="top: 38%; left: 40%"></i>
                                            </div>

                                        @endif
                                    @endforeach
                                    @else
                                        <div class=" text-center mt-5 ms-2 lightTextClass">
                                            <p class=" fw-bold">No Media</p>
                                            <p>No media in this conversations</p>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            {{-- <div>
                                @if (isset($user))
                                        <input type="hidden" id="user" name="user" value="{{ $user->id }}">
                                        <input type="hidden" id="userName" name="userName" value="{{ $user->name }}">
                                        @if ($user->image == null)
                                            <img src="{{ asset('image/defaultpic.jpg') }}"
                                                class="w-100 rounded-circle shadow-lg" id="userImageDef" alt="">
                                        @else
                                            <img src="{{ asset('storage/' . $user->image) }}"
                                                class="w-100 rounded-circle shadow-lg" id="userImage" alt="">
                                        @endif
                                @endif
                                @if (isset($firUser))
                                    <input type="hidden" id="firUserName" name="firUserName" value="{{ $firUser->name }}">
                                    @if ($user->image == null)
                                        <img src="{{ asset('image/defaultpic.jpg') }}"
                                            class="w-100 rounded-circle shadow-lg" id="firUserImageDef" alt="">
                                    @else
                                        <img src="{{ asset('storage/' . $firUser->image) }}"
                                            class="w-100 rounded-circle shadow-lg" id="firUserImage" alt="">
                                    @endif
                                @endif
                                @if (isset($secUser))
                                    <input type="hidden" id="secUserName" name="secUserName" value="{{ $secUser->name }}">
                                        @if ($user->image == null)
                                            <img src="{{ asset('image/defaultpic.jpg') }}"
                                                class="w-100 rounded-circle shadow-lg" id="secUserImageDef" alt="">
                                        @else
                                            <img src="{{ asset('storage/' . $secUser->image) }}"
                                                class="w-100 rounded-circle shadow-lg" id="secUserImage" alt="">
                                        @endif
                                @endif
                                @if (isset($aUser))
                                    <input type="hidden" id="aUserName" name="aUserName" value="{{ $aUser->name }}">
                                    @if ($user->image == null)
                                        <img src="{{ asset('image/defaultpic.jpg') }}"
                                            class="w-100 rounded-circle shadow-lg" id="aUserImageDef" alt="">
                                    @else
                                        <img src="{{ asset('storage/' . $aUser->image) }}"
                                            class="w-100 rounded-circle shadow-lg" id="aUserImage" alt="">
                                    @endif
                                @endif
                                @if (isset($bUser))
                                    <input type="hidden" id="bUserName" name="bUserName" value="{{ $bUser->name }}">
                                    @if ($user->image == null)
                                        <img src="{{ asset('image/defaultpic.jpg') }}"
                                            class="w-100 rounded-circle shadow-lg" id="bUserImageDef" alt="">
                                    @else
                                        <img src="{{ asset('storage/' . $bUser->image) }}"
                                            class="w-100 rounded-circle shadow-lg" id="bUserImage" alt="">
                                    @endif
                                @endif
                                @if (isset($cUser))
                                    <input type="hidden" id="cUserName" name="cUserName" value="{{ $cUser->name }}">
                                    @if ($user->image == null)
                                        <img src="{{ asset('image/defaultpic.jpg') }}"
                                            class="w-100 rounded-circle shadow-lg" id="cUserImageDef" alt="">
                                    @else
                                        <img src="{{ asset('storage/' . $cUser->image) }}"
                                            class="w-100 rounded-circle shadow-lg" id="cUserImage" alt="">
                                    @endif
                                @endif
                                @if (isset($dUser))
                                    <input type="hidden" id="dUserName" name="dUserName" value="{{ $dUser->name }}">
                                    @if ($user->image == null)
                                        <img src="{{ asset('image/defaultpic.jpg') }}"
                                            class="w-100 rounded-circle shadow-lg" id="dUserImageDef" alt="">
                                    @else
                                        <img src="{{ asset('storage/' . $dUser->image) }}"
                                            class="w-100 rounded-circle shadow-lg" id="dUserImage" alt="">
                                    @endif
                                @endif
                                @if (isset($eUser))
                                    <input type="hidden" id="eUserName" name="eUserName" value="{{ $eUser->name }}">
                                    @if ($user->image == null)
                                        <img src="{{ asset('image/defaultpic.jpg') }}"
                                            class="w-100 rounded-circle shadow-lg" id="eUserImageDef" alt="">
                                    @else
                                        <img src="{{ asset('storage/' . $eUser->image) }}"
                                            class="w-100 rounded-circle shadow-lg" id="eUserImage" alt="">
                                    @endif
                                @endif
                                @if (isset($fUser))
                                    <input type="hidden" id="fUserName" name="fUserName" value="{{ $fUser->name }}">
                                    @if ($user->image == null)
                                        <img src="{{ asset('image/defaultpic.jpg') }}"
                                            class="w-100 rounded-circle shadow-lg" id="fUserImageDef" alt="">
                                    @else
                                        <img src="{{ asset('storage/' . $fUser->image) }}"
                                            class="w-100 rounded-circle shadow-lg" id="fUserImage" alt="">
                                    @endif
                                @endif
                                @if (isset($gUser))
                                    <input type="hidden" id="gUserName" name="gUserName" value="{{ $gUser->name }}">
                                    @if ($user->image == null)
                                        <img src="{{ asset('image/defaultpic.jpg') }}"
                                            class="w-100 rounded-circle shadow-lg" id="gUserImageDef" alt="">
                                    @else
                                        <img src="{{ asset('storage/' . $user->image) }}"
                                            class="w-100 rounded-circle shadow-lg" id="gUserImage" alt="">
                                    @endif
                                @endif
                                @if (isset($hUser))
                                    <input type="hidden" id="hUserName" name="hUserName" value="{{ $hUser->name }}">
                                    @if ($user->image == null)
                                        <img src="{{ asset('image/defaultpic.jpg') }}"
                                            class="w-100 rounded-circle shadow-lg" id="hUserImageDef" alt="">
                                    @else
                                        <img src="{{ asset('storage/' . $user->image) }}"
                                            class="w-100 rounded-circle shadow-lg" id="hUserImage" alt="">
                                    @endif
                                @endif
                            </div> --}}

                        </div>
                    </div>
                </div>
            <!-- Modal for group detail end -->
             {{-- modal for gp edit  --}}
             <div class="modal fade" id="editGp" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" style="width: 280px">
                 <div class="modal-content">
                     <div class="modal-header border-bottom-0">
                         <button type="button" class="btn position-absolute mt-2 me-1 top-0 end-0" id="backGpDetail" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i></button>
                     </div>
                     <form action="{{ route('group#groupProfileChangeName') }}" method="post">
                         @csrf
                     <div class="modal-body">
                         <label class="btn btn-light mt-4 position-relative" style="width: 80px">
                             @if ($groupChat->group_image == null)
                                 <img src="{{ asset('image/gpDefault.jpg') }}"
                                     class="w-100 rounded-3 position-relative profilePic" alt="">
                             @else
                                 <img src="{{ asset('storage/' . $groupChat->group_image) }}"
                                     class="w-100 rounded-3 position-relative profilePic" alt="">
                             @endif
                             <i class="fa-solid fa-pen-to-square position-absolute"
                                 style="top:0;color:grey;font-size:smaller"></i>
                             <input type="file" name="image" class="GpImage d-none"
                                 style="border: 1px solid rgb(92, 92, 92); background-color: rgb(92, 92, 92);">
                         </label>

                         <input type="text" name="gpname"
                             class=" form-control mt-2" placeholder="Name" required>
                         <input type="hidden" name="id" value="{{ $groupChat->id }}">
                     </div>

                     <div class="modal-footer ">
                         <button type="submit"
                             class=" btn btn-primary col opacity-75">Update</button>
                     </div>
                 </form>
                 </div>
             </div>
         </div>
         {{-- modal for gp edit end --}}
         {{-- modal for gp pic edit  --}}
         <div class="modal fade" id="GpImageCrop" data-bs-backdrop="static"
             data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
             aria-hidden="true">
             <div class="modal-dialog modal-dialog-centered" style="width: 280px">
             <div class="modal-content">
              <div class="modal-header">
                  <h1 class="modal-title fs-5 lightTextClass" id="staticBackdropLabel">Crop
                      Picture</h1>
                  <button type="button"
                      class="btn position-absolute mt-2 me-1 top-0 end-0" id="backGpDetailFromCrop"><i
                          class="fa-solid fa-xmark" data-bs-dismiss="modal"></i></button>
              </div>
              <div class="py-3">
                  <input type="hidden" id="_token" name="_token"
                      value="{{ csrf_token() }}">
                  <input type="hidden" name="id" id="id"
                      value="{{ Auth::user()->id }}">
                  <div class="preview text-center overflow-hidden rounded-3"></div>
              </div>

              <div class="modal-body overflow-hidden"
                  style="height: 180px; filter:brightness(50%)">
                  <img src="{{ asset('storage/' . Auth::user()->image) }}"
                      alt="" class=" col w-100" id="GpImage" hidden>
              </div>

              <div class="modal-footer col">
                  <button type="button" id="scrop"
                      class="btn btn-primary opacity-50 my-2 w-100">
                      Crop & Update
                  </button>
              </div>
          </div>
             </div>
         </div>
     {{-- modal for gp pic edit end  --}}
                </div>
                  {{-- modal for search message  --}}
                <div class="modal fade" id="searchMessage" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" style="width: 280px">
                        <div class="modal-content " >
                            <div id="contactInfo">
                                <div class="modal-header border-bottom-0">
                                    <h5 class="col-6 lightTextClass">Messages</h5>
                                    <button type="button" class="btn position-absolute mt-2 me-1 top-0 end-0" data-bs-dismiss="modal"
                                        aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
                                </div>

                                <div class="modal-body">
                                    <form action="{{ route('chat#chatMessageSearch') }}" id="searchMessage" method="get">
                                        <input type="text" name="searchMessage" class=" form-control bg-light" id="searchMessageInput" placeholder="Search" required/>
                                        <button type="submit" class="d-none"></button>
                                    </form>
                                    <div class="displaySearchMessage overflow-y-scroll" style="height: 200px"></div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                {{-- modal for search message end --}}
            </header>
            @if (count($message) == 0)
            <div class="d-flex justify-content-center align-items-center opacity-50" style="height: 80vh">
            <div class="lightTextClass text-center card bg-light border-0 px-5 py-3" >
                <p class=" fs-4 opacity-75"><i class="fa-regular fa-paper-plane"></i></p>
                <p class=" fw-bold">No messages here yet</p>
                <p>Send a message and make some friend</p>
            </div>
            </div>
            @else
                <article id='scroll' class="display-message overflow-scroll overflow-x-hidden " style="height: 80vh">
                </article>
            @endif
                <footer>
                    <form enctype="multipart/form-data">
                        @csrf
                        <div class="pt-3">
                            <div class="message-reply offset-1 ">

                            </div>
                          <div class=" messenge-send ">
                            <div class="d-flex">
                                <span class="file-attach pt-1 text-center" style="width: 50px"><i class="fa-solid fa-paperclip lightTextClass"
                                        data-bs-toggle="modal" data-bs-target="#fileUpload"></i>
                                </span>

                                <input type="hidden" name="firstUser" id="firstUser" value="{{ $groupChat->fir_user_id }}">
                                @if ($groupChat->sec_user_id != null)
                                    <input type="hidden" name="secUser" id="secUser" value="{{ $groupChat->sec_user_id }}">
                                @endif
                                @if ($groupChat->a_user_id != null)
                                    <input type="hidden" name="aUser" id="aUser" value="{{ $groupChat->a_user_id }}">
                                @endif
                                @if ($groupChat->b_user_id != null)
                                    <input type="hidden" name="bUser" id="bUser" value="{{ $groupChat->b_user_id }}">
                                @endif
                                @if ($groupChat->c_user_id != null)
                                    <input type="hidden" name="cUser" id="cUser" value="{{ $groupChat->c_user_id }}">
                                @endif
                                @if ($groupChat->d_user_id != null)
                                    <input type="hidden" name="dUser" id="dUser" value="{{ $groupChat->d_user_id }}">
                                @endif
                                @if ($groupChat->e_user_id != null)
                                    <input type="hidden" name="eUser" id="eUser" value="{{ $groupChat->e_user_id }}">
                                @endif
                                @if ($groupChat->f_user_id != null)
                                    <input type="hidden" name="fUser" id="fUser" value="{{ $groupChat->f_user_id }}">
                                @endif
                                @if ($groupChat->g_user_id != null)
                                    <input type="hidden" name="gUser" id="gUser" value="{{ $groupChat->g_user_id }}">
                                @endif
                                @if ($groupChat->h_user_id != null)
                                    <input type="hidden" name="hUser" id="hUser" value="{{ $groupChat->h_user_id }}">
                                @endif

                                <div class="input-group col">
                                    <input type="text" name="message" id="message"
                                        placeholder="Write Your Message Here ..."
                                        class="messageInput form-control lightBgClass border-0" required/>
                                       <div class="input-group-text  lightBgClass border-0">
                                        <div class=" btn-group dropup" ><i class="fa-regular fa-face-smile lightTextClass opacity-50"  data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false"></i>
                                            <div class="dropdown-menu mb-3 bg-dark GpEmo" id="dropdown-menu">

                                                <div class="emoji-picker">
                                                    <div class="emoji-container">

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                       </div>
                                    </div>

                                <div class=" text-center"  style="width: 100px">
                                    <span class=" pt-2 px-3"><i
                                            class="fa-solid fa-microphone voice-icon lightTextClass"></i>
                                            </span>
                                    <button type="button" id="sendMessageBtn" class=" rounded-circle btn lightBgClass"><i
                                            class="fa fa-send lightTextClass" aria-hidden="true"></i></button>
                                    <button type="button" id="sendMessageBtn1" class=" rounded-circle btn lightBgClass" style="display: none;"><i
                                            class="fa fa-send lightTextClass" aria-hidden="true"></i></button>
                                </div>

                            </div>
                          </div>
                            <div class="  messenge-voice" style="display: none;">
                                <input type="file" name="audio" id="audio" class="d-none" accept="audio/*">

                               <div class=" d-flex">

                                    <div class=" text-danger  pt-1 text-center back-send"
                                        style="cursor: pointer;width: 70px">
                                        Cancel</div>
                                    <div class=" text-danger pt-1 text-center col audio-stop" style="cursor: pointer;">Stop</div>
                                    <div class=" pt-1" style="width: 70px"><button type="button"
                                            class=" rounded-circle btn lightBgClass audio-send"><i class="fa fa-send lightTextClass"
                                                aria-hidden="true"></i></button>
                                    </div>
                               </div>

                            </div>
                        </div>
                    </form>

                    <!-- Modal for file upload start -->
                    <div class="modal fade" id="fileUpload" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" style="width: 280px">
                            <div class="modal-content">
                                <div class="modal-header border-bottom-0">
                                    <button type="button" class="btn position-absolute top-0 end-0" data-bs-dismiss="modal"
                                        aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
                                </div>
                                <form enctype="multipart/form-data">
                                    @csrf

                                    <div class="modal-body">
                                        <div class="mb-4">
                                            <input type="file" name="file" id="file"
                                            class="form-control bg-light border-0 lightTextClass col" />
                                            <div id="errorFile">

                                            </div>
                                        </div>
                                        <div class="d-flex">

                                            <div class="col pb-2">
                                                <input type="text" name="message" id="message1"
                                                    placeholder="Enter Caption ..."
                                                    class="messageInput1 form-control lightBgClass border-0 col" />
                                            </div>

                                            <div class=" ms-1 text-center" style="width: 50px">
                                                <button type="button" id="sendFile"  class=" rounded-circle btn lightBgClass"><i
                                                        class="fa fa-send lightTextClass" aria-hidden="true"></i></button>
                                                <button type="button" id="sendFile1" style="display: none"  class=" rounded-circle btn lightBgClass"><i
                                                        class="fa fa-send lightTextClass" aria-hidden="true"></i></button>
                                            </div>

                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Modal for file upload end -->

                </footer>
        </div>
    </main>

    <!-- Modal for Confirm blocked member -->
    <div class="modal fade" id="confirmBlockedMember" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="width: 295px">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <button type="button"data-bs-dismiss="modal"
                    aria-label="Close"
                        class="btn position-absolute mt-2 me-1 top-0 end-0 opacity-50"><i
                            class="fa-solid fa-xmark"></i></button>
                </div>

                    <div class="modal-body ">
                        @foreach ($block as $b)
                            @if ($b->user_id == Auth::user()->id)
                                @if (isset($user) && $b->blocked_id == $user->id)
                                    @if ($groupChat->user_id == Auth::user()->id)
                                        <p class=" lightTextClass">There is {{ $user->name }} in this group. Do you want to delete this group</p>
                                    @else
                                        <p class=" lightTextClass">There is {{ $user->name }} in this group. Do you want to leave this group</p>
                                    @endif
                                @endif
                                @if (isset($firUser) && $b->blocked_id == $firUser->id)
                                    @if ($groupChat->user_id == Auth::user()->id)
                                        <p class=" lightTextClass">There is {{ $firUser->name }} in this group. Do you want to delete this group</p>
                                    @else
                                        <p class=" lightTextClass">There is {{ $firUser->name }} in this group. Do you want to leave this group</p>
                                    @endif
                                @endif
                                @if (isset($secUser) && $b->blocked_id == $secUser->id)
                                    @if ($groupChat->user_id == Auth::user()->id)
                                        <p class=" lightTextClass">There is {{ $secUser->name }} in this group. Do you want to delete this group</p>
                                    @else
                                        <p class=" lightTextClass">There is {{ $secUser->name }} in this group. Do you want to leave this group</p>
                                    @endif
                                @endif
                                @if (isset($aUser) && $b->blocked_id == $aUser->id)
                                    @if ($groupChat->user_id == Auth::user()->id)
                                        <p class=" lightTextClass">There is {{ $aUser->name }} in this group. Do you want to delete this group</p>
                                    @else
                                        <p class=" lightTextClass">There is {{ $aUser->name }} in this group. Do you want to leave this group</p>
                                    @endif
                                @endif
                                @if (isset($bUser) && $b->blocked_id == $bUser->id)
                                    @if ($groupChat->user_id == Auth::user()->id)
                                        <p class=" lightTextClass">There is {{ $bUser->name }} in this group. Do you want to delete this group</p>
                                    @else
                                        <p class=" lightTextClass">There is {{ $bUser->name }} in this group. Do you want to leave this group</p>
                                    @endif
                                @endif
                                @if (isset($cUser) && $b->blocked_id == $cUser->id)
                                    @if ($groupChat->user_id == Auth::user()->id)
                                        <p class=" lightTextClass">There is {{ $cUser->name }} in this group. Do you want to delete this group</p>
                                    @else
                                        <p class=" lightTextClass">There is {{ $cUser->name }} in this group. Do you want to leave this group</p>
                                    @endif
                                @endif
                                @if (isset($dUser) && $b->blocked_id == $dUser->id)
                                    @if ($groupChat->user_id == Auth::user()->id)
                                        <p class=" lightTextClass">There is {{ $dUser->name }} in this group. Do you want to delete this group</p>
                                    @else
                                        <p class=" lightTextClass">There is {{ $dUser->name }} in this group. Do you want to leave this group</p>
                                    @endif
                                @endif
                                @if (isset($eUser) && $b->blocked_id == $eUser->id)
                                    @if ($groupChat->user_id == Auth::user()->id)
                                        <p class=" lightTextClass">There is {{ $eUser->name }} in this group. Do you want to delete this group</p>
                                    @else
                                        <p class=" lightTextClass">There is {{ $eUser->name }} in this group. Do you want to leave this group</p>
                                    @endif
                                @endif
                                @if (isset($fUser) && $b->blocked_id == $fUser->id)
                                    @if ($groupChat->user_id == Auth::user()->id)
                                        <p class=" lightTextClass">There is {{ $fUser->name }} in this group. Do you want to delete this group</p>
                                    @else
                                        <p class=" lightTextClass">There is {{ $fUser->name }} in this group. Do you want to leave this group</p>
                                    @endif
                                @endif
                                @if (isset($gUser) && $b->blocked_id == $gUser->id)
                                    @if ($groupChat->user_id == Auth::user()->id)
                                        <p class=" lightTextClass">There is {{ $gUser->name }} in this group. Do you want to delete this group</p>
                                    @else
                                        <p class=" lightTextClass">There is {{ $gUser->name }} in this group. Do you want to leave this group</p>
                                    @endif
                                @endif
                                @if (isset($hUser) && $b->blocked_id == $hUser->id)
                                    @if ($groupChat->user_id == Auth::user()->id)
                                        <p class=" lightTextClass">There is {{ $hUser->name }} in this group. Do you want to delete this group</p>
                                    @else
                                        <p class=" lightTextClass">There is {{ $hUser->name }} in this group. Do you want to leave this group</p>
                                    @endif
                                @endif

                            @endif
                        @endforeach
                    </div>
                    <div class="modal-footer">
                        @if ($groupChat->user_id == Auth::user()->id)
                            <a href="{{ route('group#groupChatDelete',$groupChat->id) }}" class="btn btn-danger col ">Delete</a>
                        @else
                            <a href="{{ route('group#groupChatLeave',$groupChat->id) }}" class="btn btn-danger col ">Leave</a>
                        @endif
                    </div>

            </div>
        </div>
    </div>
    <!-- Modal for blocked member end-->

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
    <script src="{{ asset('js/contact.js') }}"></script>
    <script src="{{ asset('js/group.js') }}"></script>
<script src="{{ asset('js/light_dark.js') }}"></script>
    <script src="{{ asset('js/setting.js') }}"></script>
<script>
    $(document).ready(function() {
    $(".chat-icon").click(() => {
        $(".chat-section").fadeIn(1500);
        $(".chat-icon").css("color", "#536dfe");
        $(".contact-icon").css("color", "#e0e0e0");
        $(".group-icon").css("color", "#e0e0e0");
        $(".setting-icon").css("color", "#e0e0e0");
        $(".contact-section").css("display", "none");
        $(".group-section").css("display", "none");
        $('.moon-icon').css('color','#e0e0e0');
        $('.sun-icon').css('color','#e0e0e0');
        $(".setting-section").css("display", "none");
    });
    $('.setting-icon').click(() => {
        $('.setting-section').fadeIn(1500);
        $('.setting-icon').css('color','#536dfe');
        $('.group-icon').css('color','#e0e0e0');
        $('.contact-icon').css('color','#e0e0e0');
        $('.chat-icon').css('color','#e0e0e0');
        $('.group-section').css('display','none');
        $('.moon-icon').css('color','#e0e0e0');
        $('.sun-icon').css('color','#e0e0e0');
        $('.contact-section').css('display','none');
        $('.chat-section').css('display','none');
    })
    $(".group-icon").click(() => {
        $(".group-section").fadeIn(1500);
        $(".group-icon").css("color", "#536dfe");
        $(".contact-icon").css("color", "#e0e0e0");
        $(".chat-icon").css("color", "#e0e0e0");
        $(".setting-icon").css("color", "#e0e0e0");
        $(".contact-section").css("display", "none");
        $(".chat-section").css("display", "none");
        $('.moon-icon').css('color','#e0e0e0');
        $('.sun-icon').css('color','#e0e0e0');
        $(".setting-section").css("display", "none");
    });
    $('.contact-icon').click(() => {
        $('.contact-section').fadeIn(1500);
        $('.contact-icon').css('color','#536dfe');
        $('.chat-icon').css('color','#e0e0e0');
        $('.group-icon').css('color','#e0e0e0');
        $('.setting-icon').css('color','#e0e0e0');
        $('.chat-section').css('display','none');
        $('.group-section').css('display','none');
        $('.moon-icon').css('color','#e0e0e0');
        $('.sun-icon').css('color','#e0e0e0');
        $('.setting-section').css('display','none');
    })
    // console.log($('.errorselectText').text());
    if($('.errorselectText').text() != ''){
        $('#addGpMember').modal('show');
    }
        $.ajax({
            url: `/group/message/seen/${$('#groupID').val()}`,
            type: 'GET',
            datatype: 'json'
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

        $('#searchForAddContact').click((e) => {
            e.preventDefault();
            var addEmail = $('#addEmail').val();
            var addPhone = $('#addPhone').val();
            var inputData = {
                addEmail: addEmail,
                addPhone: addPhone
            }
            $.ajax({
                url: "/contact/search",
                type: "POST",
                datatype: "json",
                headers: {
                    "X-CSRF-TOKEN": $('#_token').val(),
                },
                data: inputData,
                success: function(res) {
                    $('.searchedContact').html("");

                    if (res.contact != undefined) {
                        var contact = res.contact;

                        $('.searchedContact').append(
                            `
                <div class="modal-body d-flex mx-4">
                    <div class="ms-3" style="width: 40px">
                        ${contact.image == null ? `
                            <img src="http://localhost:8000/image/defaultpic.jpg"
                                class="w-100  mt-1 rounded-circle " alt="">
                        `:`
                            <img src="http://localhost:8000/storage/${contact.image}"
                                class="w-100  rounded-circle mt-1 " alt="">
                        `}
                    </div>
                    <div class="col offset-2">
                        <input type="hidden" name="addUserId" value="${contact.id}"/>
                        <span class="text-muted fw-bold d-block pt-2 ">${contact.name}</span>
                    </div>
                </div>
                <div class="modal-footer ">
                    <button type="submit" class=" btn btn-primary col opacity-75">Add</button>
                </div>
                    `
                        );

                    } else {
                        $('.searchedContact').append(
                            `
                    <div class=" modal-body mx-4 text-center">
                        <p class=" opacity-50">user not found</p>
                    </div>
                    <div class="modal-footer ">
                        <button type="button" class=" btn btn-danger col opacity-75" id="backAddContact">Back</button>
                    </div>
                        `
                        );
                        $('#backAddContact').click(() => {

                            $('#displaySearchedContact').css('display', 'none');
                            $('#inputDataForContact').fadeIn();
                        })
                    };
                    $('#inputDataForContact').css('display', 'none');
                    $('#displaySearchedContact').fadeIn();

                },

            });
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
            $('#editGp').modal('hide');
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

        $("#scrop").click(function() {
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
                            'id':  $("#groupID").val(),
                            'image': base64data
                        },
                        success: function(data) {
                            $modal.modal('hide');
                            window.location.href = data.id;
                            console.log(data);
                        }
                    });
                }
            });
        });

        $('#backGpDetailFromCrop').click(function(){
            $('#groupDetail').modal('show');
        })

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

