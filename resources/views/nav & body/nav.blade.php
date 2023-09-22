<nav class="container-fluid ">
    <div class="row" style="height: 75px; background-color: rgb(51, 51, 51);">
        <a href="{{ route('dashboard') }}" class="col-md-4 text-start btn pt-2 text-white"><span
                style="font-weight: bolder;font-size: 35px;">SnapView</span></a>
        <div class=" offset-5 col-md-3 text-end">

            {{-- find people start  --}}
            <!-- Button trigger modal -->
            <span class=" rounded-circle me-5" data-bs-toggle="modal" data-bs-target="#searchPeople">
                <i class="fa-solid fa-magnifying-glass text-white fw-bolder fs-5 me-5"></i>
            </span>

            <!-- Modal -->
            <div class="modal fade modalSearch" id="searchPeople" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header "
                            style="background-color: rgb(51, 51, 51); border-bottom: 1px solid black">
                            <div class="container-fluid">
                                <form method="GET" action="{{ route('dashboard') }}" class="col" id="search"
                                    role="search">
                                    <input class="form-control me-2  mt-2 text-white w-100 text-center rounded-pill"
                                        name="search" value="{{ request('search') }}"
                                        style="border: 1px solid rgb(92, 92, 92); background-color: rgb(92, 92, 92);"
                                        type="text" placeholder="Search" aria-label="Search">
                                </form>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body bg-dark findPeople">
                            @if (count($people) != 0)
                                <ul class="list-group list-group-flush">
                                    @foreach ($people as $p)
                                        @if (Auth::user()->id != $p->id)
                                            <form action="{{ route('contact#addContact') }}" method="post"
                                                class=" mx-3 my-1 row">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-secondary text-white">
                                                    <li
                                                        class="list-group-item my-1 text-white bg-dark rounded-3 border-0 text-start ">
                                                        <div class="row">

                                                            @if ($p->image == null)
                                                                <img src="{{ asset('image/defaultpic.jpg') }}"
                                                                    alt="" class="col-2 ms-4 rounded-circle">
                                                            @else
                                                                <img src="{{ asset('storage/' . $p->image) }}"
                                                                    alt="" class="col-2 ms-4 rounded-circle">
                                                            @endif
                                                            <span class="col ms-3 pt-2">{{ $p->name }}</span>
                                                            <input type="hidden" name="addUserId"
                                                                value="{{ $p->id }}">
                                                            <input type="hidden" name="userId"
                                                                value="{{ Auth::user()->id }}">
                                                        </div>
                                                    </li>
                                                </button>
                                            </form>
                                        @else
                                        @endif
                                    @endforeach
                                </ul>
                            @else
                                <h5 class="text-white-50 text-center mt-3">Result Not Found</h5>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            {{-- find people end  --}}

            {{-- Profile Start  --}}
            <div class="btn rounded-circle" style="width: 30%;">
                <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                    aria-controls="offcanvasRight">
                    @if (Auth::user()->image == null)
                        <img src="{{ asset('image/defaultpic.jpg') }}" class="w-100 rounded-circle" alt="">
                    @else
                        <img src="{{ asset('storage/' . Auth::user()->image) }}" class="w-100 rounded-circle"
                            alt="">
                    @endif
                </button>

                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight"
                    aria-labelledby="offcanvasRightLabel">
                    <div class="offcanvas-body bg-dark">
                        <ul class="list-group list-group-flush">
                            {{-- account start  --}}
                            <a href="{{ route('profile#accountPage') }}"
                                class=" text-decoration-none my-3 border-bottom border-secondary">
                                <li class="list-group-item  text-white bg-dark p-3 border-0 text-start">
                                    Account </li>
                            </a>
                            {{-- account end  --}}

                            {{-- new group start  --}}
                            <!-- Button trigger modal -->
                            <a type="button" style="list-style: none"
                                class=" text-decoration-none my-3 border-bottom border-secondary" data-bs-toggle="modal"
                                data-bs-target="#newGroup">
                                <li class="list-group-item  text-white bg-dark p-3 border-0 text-start">New Group
                                </li>
                            </a>
                            {{-- new group end  --}}


                            <a href="{{ route('chat#saveMessage') }}"
                                class=" text-decoration-none my-3 border-bottom border-secondary">
                                <li class="list-group-item  text-white bg-dark p-3 border-0 text-start">Saved
                                    Messages
                                </li>
                            </a>


                            <!-- Button trigger modal -->
                            <a type="button" data-bs-toggle="modal"
                                class="border-bottom my-3 border-secondary text-decoration-none"
                                data-bs-target="#changePassword">
                                <li class="list-group-item  text-white bg-dark p-3 border-0 text-start ">Change
                                    Password
                                </li>
                            </a>

                            <!-- Button trigger modal -->
                            <a type="button" data-bs-toggle="modal"
                                class="border-bottom my-3 border-secondary text-decoration-none"
                                data-bs-target="#blockedAccounts">
                                <li class="list-group-item  text-white bg-dark p-3 border-0 text-start ">Blocked
                                    Accounts
                                </li>
                            </a>

                        </ul>
                        {{-- log out start  --}}

                            <button class=" btn btn-outline-secondary my-3 py-2 px-5 text-white text-start" data-bs-toggle="modal"
                            class="border-bottom my-3 border-secondary text-decoration-none"
                            data-bs-target="#logOut" id="signOut">Sign Out
                            </button>

                        {{-- log out end --}}
                    </div>
                </div>

            </div>
            {{-- Profile End  --}}

            {{-- <svg xmlns="http://www.w3.org/2000/svg" class="ms-5 mb-1" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-moon"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg> --}}
            <svg xmlns="http://www.w3.org/2000/svg" class=" text-white me-3 mb-1" width="24" height="24"
                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" class="feather feather-sun">
                <circle cx="12" cy="12" r="5"></circle>
                <line x1="12" y1="1" x2="12" y2="3"></line>
                <line x1="12" y1="21" x2="12" y2="23"></line>
                <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                <line x1="1" y1="12" x2="3" y2="12"></line>
                <line x1="21" y1="12" x2="23" y2="12"></line>
                <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
            </svg>

        </div>
    </div>

     <!-- Modal for Logout Confirm -->
     <div class="modal fade" id="logOut" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog">
         <div class="modal-content">
             <form action="{{ route('logout') }}" method="post">
                @csrf
                <div class="modal-body bg-dark ">
                    <p class=" text-white-50 pt-3">Are you sure to Log out this account ?</p>
                </div>
                 <div class="modal-footer bg-dark border-dark">
                     <button type="button" id="stillLogin" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                     <button type="submit" class="btn btn-secondary">Yes</button>
                 </div>
             </form>
         </div>
     </div>
 </div>

    <!-- Modal for change password -->
    <div class="modal fade" id="changePassword" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: rgb(51, 51, 51); border-bottom: 1px solid black">
                    <h4 class="modal-title text-white" id="staticBackdropLabel">Change Password</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('profile#accountPasswordChange') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body bg-dark">
                        <div class=" col-10 offset-1 mt-4">
                            <input type="password" name="oldPassword" id="oldPw"
                                class="bg-secondary form-control text-white border-0"
                                placeholder="Enter Old Password">
                        </div>
                        <div class=" col-10 offset-1 mt-4">
                            <input type="password" name="newPassword" id="oldPw"
                                class="bg-secondary form-control text-white border-0"
                                placeholder="Enter New Password">
                        </div>
                        <div class=" col-10 offset-1 mt-4">
                            <input type="password" name="confirmNewPassword" id="oldPw"
                                class="bg-secondary form-control text-white border-0"
                                placeholder="Confirm New Password">
                        </div>
                    </div>
                    <div class="modal-footer bg-dark border-dark">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-secondary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal for blocked account -->
    <div class="modal fade modalBlock" id="blockedAccounts" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header " style="background-color: rgb(51, 51, 51); border-bottom: 1px solid black">
                    <h4 class="modal-title text-white" id="staticBackdropLabel">Blocked</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body bg-dark findPeople">
                    @if (count($block) != 0)
                    <ul class="list-group list-group-flush">
                        @foreach ($block as $b)

                                <div class=" mx-3 my-1 row text-white rounded-1" style=" border:1px solid grey">
                                        <li
                                            class="list-group-item my-1 text-white bg-dark rounded-3 border-0 text-start ">
                                            <div class="row">

                                                @if ($b->image == null)
                                                    <img src="{{ asset('image/defaultpic.jpg') }}"
                                                        alt="" class="col-2 ms-4 rounded-circle">
                                                @else
                                                    <img src="{{ asset('storage/' . $b->image) }}"
                                                        alt="" class="col-2 ms-4 rounded-circle">
                                                @endif
                                                <span class="col ms-3 pt-2">{{ $b->name }}</span>
                                                <a href="{{ route('chat#unblock',$b->blocked_id) }}" class="col-2 me-2 btn btn-sm text-center btn-secondary" style="padding-top: 12px">Unblock</a>
                                            </div>
                                        </li>
                                    </button>
                                </div>
                        @endforeach
                    </ul>
                @else
                    <h5 class="text-white-50 text-center mt-3">Result Not Found</h5>
                @endif
                </div>
            </div>
        </div>
    </div>
    <!-- Modal for new group -->
    <div class="modal fade modalNewGroup" id="newGroup" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header " style="background-color: rgb(51, 51, 51); border-bottom: 1px solid black">
                    <div class="container-fluid text-white">
                        <h4 class=" text-white">Create New Group</h4>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('group#groupChat') }}" method="post" enctype="multipart/form-data">
                    <div class="modal-body bg-dark">
                        <div class="text-white fs-5 ps-2 my-2">Group Name</div>
                        <div class=" col-10 offset-1">
                            <input class="form-control mt-2 mb-3 text-white w-100 rounded" name="groupName"
                                style="border: 1px solid rgb(92, 92, 92); background-color: rgb(92, 92, 92);"
                                type="text" placeholder="Enter Group Name">
                        </div>

                        <div class="  ps-2 mb-2 pt-3" style="border-top:1px solid black;">
                            <div class="text-white fs-5">Choose Members
                            </div>
                            @if (session('exceedMember'))
                                <small class=" text-danger" id="exceedMember">* Maximum 10 Members Allowed!</small>
                            @endif
                        </div>
                        @csrf
                        <input type="hidden" name="userId" value="{{ Auth::user()->id }}">
                        <ul class="list-group list-group-flush overflow-auto" id="contactScroll"
                            style=" height:40vh;">

                            @foreach ($contact as $c)
                                <li class="list-group-item my-1 text-white rounded border-dark"
                                    style="background-color: rgb(51, 51, 51); ">
                                    <div class=" row">
                                        <label for="{{ $c->id }}" class=" form-check-label col">
                                            @if ($c->image == null)
                                                <img src="{{ asset('image/defaultpic.jpg') }}" alt=""
                                                    class=" col-2 rounded-circle">
                                            @else
                                                <img src="{{ asset('storage/' . $c->image) }}" alt=""
                                                    class=" col-2 rounded-circle">
                                            @endif
                                            <span class="col pt-3 ms-3">{{ $c->name }}</span>
                                        </label>
                                        <div class=" col-1 pt-3">

                                            <input type="checkbox" id="{{ $c->id }}"
                                                name="{{ $c->add_user_id }}" class=" form-check-input"
                                                value="{{ $c->add_user_id }}">
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>


                    </div>
                    <div class="modal-footer bg-dark border-dark">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="createGP" class="btn btn-secondary text-dark">Create
                            Group</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</nav>
