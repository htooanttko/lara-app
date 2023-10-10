<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="icon" href="{{ asset('image/icons8-leaf-48.png') }}">

    {{-- link  --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('css/chat.css') }}">
        <link rel="stylesheet" href="{{ asset('css/light_dark.css') }}">
    <style>
        #displayDetailFile::-webkit-scrollbar {
            display: none;
        }
        .displaySearchMessage::-webkit-scrollbar {
            display: none;
        }
        .blockedacc::-webkit-scrollbar {
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

        #contactScroll::-webkit-scrollbar {
            display: none;
        }

        #groupScroll::-webkit-scrollbar {
            display: none;
        }

        .findPeople::-webkit-scrollbar {
            display: none;
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

    <main class=" col main-desk-chat">

        <div class="chatting-section">
            <header class=" py-2 d-flex justify-content-between">
                <a href="{{ route('dashboard') }}" class="backDashboard"><i class=" fa-solid fa-angle-left tex-muted opacity-50"></i></a>
                <div class="contact-name container">
                    <div class="row ">

                        <div class=" mt-2 " style="width: 68px">
                            {{-- get chat id --}}
                            <input type="hidden" id="chatID" value="{{ $chat->id }}">
                            <input type="hidden" id="chatName" value="{{ $chat->name }}">
                            <input type="hidden" id="AuthID" value="{{ Auth::user()->id }}">


                                @if ($chat->image == null)
                                    <img src="{{ asset('image/defaultpic.jpg') }}" class="w-100 rounded-circle"
                                        alt="" id="chatDefImage">
                                @else
                                    <img src="{{ asset('storage/' . $chat->image) }}" class="w-100 rounded-circle"
                                        alt="" id="chatImages">
                                @endif

                        </div>
                        <div class="col">
                            <span class=" fw-bold lightTextClass d-block"> {{ $chat->name }}</span>
                            @if ($chat->status == 'online')
                                <small class="">{{ $chat->status }}</small>
                            @else
                                @if (date('H') * 60 + date('i') - ($chat->updated_at->format('H') * 60 + $chat->updated_at->format('i')) > 60)
                                    <small class=" lightTextClass">Active
                                        {{ date('H') - $chat->updated_at->format('H') }}
                                        hours ago</small>
                                @elseif (date('H') * 60 + date('i') - ($chat->updated_at->format('H') * 60 + $chat->updated_at->format('i')) == 0)
                                    <small class=" lightTextClass">Active a minute ago
                                    </small>
                                @elseif (date('H') * 60 + date('i') - ($chat->updated_at->format('H') * 60 + $chat->updated_at->format('i')) > 1140)
                                    <small class=" lightTextClass">Active
                                        {{ date('d') - $chat->updated_at->format('d') }}
                                        days ago</small>
                                @elseif (date('H') * 60 + date('i') - ($chat->updated_at->format('H') * 60 + $chat->updated_at->format('i')) > 43200)
                                    <small class=" lightTextClass">Active
                                        {{ date('m') - $chat->updated_at->format('m') }}
                                        months ago</small>
                                @elseif (date('H') * 60 + date('i') - ($chat->updated_at->format('H') * 60 + $chat->updated_at->format('i')) > 525600)
                                    <small class=" lightTextClass">Active
                                        {{ date('Y') - $chat->updated_at->format('Y') }}
                                        years ago</small>
                                @else
                                    @if ($chat->updated_at->format('H') * 60 + $chat->updated_at->format('i') <= date('H') * 60 + date('i'))
                                        <small class=" lightTextClass">Active
                                            {{ date('H') * 60 + date('i') - ($chat->updated_at->format('H') * 60 + $chat->updated_at->format('i')) }}
                                            minute ago
                                        </small>
                                    @endif
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
                <div class="set d-flex pt-2">
                    <i class="fa-solid fa-magnifying-glass mt-1 lightTextClass"  data-bs-toggle="modal" data-bs-target="#searchMessage"></i>
                    <div class="dropdown">
                        <i class="fa-solid fa-ellipsis-vertical lightTextClass ps-5 "  data-bs-toggle="dropdown" aria-expanded="false"></i>

                        <ul class="dropdown-menu">
                        <li style="cursor: pointer"><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#personalInfo"><small class=" lightTextClass "><i class="fa-solid fa-circle-info me-2 opacity-50"></i>Personal Information</small></a></li>
                        <li style="cursor: pointer"><a class="dropdown-item" href="{{ route('contact#addContactByid', $chat->id) }}"><small class=" lightTextClass "><i class="fa-regular fa-square-plus me-2 opacity-50"></i>Add Contact</small></a></li>
                        <li><a class="dropdown-item" href="{{ route('chat#chatRemoveAllConver', $chat->id) }}"><small  class=" text-danger"><i class="fa-regular fa-trash-can me-2"></i>Delete Conversation</small></a></li>
                        <li><a class="dropdown-item" href="{{ route('chat#block', $chat->id) }}"><small  class=" text-danger"><i class="fa-solid fa-ban me-2"></i>Block Contact</small></a></li>
                        </ul>
                    </div>
                </div>

                {{-- modal for personal infromation  --}}
                <div class="modal fade" id="personalInfo" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" style="width: 280px">
                        <div class="modal-content " >
                            <div id="contactInfo">
                                <div class="modal-header border-bottom-0">
                                    <h5 class="col-6 lightTextClass">Contact Info</h5>
                                    <button type="button" class="btn position-absolute mt-2 me-1 top-0 end-0" data-bs-dismiss="modal"
                                        aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
                                </div>

                                <div class="modal-body" style="border-bottom: 1px solid #eeeeee">
                                        <div class="row ">
                                            <div class=" ms-3 mt-1" style="width: 68px">

                                                    @if ($chat->image == null)
                                                        <img src="{{ asset('image/defaultpic.jpg') }}" class="w-100 rounded-circle"
                                                            alt="" id="chatDefImage">
                                                    @else
                                                        <img src="{{ asset('storage/' . $chat->image) }}" class="w-100 rounded-circle"
                                                            alt="" id="chatImage">
                                                    @endif

                                            </div>
                                            <div class="col mt-1">
                                                <span class=" fw-bold lightTextClass d-block"> {{ $chat->name }}</span>
                                                @if ($chat->status == 'online')
                                                    <small class=" text-info">{{ $chat->status }}</small>
                                                @else
                                                    @if (date('H') * 60 + date('i') - ($chat->updated_at->format('H') * 60 + $chat->updated_at->format('i')) > 60)
                                                        <small class=" lightTextClass">Active
                                                            {{ date('H') - $chat->updated_at->format('H') }}
                                                            hours ago</small>
                                                    @elseif (date('H') * 60 + date('i') - ($chat->updated_at->format('H') * 60 + $chat->updated_at->format('i')) == 0)
                                                        <small class=" lightTextClass">Active a minute ago
                                                        </small>
                                                    @elseif (date('H') * 60 + date('i') - ($chat->updated_at->format('H') * 60 + $chat->updated_at->format('i')) > 1140)
                                                        <small class=" lightTextClass">Active
                                                            {{ date('d') - $chat->updated_at->format('d') }}
                                                            days ago</small>
                                                    @elseif (date('H') * 60 + date('i') - ($chat->updated_at->format('H') * 60 + $chat->updated_at->format('i')) > 43200)
                                                        <small class=" lightTextClass">Active
                                                            {{ date('m') - $chat->updated_at->format('m') }}
                                                            months ago</small>
                                                    @elseif (date('H') * 60 + date('i') - ($chat->updated_at->format('H') * 60 + $chat->updated_at->format('i')) > 525600)
                                                        <small class=" lightTextClass">Active
                                                            {{ date('Y') - $chat->updated_at->format('Y') }}
                                                            years ago</small>
                                                    @else
                                                        @if ($chat->updated_at->format('H') * 60 + $chat->updated_at->format('i') <= date('H') * 60 + date('i'))
                                                            <small class=" lightTextClass">Active
                                                                {{ date('H') * 60 + date('i') - ($chat->updated_at->format('H') * 60 + $chat->updated_at->format('i')) }}
                                                                minute ago
                                                            </small>
                                                        @endif
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                </div>
                                <div class="pt-3 ps-3" style="border-bottom: 1px solid #eeeeee">

                                        <p class="lightTextClass"><i class="fa-solid fa-phone px-3 opacity-50"></i>{{ $chat->phone }}</p>
                                        <p class="lightTextClass"><i class="fa-solid fa-at px-3 opacity-50"></i>{{ $chat->email }}</p>
                                        <div class="lightTextClass d-flex " id="sharedMedia"  style="cursor: pointer"><p class="col"><i class="fa-solid fa-share-nodes px-3 opacity-50"></i>Shared Media</p><p class=" pe-4" style="width: 10px"><i class="fa-solid fa-angle-right"></i></p></div>


                                </div>
                                <div class="pt-3 ps-3">
                                        <a href="{{ route('chat#block', $chat->id) }}" class=" text-decoration-none">
                                            <p class="text-danger"><i class="fa-solid fa-ban px-3"></i>block contact</p>
                                        </a>
                                        <a href="{{ route('chat#chatRemove', $chat->id) }}"  class=" text-decoration-none">
                                            <p class="text-danger"><i class="fa-regular fa-trash-can  px-3"></i>delete contact</p>
                                        </a>
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
                        </div>
                    </div>
                </div>
                {{-- modal for personal infromation end --}}
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
                                        <input type="text" name="searchMessage" class=" form-control bg-light" id="searchMessageInput" placeholder="Search" required>
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
            @if(session('errorchat'))
                <div class="alert d-flex alert-warning alert-dismissible fade show" role="alert">
                   <p class="col">{{ session('errorchat') }}</p>
                    <button type="button" class="close btn col-1" data-bs-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                @endif
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
                       <div class="messenge-send">
                        <div class="d-flex">
                            <span class="file-attach pt-1 text-center " style="width: 50px"><i class="fa-solid fa-paperclip lightTextClass"
                                    data-bs-toggle="modal" data-bs-target="#fileUpload"></i>
                            </span>

                            <input type="hidden" name="firstUser" id="firstUser" value="{{ Auth::user()->id }}">
                            <input type="hidden" name="secUser" id="secUser" value="{{ $chat->id }}">

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

                            <div class=" text-center" style="width: 100px">
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

                                        <div class="ms-1 text-center" style="width: 50px">
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

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

{{-- sound wave  --}}
<script src="https://unpkg.com/wavesurfer.js@7"></script>
<script src="{{ asset('js/chat.js') }}"></script>
<script src="{{ asset('js/contact.js') }}"></script>
<script src="{{ asset('js/light_dark.js') }}"></script>
<script src="{{ asset('js/setting.js') }}"></script>

<script>
    $(document).ready(function() {
    $(".chat-icon").click(() => {
        $(".chat-section").fadeIn(1500);
        $(".chat-icon").css("color", "#536dfe");
        $(".contact-icon").css("color", "#e0e0e0");
        $(".group-icon").css("color", "#e0e0e0");
         $('.moon-icon').css('color','#e0e0e0');
        $('.sun-icon').css('color','#e0e0e0');
        $(".setting-icon").css("color", "#e0e0e0");
        $(".contact-section").css("display", "none");
        $(".group-section").css("display", "none");
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

        $.ajax({
            url: '/status/online',
            type: 'GET',
            datatype: 'json',
            data: {
                'status': 'online',
            }
        })

        $('#stillLogin').click(function() {
            $.ajax({
                url: '/status/online',
                type: 'GET',
                datatype: 'json',
                data: {
                    'status': 'online',
                }
            })
        })

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

        $('#stillLogin1').click(function() {
            $('#logout-section').css('display', 'none');
            $('#profileInformation').fadeIn();
            $.ajax({
                url: '/status/online',
                type: 'GET',
                datatype: 'json',
                data: {
                    'status': 'online',
                }
            })
        })

        $('#signOut1').click(function() {
            $('#profileInformation').css('display', 'none');
            $('#logout-section').fadeIn();
            $.ajax({
                url: '/status/offline',
                type: 'GET',
                datatype: 'json',
                data: {
                    'status': 'offline',
                }
            })
        })

        $('#deleteAcc').click(() => {
            $('#deleteAccModal').modal('show');
            $('#profileInfo').modal('hide');
        })
        $('#closeDeleteAccModal').click(() => {
            $('#deleteAccModal').modal('hide');
            $('#profileInfo').modal('show');
        })

        // from chat page start

        $.ajax({
            url: `/chat/message/seen/${$("#secUser").val()}`,
            type: 'GET',
            datatype: 'json'
        })

        var element = document.getElementsByClassName("scroll");
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

        // from chat page end

        var url = window.location.href;
        var params = new URLSearchParams(url.split('?')[1]);
        var paramValue = params.get('search');
        var paramValue2 = params.get('contact');

        if (paramValue) {
            $('.modalSearch').modal("show");
        }
        if (paramValue2) {
            $('.modalContact').modal("show");
            $("#createGP").attr("type", "submit");
        }
        if ($('#exceedMember').html()) {
            $('.modalNewGroup').modal("show");
        }
    });
</script>

</html>


