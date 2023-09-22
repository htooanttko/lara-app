<section>
    <div class="row container-fluid">
        <!-- contact section start -->
        <div class="col-md">
            <div class="px-3 h-100 mt-2 rounded-3" style="background-color: rgb(51, 51, 51); height:86vh;">
                {{--
                <div class="py-2">
                    <div class="container-fluid">
                        <form class="col" role="search">

                            <input class="form-control me-2  mt-2 text-white w-100 text-center rounded-pill"
                                style="border: 1px solid rgb(92, 92, 92); background-color: rgb(92, 92, 92);"
                                type="search Chats" placeholder="Search Contacts" aria-label="Search ">

                        </form>
                    </div>
                </div> --}}

                <div class="text-white fs-3 ps-3 mb-2" style=" border-bottom: 1px solid white;">Contacts</div>

                <ul class="list-group list-group-flush overflow-auto" id="contactScroll"
                    style="border-bottom:1px solid black; height:35vh">

                    @foreach ($contact as $c)
                        <a href="{{ route('chat#chatPage', $c->add_user_id) }}" class=" text-decoration-none rounded">
                            <li class="list-group-item d-flex my-1 text-white border-secondary"
                                style="background-color: rgb(51, 51, 51); ">

                                <div class="col-3">
                                    @if ($c->image == null)
                                        <img src="{{ asset('image/defaultpic.jpg') }}" alt=""
                                            class=" w-100  rounded-circle">
                                    @else
                                        <img src="{{ asset('storage/' . $c->image) }}" alt=""
                                            class=" w-100 rounded-circle">
                                    @endif
                                </div>
                                <div class=" col pt-1 ms-3">
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

                <div class="text-white fs-3 ps-3 mb-2 mt-1" style=" border-bottom: 1px solid white;">Groups</div>
                <ul class="list-group list-group-flush  overflow-auto" id="groupScroll" style="height:36vh">
                    @foreach ($group as $g)
                        <a href="{{ route('group#groupChatPage', $g->id) }}" class=" text-decoration-none rounded">
                            <li class="list-group-item d-flex my-1 text-white border-secondary"
                                style="background-color: rgb(51, 51, 51); ">
                                <div class=" col-3">
                                    @if ($g->group_image == null)
                                        <img src="{{ asset('image/defaultpic.jpg') }}" alt=""
                                            class="w-100 rounded-circle">
                                    @else
                                        <img src="{{ asset('storage/' . $g->group_image) }}" alt=""
                                            class="w-100 rounded-circle">
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
            </div>


        </div>
        <!-- contact section end -->


        <div class="col-md-7">
            <div class=" px-3 mt-2 rounded-3" style="height:86vh; border:1px solid grey">
                <h5 class=" text-white-50 text-center" style="padding-top: 37%">Select a chat to start conversation</h5>
            </div>
        </div>
        <div class="col"></div>

    </div>
</section>
