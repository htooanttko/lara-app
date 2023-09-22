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
                                                class=" w-100 rounded-circle">
                                        @else
                                            <img src="{{ asset('storage/' . $c->image) }}" alt=""
                                                class=" w-100 rounded-circle">
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

                </div>

            </div>
            <!-- contact section end -->

            <!-- chat section start  -->
            <div class="col-md-7 mt-2 rounded-4" style="background-color:rgb(92, 92, 92); height: 87vh;">

                <div class="col">
                    <div class="row rounded-top-4" style="height: 65px; background-color: rgb(59, 59, 59);">
                        {{-- <div class=" col-1 pt-2 ms-3">
                            @if ($chat->image == null)
                                <img src="{{ asset('image/defaultpic.jpg') }}" class="w-100 rounded-circle shadow-lg"
                                    alt="">
                            @else
                                <img src="{{ asset('storage/' . $chat->image) }}" class="w-100 rounded-circle shadow-lg"
                                    alt="">
                            @endif
                        </div> --}}
                        <h5 class=" col-6 p-3 mt-1 text-white">Saved Messages</h5>
                        <div class=" offset-2 col-3 p-3 text-end">
                            <div data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa-solid fa-circle-info fs-4 mt-2 text-white-50"></i>
                            </div>
                            <div class="dropdown-menu bg-dark">
                                <div class=" text-white  border-bottom border-secondary text-center">
                                    {{-- Add Group Member --}}
                                    <!-- Button trigger modal-->
                                    <a href="{{ route('chat#saveMessageClearAll') }}" class="btn btn-dark text-start">
                                        Clear All Messages
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- display message start  --}}
                <div class=" overflow-auto" id="scroll" style=" height: 80%; -webkit-overflow-scrolling: none">
                    @foreach ($message as $m)
                        @if (Auth::user()->id == $m->fir_user_id && Auth::user()->id == $m->sec_user_id)
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
                                            <a href="{{ route('chat#saveSendMessageDeletePar', $m->chat_code) }}"><i
                                                    class="fa-solid fa-trash  opacity-50 text-dark"></i></a>
                                        </div>
                                    </div>
                                @else
                                    @if ($m->image == null)
                                        <div class="clickToReply">
                                            <div
                                                class=" form-control rounded-5 bg-dark border-0 p-1 mt-4 text-white text-end d-inline-block pe-4 shadow">
                                                @if ($m->reply_chat_code != null)
                                                    <div class=" opacity-25 text-start ms-3 border-bottom border-2"><i
                                                            class="fa-solid fa-reply pe-2 pt-3 text-white-50"></i>
                                                        @foreach ($message as $mg)
                                                            @if ($mg->chat_code == $m->reply_chat_code)
                                                                {{ $mg->text }}
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                @endif
                                                {{ $m->text }}
                                                <div class=" text-start ps-3 text-white-50">
                                                    {{ $m->created_at->format('H:i A') }}
                                                </div>
                                            </div>
                                            <div class="reply" style=" display:none">
                                                <a href="{{ route('chat#saveSendMessageReply', $m->chat_code) }}"><i
                                                        class="fa-solid fa-reply opacity-50 text-dark"></i></a>
                                                <a href="{{ route('chat#saveSendMessageDelete', $m->chat_code) }}"><i
                                                        class="fa-solid fa-trash  opacity-50 text-dark"></i></a>
                                            </div>
                                        </div>
                                    @else
                                        @if ($m->text == null)
                                            <div class="clickToReply">
                                                <div class=" mt-4 ">
                                                    @if ($m->reply_chat_code != null)
                                                        <div class=" opacity-50 text-start ms-3 rounded-5 border-2"><i
                                                                class="fa-solid fa-reply pe-2 pt-3"></i>
                                                            @foreach ($message as $mg)
                                                                @if ($mg->chat_code == $m->reply_chat_code)
                                                                    {{ $mg->text }}
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                    <img src="{{ asset('storage/' . $m->image) }}"
                                                        class=" w-100 rounded-4 shadow-lg" alt="">
                                                </div>
                                                <div class="reply" style=" display:none">
                                                    <a href="{{ route('chat#saveSendMessageReply', $m->chat_code) }}"><i
                                                            class="fa-solid fa-reply  opacity-50 text-dark"></i></a>
                                                    <a
                                                        href="{{ route('chat#saveSendMessageDelete', $m->chat_code) }}"><i
                                                            class="fa-solid fa-trash  opacity-50 text-dark"></i></a>
                                                </div>
                                            </div>
                                        @else
                                            <div class=" clickToReply">
                                                <div
                                                    class="  form-control rounded-5 bg-dark border-0 p-1 mt-4 text-white text-end d-inline-block pe-4 shadow">
                                                    @if ($m->reply_chat_code != null)
                                                        <div
                                                            class=" opacity-25 text-start ms-3 border-bottom border-2">
                                                            <i class="fa-solid fa-reply pe-2 pt-3 text-white-50"></i>
                                                            @foreach ($message as $mg)
                                                                @if ($mg->chat_code == $m->reply_chat_code)
                                                                    {{ $mg->text }}
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                    {{ $m->text }}
                                                    <div class=" text-start ps-3 text-white-50">
                                                        {{ $m->created_at->format('H:i A') }}
                                                    </div>
                                                </div>
                                                <img src="{{ asset('storage/' . $m->image) }}"
                                                    class="w-100 mt-1 rounded-4 shadow-lg" alt="">
                                                <div class="reply" style=" display:none">
                                                    <a href="{{ route('chat#saveSendMessageReply', $m->chat_code) }}"><i
                                                            class="fa-solid fa-reply  opacity-50 text-dark"></i></a>
                                                    <a
                                                        href="{{ route('chat#saveSendMessageDelete', $m->chat_code) }}"><i
                                                            class="fa-solid fa-trash  opacity-50 text-dark"></i></a>
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
                                <a href="{{ route('chat#saveSendMessageReplyCancel', $reply->sec_user_id) }}"
                                    class="col"><i class="fa-solid fa-xmark text-dark fs-3 pt-3"></i></a>
                            </div>
                        @else
                        @endif
                    </div>
                    {{-- reply end  --}}
                    <!-- message send start -->
                    <form action="{{ route('chat#saveSendMessage') }}" method="POST"
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
                                <div class="dropdown-menu mb-3 bg-dark" id="dropdown-menu">

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
                <div class=" mt-2 rounded-3  overflow-auto" id="detailScroll"
                    style="background-color: rgb(51, 51, 51); height:87vh">
                    <div class="px-3 pt-2">
                        <div class="text-white fs-5 mt-2 ps-3 mb-2" style=" border-bottom: 1px solid white;">Images
                        </div>

                        <div class=" mt-3">
                            @foreach ($imageOrder as $io)
                                @if ($io->fir_user_id == $io->sec_user_id)
                                    <div class=" d-flex" data-bs-toggle="modal"
                                        data-bs-target="#{{ $io->image }}">
                                        <div class=" overflow-hidden rounded-3 mb-2" style="height: 150px">
                                            <img src="{{ asset('storage/' . $io->image) }}"
                                                class="w-100 rounded  shadow-lg" alt="">
                                        </div>
                                    </div>
                                @else
                                @endif

                                {{-- Modal for Detail Image  --}}
                                <div class="modal fade" id="{{ $io->image }}" data-bs-backdrop="static"
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
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- detail end  -->

        </div>
    </section>
    <!-- Modal for file upload -->
    <div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-dark border-bottom-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('chat#saveSendMessage') }}" enctype="multipart/form-data" method="post">
                    @csrf

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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<script>
    $(document).ready(function() {
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

        $(".clickToReply").mouseenter(function() {
            $(this).find('.reply').delay(400).fadeIn();
        })

        $(".clickToReply").mouseleave(function() {
            $(this).find('.reply').delay(300).fadeOut();
        })

        $("#scroll").on('scroll', function() {
            scrolled = true;
        });

        setInterval(updateScroll, 1000);

        $('#scrollDown').click(function() {
            $("#scroll").animate({
                scrollTop: $('#scroll')[0].scrollHeight
            }, 1000);
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
