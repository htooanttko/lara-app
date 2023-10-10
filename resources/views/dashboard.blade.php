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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-jcrop/0.9.15/css/jquery.Jcrop.min.css"
        integrity="sha512-bbAsdySYlqC/kxg7Id5vEUVWy3nOfYKzVHCKDFgiT+GsHG/3MD7ywtJnJNSgw++HBc+w4j71MLiaeVm1XY5KDQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/light_dark.css') }}">
    <style>
        #contactScroll::-webkit-scrollbar {
            display: none;
        }

        .blockedacc::-webkit-scrollbar {
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

        .preview {
            width: 160px;
            height: 160px;
            margin: auto;
            border: 2px solid #536dfe;
        }
    </style>

    <title>SnapView</title>
</head>

<body class="row container-fluid">
    <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">

    @include('nav_&_aside')

    <main class="main-desk col">
        <div class=" chatting-section d-flex justify-content-center align-items-center opacity-50"
            style="height:100vh">
            <div class=" lightTextClass text-center ">
                <p class="btn btn-light lightTextClass rounded-circle opacity-75 fs-4"><i class="fa-solid fa-comment"></i></p>
                <p class=" fw-bold">No chat selected</p>
                <p>Select a conversation from your contact</p>
            </div>
        </div>
    </main>

    @yield('content')
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
    integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ asset('js/chat.js') }}"></script>
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
        $('.moon-icon').css('color','#e0e0e0');
        $('.sun-icon').css('color','#e0e0e0');
        $('.contact-icon').css('color','#e0e0e0');
        $('.chat-icon').css('color','#e0e0e0');
        $('.group-section').css('display','none');
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
        $('.moon-icon').css('color','#e0e0e0');
        $('.sun-icon').css('color','#e0e0e0');
        $('.setting-icon').css('color','#e0e0e0');
        $('.chat-section').css('display','none');
        $('.group-section').css('display','none');
        $('.setting-section').css('display','none');
    });

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
