<nav class=" flex-column nav-desk" style="width: 70px">
    <div class="px-2">
        <div class="d-flex justify-content-around align-items-center py-3" style="width: 35px"><img class="w-100" src="{{ asset('image/icons8-leaf-48.png') }}" alt=""></div>
        <ul class=" list-unstyled flex-column d-flex justify-content-around align-items-center"
            style="height:30vh;">
            <li>
                <i class="fa-solid fa-comment fs-5 chat-icon " style="color: #536dfe"></i>
            </li>
            <li>
                <i class="fa-solid fa-user fs-5 contact-icon" style="color:#e0e0e0"></i>
            </li>
            <li>
                <i class="fa-solid fa-users fs-5 group-icon" style="color:#e0e0e0"></i>
            </li>
        </ul>
        <div style="height: 22vh"></div>
        <ul class=" list-unstyled flex-column d-flex justify-content-around align-items-center"
            style="height:20vh; border-bottom:1px solid grey">
            <li>
                <i class="fa-solid fa-moon fs-5 moon-icon" style="color: #e0e0e0"></i>
                <i class="fa-solid fa-sun  fs-5 sun-icon" style="color: #e0e0e0;display:none"></i>
            </li>
            <li>
                <i class="fa-solid fa-gear fs-5 setting-icon" style="color: #e0e0e0"></i>
            </li>
        </ul>
    </div>
    <div class=" pb-4 pt-4 btn-group">
        <div class="" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 45px">
            @if (Auth::user()->image == null)
                <img src="{{ asset('image/defaultpic.jpg') }}" alt="profile"
                    class="w-100 border-secondary rounded-pill">
            @else
                <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="profile"
                    class="w-100 rounded-pill border-secondary ">
            @endif
        </div>
        <div class="dropdown-menu">
            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#profileInfo"><small
                    class=" lightTextClass " style="cursor: pointer"><i
                        class="fa-solid fa-circle-info me-2 opacity-50"></i>Personal Information</small></a>
            <a class="dropdown-item"data-bs-toggle="modal" data-bs-target="#logout" id="signOut"><small
                    class=" text-danger" style="cursor: pointer"><i
                        class="fa-solid fa-arrow-right-from-bracket me-2"></i>Logout</small></a>
        </div>
    </div>
</nav>

<aside style="width: 300px">
    <div class="chat-section">
        <div class="header-title row py-3 lightTextClass">
            <h4 class="col ">Messages</h4>

        </div>
        <div class="search-bar p-3 mb-2">
           <form action="{{ route('dashboard') }}" method="get">
            <input type="text" name="searchChat" class=" form-control border-0 bg-light opacity-75" placeholder="Search" value="{{ old('searchChat') }}">
            <button type="submit" class=" d-none"></button>
           </form>
        </div>
        <div class="chat-body overflow-scroll overflow-x-hidden opacity-75" style="height:79vh">

            <div class="people-chat">
                @if (isset($chatlist))
                   @if (count($chatlist) == 0)
                   <div class="mt-5  text-center">
                    <small class=" lightTextClass">no chat found</small>
                   </div>
                    @else
                    @foreach ($chatlist as $cl)
                    <a href="{{ route('chat#chatPage', $cl->sec_user_id) }}"
                        class=" btn btn-light w-100  py-3 my-1 border-0 text-start rounded-3">
                        <div class="d-flex">
                            <div  style="width:45px">
                                @if (Auth::user()->image == null)
                                    <img src="{{ asset('image/defaultpic.jpg') }}" alt="contact-pic"
                                        class="w-100 rounded-pill">
                                @else
                                    <img src="{{ asset('storage/' . $cl->image) }}" alt="contact-pic"
                                        class="w-100 rounded-pill">
                                @endif
                            </div>
                            <div class="col ms-4">
                                <span class=" fw-bold lightTextClass d-block"> {{ $cl->name }}</span>
                                @if ($cl->status == 'online')
                                    <small class=" text-info">{{ $cl->status }}</small>
                                @else
                                    @if (date('H') * 60 + date('i') - ($cl->updated_at->format('H') * 60 + $cl->updated_at->format('i')) > 60)
                                        <small class=" lightTextClass">Active
                                            {{ date('H') - $cl->updated_at->format('H') }}
                                            hours ago</small>
                                    @elseif (date('H') * 60 + date('i') - ($cl->updated_at->format('H') * 60 + $cl->updated_at->format('i')) == 0)
                                        <small class=" lightTextClass">Active a minute ago
                                        </small>
                                    @elseif (date('H') * 60 + date('i') - ($cl->updated_at->format('H') * 60 + $cl->updated_at->format('i')) > 1140)
                                        <small class=" lightTextClass">Active
                                            {{ date('d') - $cl->updated_at->format('d') }}
                                            days ago</small>
                                    @elseif (date('H') * 60 + date('i') - ($cl->updated_at->format('H') * 60 + $cl->updated_at->format('i')) > 43200)
                                        <small class=" lightTextClass">Active
                                            {{ date('m') - $cl->updated_at->format('m') }}
                                            months ago</small>
                                    @elseif (date('H') * 60 + date('i') - ($cl->updated_at->format('H') * 60 + $cl->updated_at->format('i')) > 525600)
                                        <small class=" lightTextClass">Active
                                            {{ date('Y') - $cl->updated_at->format('Y') }}
                                            years ago</small>
                                    @else
                                        @if ($cl->updated_at->format('H') * 60 + $cl->updated_at->format('i') <= date('H') * 60 + date('i'))
                                            <small class=" lightTextClass">Active
                                                {{ date('H') * 60 + date('i') - ($cl->updated_at->format('H') * 60 + $cl->updated_at->format('i')) }}
                                                minute ago
                                            </small>
                                        @endif
                                    @endif
                                @endif
                            </div>
                        </div>
                    </a>
                @endforeach
                   @endif
                @else
                @endif

            </div>

        </div>
    </div>

    <div class="contact-section" style="display: none">
        <div class="header-title row py-3 lightTextClass">
            <h4 class="col-6 ">Contacts</h4>
            <div class="col-2 text-end offset-4">
                <i class="fa-solid fa-user-plus  text-success fs-6 pt-2" data-bs-toggle="modal"
                    data-bs-target="#addContact"></i>
            </div>
        </div>
        <div class="search-bar p-3 mb-2">
            <form action="{{ route('dashboard') }}" method="get">
                <input type="text" name="searchContact" class=" form-control border-0 bg-light opacity-75" placeholder="Search" value="{{ old('searchContact') }}">
                <button type="submit" class=" d-none"></button>
               </form>
        </div>
        <div class="contact-body overflow-scroll overflow-x-hidden opacity-75" style="height:79vh">
            <ul class=" list-unstyled">
              @if (count($contact) == 0)
              <div class="mt-5 text-center">
                <small class=" lightTextClass ">no contact found</small>
              </div>
                @else
                @foreach ($contact as $c)
                <li class=" form-control py-2 my-1 px-3 border-0 btn-group ">
                    <a class="text-decoration-none lightTextClass " data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false" style="cursor: pointer">
                        <div class="d-flex ">
                            <div style="width:35px">
                                @if ($c->image == null)
                                    <img src="{{ asset('image/defaultpic.jpg') }}" alt="profile"
                                        class=" w-100 rounded-circle">
                                @else
                                    <img src="{{ asset('storage/' . $c->image) }}" alt="profile"
                                        class=" w-100 rounded-circle ">
                                @endif
                            </div>
                            <span class="col fw-bold ms-4 pt-1">{{ $c->name }}</span>
                        </div>
                        <div class="dropdown-menu ">
                            <a class="dropdown-item opacity-75" data-bs-toggle="modal"
                                data-bs-target="#{{ $c->add_user_id }}"><small class=" lightTextClass "
                                    style="cursor: pointer"><i
                                        class="fa-solid fa-circle-info me-2 opacity-50"></i>Personal
                                    Information</small></a>
                            <a class="dropdown-item opacity-75"
                                href="{{ route('chat#chatPage', $c->add_user_id) }}"><small
                                    class=" lightTextClass " style="cursor: pointer"><i
                                        class="fa-solid fa-comment me-2 opacity-50"></i>Send
                                    message</small></a>
                            <a class="dropdown-item opacity-75"
                                href="{{ route('chat#block', $c->add_user_id) }}"><small
                                    class=" text-danger " style="cursor: pointer"><i
                                        class="fa-solid fa-ban me-2"></i>Block Contact</small></a>
                            <a class="dropdown-item opacity-75"
                                href="{{ route('contact#deleteContact', $c->add_user_id) }}"><small
                                    class=" text-danger" style="cursor: pointer"><i
                                        class="fa-regular fa-trash-can  me-2"></i>Delete Contact</small></a>
                        </div>
                    </a>
                </li>
                {{-- modal for profile contact infromation  --}}
                <div class="modal fade" id="{{ $c->add_user_id }}" data-bs-backdrop="static"
                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" style="width: 280px">
                        <div class="modal-content ">

                                <div class="modal-header border-bottom-0">
                                    <h5 class="col-6 lightTextClass">Profile Info</h5>
                                    <button type="button" class="btn position-absolute mt-2 me-1 top-0 end-0"
                                        data-bs-dismiss="modal" aria-label="Close"><i
                                            class="fa-solid fa-xmark"></i></button>
                                </div>

                                <div class="modal-body" style="border-bottom: 1px solid #eeeeee">
                                    <div class="row ">
                                        <div class=" ms-3 mt-1" style="width: 68px">

                                            @if ($c->image == null)
                                                <img src="{{ asset('image/defaultpic.jpg') }}"
                                                    class="w-100 rounded-circle" alt="">
                                            @else
                                                <img src="{{ asset('storage/' . $c->image) }}"
                                                    class="w-100 rounded-circle" alt="">
                                            @endif

                                        </div>
                                        <div class="col">
                                            <span class=" fw-bold lightTextClass d-block">
                                                {{ $c->name }}</span>
                                            @if ($c->status == 'online')
                                                <small class=" text-info">{{ $c->status }}</small>
                                            @else
                                                @if ($c->created_at)
                                                    @if (date('H') * 60 + date('i') - ($c->updated_at->format('H') * 60 + $c->updated_at->format('i')) > 60)
                                                        <small class=" lightTextClass">Active
                                                            {{ date('H') - $c->updated_at->format('H') }}
                                                            hours ago</small>
                                                    @elseif (date('H') * 60 + date('i') - ($c->updated_at->format('H') * 60 + $c->updated_at->format('i')) == 0)
                                                        <small class=" lightTextClass">Active a minute ago
                                                        </small>
                                                    @elseif (date('H') * 60 + date('i') - ($c->updated_at->format('H') * 60 + $c->updated_at->format('i')) > 1140)
                                                        <small class=" lightTextClass">Active
                                                            {{ date('d') - $c->updated_at->format('d') }}
                                                            days ago</small>
                                                    @elseif (date('H') * 60 + date('i') - ($c->updated_at->format('H') * 60 + $c->updated_at->format('i')) > 43200)
                                                        <small class=" lightTextClass">Active
                                                            {{ date('m') - $c->updated_at->format('m') }}
                                                            months ago</small>
                                                    @elseif (date('H') * 60 + date('i') - ($c->updated_at->format('H') * 60 + $c->updated_at->format('i')) > 525600)
                                                        <small class=" lightTextClass">Active
                                                            {{ date('Y') - $c->updated_at->format('Y') }}
                                                            years ago</small>
                                                    @else
                                                        @if ($c->updated_at->format('H') * 60 + $c->updated_at->format('i') <= date('H') * 60 + date('i'))
                                                            <small class=" lightTextClass">Active
                                                                {{ date('H') * 60 + date('i') - ($c->updated_at->format('H') * 60 + $c->updated_at->format('i')) }}
                                                                minute ago
                                                            </small>
                                                        @endif
                                                    @endif
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="pt-3 ps-3" style="border-bottom: 1px solid #eeeeee">

                                    <p class="lightTextClass"><i
                                            class="fa-solid fa-phone px-3 opacity-50"></i>{{ $c->phone }}
                                    </p>
                                    <p class="lightTextClass"><i
                                            class="fa-solid fa-at px-3 opacity-50"></i>{{ $c->email }}</p>
                                    <p class="lightTextClass"><span
                                            class="fw-bold px-3 opacity-50">bio</span>{{ $c->bio }}</p>
                                </div>
                                <div class="pt-3 ps-3">
                                    <a class="dropdown-item"
                                        href="{{ route('chat#block', $c->add_user_id) }}">
                                        <p class=" text-danger " style="cursor: pointer"><i
                                                class="fa-solid fa-ban  px-3 "></i>Block Contact</p>
                                    </a>
                                    <a class="dropdown-item"
                                        href="{{ route('contact#deleteContact', $c->add_user_id) }}">
                                        <p class=" text-danger" style="cursor: pointer"><i
                                                class="fa-regular fa-trash-can  px-3  "></i>Delete Contact</p>
                                    </a>
                                </div>


                        </div>
                    </div>
                </div>
                {{-- modal for profile contact infromation end --}}
            @endforeach
              @endif
            </ul>
        </div>
    </div>

    <div class="group-section" style="display: none">
        <div class="header-title lightTextClass row py-3">
            <h4 class="col-6 ">Groups</h4>
            <div class="col-2 text-end offset-4">
                <i class="fa-regular fa-pen-to-square text-success fs-6 pt-2" data-bs-toggle="modal"
                    data-bs-target="#createGp"></i>

            </div>
        </div>
        <div class="search-bar p-3 mb-2">
            <form action="{{ route('dashboard') }}" method="get">
                <input type="text" name="searchGroup" class=" form-control border-0 bg-light opacity-75" placeholder="Search" value="{{ old('searchGroup') }}">
                <button type="submit" class=" d-none"></button>
               </form>        </div>
        <div class="group-body overflow-scroll overflow-x-hidden opacity-75" style="height:79vh">
           @if (count($group) == 0)
           <div class="mt-5 text-center">
                <small class=" lightTextClass">no group found</small>
           </div>
            @else
            @foreach ($group as $g)
            <a href="{{ route('group#groupChatPage', $g->id) }}"
                class=" btn btn-light w-100  py-3 my-1 border-0 text-start rounded-3">
                <div class="d-flex">
                        <div style="width:45px">
                            @if (Auth::user()->image == null)
                                <img src="{{ asset('image/gpDefault.jpg') }}" alt="contact-pic"
                                    class="w-100 rounded-pill">
                            @else
                                <img src="{{ asset('storage/' . $g->group_image) }}" alt="contact-pic"
                                    class="w-100 rounded-pill">
                            @endif
                        </div>
                    <div class="col ms-4">
                        <span class=" fw-bold lightTextClass d-block"> {{ $g->group_name }}</span>
                        @if (isset($groupChat->fir_user_id) && !isset($groupChat->sec_user_id))
                            <small class=" lightTextClass">2 members</small>
                        @endif
                        @if (isset($g->sec_user_id) && !isset($g->a_user_id))
                            <small class=" lightTextClass">3 members</small>
                        @endif
                        @if (isset($g->a_user_id) && !isset($g->b_user_id))
                            <small class=" lightTextClass">4 members</small>
                        @endif
                        @if (isset($g->b_user_id) && !isset($g->c_user_id))
                            <small class=" lightTextClass">5 members</small>
                        @endif
                        @if (isset($g->c_user_id) && !isset($g->d_user_id))
                            <small class=" lightTextClass">6 members</small>
                        @endif
                        @if (isset($g->d_user_id) && !isset($g->e_user_id))
                            <small class=" lightTextClass">7 members</small>
                        @endif
                        @if (isset($g->e_user_id) && !isset($g->f_user_id))
                            <small class=" lightTextClass">8 members</small>
                        @endif
                        @if (isset($g->f_user_id) && !isset($g->g_user_id))
                            <small class=" lightTextClass">9 members</small>
                        @endif
                        @if (isset($g->g_user_id) && !isset($g->h_user_id))
                            <small class=" lightTextClass">10 members</small>
                        @endif
                        @if (isset($g->h_user_id))
                            <small class=" lightTextClass">11 members</small>
                        @endif
                    </div>
                </div>
            </a>
        @endforeach
           @endif
        </div>
    </div>

    <div class="setting-section" style="display: none">
        <div class="header-title lightTextClass py-3">
            <h4 class="">Settings</h4>
        </div>

        <div class="setting-body overflow-scroll overflow-x-hidden opacity-75" style="height:90vh">
            <div class="account-section my-2">
                <div class="form-control d-flex border-0 lightTextClass account-click py-2" data-bs-toggle="collapse"
                    data-bs-target="#account" aria-expanded="false" aria-controls="account">
                    <div class=" col">
                        <span class=" fw-bold d-block lightTextClass" style="cursor: pointer">Account</span>
                        <span class=" lightTextClass" style="cursor: pointer;font-size:smaller">Update your profile
                            details</span>
                    </div>
                    <div class="col-1 text-end">
                        <i class="fa-solid fa-angle-down pt-1 account-down-arrow"></i>
                    </div>
                </div>

                <div class="collapse py-2" id="account">
                    <div class="px-3">
                        <div class="image py-2">
                            <label class="btn btn-light mt-4 position-relative" style="width: 80px">
                                @if (Auth::user()->image == null)
                                    <img src="{{ asset('image/defaultpic.jpg') }}"
                                        class="w-100 rounded-3 position-relative profilePic" alt="">
                                @else
                                    <img src="{{ asset('storage/' . Auth::user()->image) }}"
                                        class="w-100 rounded-3 position-relative profilePic" alt="">
                                @endif
                                <i class="fa-solid fa-pen-to-square position-absolute"
                                    style="top:0;color:grey;font-size:smaller"></i>
                                <input type="file" name="image" class="cropImage d-none"
                                    style="border: 1px solid rgb(92, 92, 92); background-color: rgb(92, 92, 92);">
                            </label>



                        </div>
                        <form action="{{ route('profile#accountUpdate') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="name py-1">
                                <label for="name" class=" fw-bold d-block lightTextClass opacity-50"
                                    style="font-size: smaller">Name</label>
                                <input type="text" name="name"
                                    class="bg-light mb-2 form-control border-0 fw-bold lightTextClass"
                                    value="{{ Auth::user()->name }}" id="username" required/>
                            </div>
                            <div class="phone py-1">
                                <label for="phone" class=" fw-bold d-block lightTextClass opacity-50"
                                    style="font-size: smaller">Phone</label>
                                <input type="text" name="phone"
                                    class="bg-light myb2 form-control border-0 fw-bold lightTextClass"
                                    value="{{ Auth::user()->phone }}" id="userphone" required/>
                            </div>

                            <div class="email py-1">
                                <label for="email" class=" fw-bold d-block lightTextClass opacity-50"
                                    style="font-size: smaller">Email</label>
                                <input type="email" name="email"
                                    class="bg-light mb-2 form-control border-0 fw-bold lightTextClass"
                                    value="{{ Auth::user()->email }}" id="useremail" required/>

                            </div>
                            <div class="bio py-1">
                                <label for="bio" class=" fw-bold d-block lightTextClass opacity-50"
                                    style="font-size: smaller">bio</label>
                                <input type="text" name="bio"
                                    class="bg-light mb-2 form-control border-0 fw-bold lightTextClass"
                                    value="{{ Auth::user()->bio }}" id="userbio" required/>

                            </div>
                            <div class=" col pt-2">
                                <button type="submit" class="w-100 btn btn-primary opacity-50">Update
                                    Profile</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <div class="security-section my-2">
                <div class="form-control d-flex border-0 lightTextClass security-click py-2" data-bs-toggle="collapse"
                    data-bs-target="#security" aria-expanded="false" aria-controls="security">
                    <div class=" col">
                        <span class=" fw-bold d-block lightTextClass" style="cursor: pointer">Privacy &
                            Safety</span>
                        <span class=" lightTextClass" style="cursor: pointer;font-size:smaller">Control your privacy
                            settings</span>
                    </div>
                    <div class="col-1 text-end">
                        <i class="fa-solid fa-angle-down pt-1 security-down-arrow"></i>
                    </div>
                </div>

                <div class="collapse" id="security">
                    <a href="{{ route('profile#accountPasswordChangePage') }}" class=" text-decoration-none">
                        <div class="col py-3 px-3" style="cursor: pointer">
                            <span class=" fw-bold d-block lightTextClass">Password change</span>
                            <span class=" lightTextClass" style="font-size:smaller">Update your account
                                password</span>
                        </div>
                    </a>
                    <div class="col py-3 px-3" style="cursor: pointer" data-bs-toggle="modal"
                        data-bs-target="#blockedAcc">
                        <span class=" fw-bold d-block lightTextClass">Blocked contacts</span>
                        <span class=" lightTextClass" style="cursor: pointer;font-size:smaller">Stop someone from
                            contacting you</span>
                    </div>
                </div>

            </div>


            <div class="appear-section my-2">
                <div class="form-control d-flex border-0 lightTextClass appear-click py-2" data-bs-toggle="collapse"
                    data-bs-target="#appear" aria-expanded="false" aria-controls="appear">
                    <div class=" col">
                        <span class=" fw-bold d-block lightTextClass" style="cursor: pointer">Appearence</span>
                        <span class=" lightTextClass" style="cursor: pointe;font-size:smaller">Customize the look and
                            feel</span>
                    </div>
                    <div class="col-1 text-end">
                        <i class="fa-solid fa-angle-down pt-1 appear-down-arrow"></i>
                    </div>
                </div>
            </div>
            <div class="collapse" id="appear">
                <div class=" row py-2 px-3">
                    <div class=" col">
                        <span class=" fw-bold d-block lightTextClass">Dark Mode</span>
                        <span class=" lightTextClass" style="font-size:smaller">Apply a theme</span>
                    </div>
                    <div class="col-1 text-end form-check form-switch">
                        <input type="checkbox" name="switch-color-btn" role="switch" class=" form-check-input" id="lightDarkSwitch">
                    </div>
                </div>
            </div>
        </div>
    </div>
</aside>

<nav class=" nav-mobile ">
    <div class="py-3 d-flex justify-content-between">
        <i class="fa-solid fa-comment mt-2 ms-3 fs-5 chat-icon " style="color: #536dfe"></i>
    <i class="fa-solid fa-user fs-5 mt-2 contact-icon" style="color:#e0e0e0"></i>
    <div class=" btn-group" style="width: 45px">
        <div class="" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            @if (Auth::user()->image == null)
                <img src="{{ asset('image/defaultpic.jpg') }}" alt="profile"
                    class="w-100   rounded-circle">
            @else
                <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="profile"
                    class="w-100  rounded-circle  ">
            @endif
        </div>
        <div class="dropdown-menu">
            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#profileInfo"><small
                    class=" lightTextClass " style="cursor: pointer"><i
                        class="fa-solid fa-circle-info me-2 opacity-50"></i>Personal Information</small></a>
            <a class="dropdown-item"data-bs-toggle="modal" data-bs-target="#logout" id="signOut"><small
                    class=" text-danger" style="cursor: pointer"><i
                        class="fa-solid fa-arrow-right-from-bracket me-2"></i>Logout</small></a>
        </div>
    </div>
    <i class="fa-solid fa-users  mt-2 fs-5 group-icon" style="color:#e0e0e0"></i>
    <i class="fa-solid fa-gear me-3 mt-2 fs-5 setting-icon" style="color: #e0e0e0"></i>
    </div>
</nav>

    {{-- modal for profile personal infromation  --}}
    <div class="modal fade" id="profileInfo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="width: 280px">
            <div class="modal-content ">
                <div id="profileInformation">
                    <div class="modal-header border-bottom-0">
                        <h5 class="col-6 lightTextClass">Profile Info</h5>
                        <button type="button" class="btn position-absolute mt-2 me-1 top-0 end-0"
                            data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
                    </div>

                    <div class="modal-body" style="border-bottom: 1px solid #eeeeee">
                        <div class="row ">
                            <div class=" ms-3 mt-1" style="width: 68px">

                                @if (Auth::user()->image == null)
                                    <img src="{{ asset('image/defaultpic.jpg') }}" class="w-100 rounded-circle"
                                        alt="" id="chatDefImage">
                                @else
                                    <img src="{{ asset('storage/' . Auth::user()->image) }}"
                                        class="w-100 rounded-circle" alt="" id="chatImage">
                                @endif

                            </div>
                            <div class="col">
                                <span class=" fw-bold lightTextClass d-block"> {{ Auth::user()->name }}</span>

                                <small class="text-info">{{ Auth::user()->status }}</small>

                            </div>
                        </div>
                    </div>
                    <div class="pt-3 ps-3" style="border-bottom: 1px solid #eeeeee">

                        <p class="lightTextClass"><i
                                class="fa-solid fa-phone px-3 opacity-50"></i>{{ Auth::user()->phone }}</p>
                        <p class="lightTextClass"><i class="fa-solid fa-at px-3 opacity-50"></i>{{ Auth::user()->email }}
                        </p>
                        <p class="lightTextClass"><span class="fw-bold px-3 opacity-50">bio</span>{{ Auth::user()->bio }}
                        </p>
                    </div>
                    <div class="pt-3 ps-3">

                        <p class="text-danger" id="signOut1" style="cursor: pointer"><i
                                class="fa-solid fa-arrow-right-from-bracket px-3"></i>logout</p>
                        <p class="text-danger" id="deleteAcc" style="cursor: pointer"><i
                                class="fa-regular fa-trash-can  px-3"></i>delete account</p>

                    </div>
                </div>
                <div id="logout-section" style="display:none">
                    <div class="modal-header border-bottom-0">
                        <button type="button" id="stillLogin1"
                            class="btn position-absolute mt-2 me-1 top-0 end-0 opacity-50"><i
                                class="fa-solid fa-xmark"></i></button>
                    </div>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <div class="modal-body ">
                            <p class=" lightTextClass">Are you sure to Log out this account ?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger col ">logout</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- modal for profile personal infromation end --}}

    <!-- Modal for Logout Confirm -->
    <div class="modal fade" id="logout" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="width: 280px">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <button type="button" id="stillLogin"
                        class="btn position-absolute mt-2 me-1 top-0 end-0 opacity-50" data-bs-dismiss="modal"
                        aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
                </div>
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <div class="modal-body ">
                        <p class=" lightTextClass">Are you sure to Log out this account ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger col ">logout</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal for Logout Confirm end-->
    <!-- Modal for delete Confirm -->
    <div class="modal fade" id="deleteAccModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="width: 295px">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <button type="button" id="closeDeleteAccModal"
                        class="btn position-absolute mt-2 me-1 top-0 end-0 opacity-50"><i
                            class="fa-solid fa-xmark"></i></button>
                </div>
                <form action="{{ route('profile#accountDelete') }}" method="post">
                    @csrf
                    <div class="modal-body ">
                        <p class=" lightTextClass">This will delete all of your infomation and data permanently. Are you
                            sure to delete this account ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger col ">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal for delete Confirm end-->

    {{-- modal for blocked account --}}
    <div class="modal fade" id="blockedAcc" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="width: 280px">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <h5 class="col lightTextClass">Blocked Accounts</h5>
                    <button type="button" class="btn position-absolute mt-2 me-1 top-0 end-0"
                        data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
                </div>
                <div class="modal-body overflow-y-scroll blockedacc" style="height: 35vh;">
                    @if (count($block) != 0)
                        <ul class=" list-unstyled ">
                            @foreach ($block as $b)
                                <div class=" mx-1 my-1 row lightTextClass rounded-1" style=" border:1px solid #eeeeee">
                                    <li class="my-1 lightTextClass rounded-3 border-0 text-start ">
                                        <div class=" d-flex">

                                            <div class="" style="width: 40px">
                                                @if ($b->image == null)
                                                    <img src="{{ asset('image/defaultpic.jpg') }}" alt=""
                                                        class="w-100 rounded-circle">
                                                @else
                                                    <img src="{{ asset('storage/' . $b->image) }}" alt=""
                                                        class="w-100 rounded-circle">
                                                @endif
                                            </div>
                                            <span class="col ms-3 pt-2">{{ $b->name }}</span>
                                            <a href="{{ route('chat#unblock', $b->blocked_id) }}"
                                                class=" btn text-center btn-sm btn-outline-primary pt-2 opacity-50">Unblock</a>
                                        </div>
                                    </li>
                                </div>
                            @endforeach
                        </ul>
                    @else
                        <p class="lightTextClass text-center opacity-50 mt-5">No contact found</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    {{-- modal for blocked account and --}}

     <!-- Modal for image -->
     <div class="modal fade" id="image" data-bs-backdrop="static"
        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="width: 280px">
         <div class="modal-content">
             <div class="modal-header">
                 <h1 class="modal-title fs-5 lightTextClass" id="staticBackdropLabel">Crop
                     Picture</h1>
                 <button type="button"
                     class="btn position-absolute mt-2 me-1 top-0 end-0"
                     data-bs-dismiss="modal" aria-label="Close"><i
                         class="fa-solid fa-xmark"></i></button>
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
                     alt="" class=" col w-100" id="cropImage" hidden>
             </div>

             <div class="modal-footer col">
                 <button type="button" id="crop"
                     class="btn btn-primary opacity-50 my-2 w-100">
                     Crop & Save
                 </button>
             </div>
         </div>
        </div>
    </div>
    {{-- modal for image end  --}}

    {{-- modal for add contact  --}}
    <div class="modal fade" id="addContact" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="width: 280px">
            <div class="modal-content ">
                <div class="modal-header border-bottom-0">
                    <h5 class="col-6 lightTextClass">Add Contact</h5>
                    <button type="button" class="btn position-absolute mt-2 me-1 top-0 end-0"
                        data-bs-dismiss="modal" aria-label="Close"><i
                            class="fa-solid fa-xmark"></i></button>
                </div>
                <div id="inputDataForContact">
                    <div class="modal-body">
                        <input type="email" name="email" id="addEmail"
                            class="form-control mb-2" placeholder="Email" required>
                        <input type="text" name="phone" id="addPhone"
                            class=" form-control mt-2" placeholder="Phone" required>
                    </div>

                    <div class="modal-footer ">
                        <button type="button" id="searchForAddContact"
                            class=" btn btn-primary col opacity-75">Add</button>
                    </div>
                </div>
                <form action="{{ route('contact#addContact') }}" method="post"
                    style="display: none" id="displaySearchedContact">
                    @csrf
                    <div class="searchedContact">
                        <div class="modal-body ">

                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- modal for add contact end --}}

    {{-- modal for create group --}}
    <div class="modal fade" id="createGp" data-bs-backdrop="static" data-bs-keyboard="false"
               tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
               <div class="modal-dialog modal-dialog-centered" style="width: 280px">
                   <div class="modal-content ">
                       <div class="modal-header border-bottom-0">
                           <h5 class="col-6 lightTextClass">Create Group</h5>
                           <button type="button" class="btn position-absolute mt-2 me-1 top-0 end-0"
                               data-bs-dismiss="modal" aria-label="Close"><i
                                   class="fa-solid fa-xmark"></i></button>
                       </div>
                       <form action="{{ route('group#groupChat') }}" method="post"
                           enctype="multipart/form-data">
                           @csrf
                           <div class="modal-body">
                               <input type="text" name="groupName" class=" form-control mt-2"
                                   placeholder="Name" required>
                           </div>
                           <div class=" mx-2 ps-2 mb-2 pt-3" style="border-bottom:1px solid #eeeeee;">
                               <span class="lightTextClass opacity-50">Choose Members
                               </span>
                               @if (session('exceedMember'))
                                   <small class=" text-danger" id="exceedMember">* Maximum 10 Members
                                       Allowed!</small>
                               @endif
                           </div>
                           <ul class=" list-unstyled overflow-x-scroll" id="contactScroll"
                               style=" height:20vh;">

                               @foreach ($contact as $c)
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

                                               <input type="checkbox" id="{{ $c->id }}"
                                                   name="{{ $c->add_user_id }}" class=" form-check-input"
                                                   value="{{ $c->add_user_id }}">
                                           </div>
                                       </div>
                                   </li>
                               @endforeach
                           </ul>

                           <div class="modal-footer ">
                               <button type="submit" class=" btn btn-primary col opacity-75">Create</button>
                           </div>
                       </form>
                   </div>
               </div>
    </div>
    {{-- modal for create group --}}
