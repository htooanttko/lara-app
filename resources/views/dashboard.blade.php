<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.bunny.net">

    {{-- link  --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <style>
        #contactScroll::-webkit-scrollbar {
            display: none;
        }

        #groupScroll::-webkit-scrollbar {
            display: none;
        }

        .findPeople::-webkit-scrollbar {
            display: none;
        }
    </style>

    <title>SnapView</title>
</head>

<body class=" bg-dark">
    <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">

    {{-- nav section start  --}}
    @include('nav & body.nav')
    {{-- nav section end  --}}

    {{-- home start  --}}
    @include('nav & body.body')
    {{-- home end  --}}

    @yield('content')
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $.ajax({
            url: '/status/online',
            type: 'GET',
            datatype: 'json',
            data: {
                'status': 'online',
            }
        })

        $('#stillLogin').click(function(){
            $.ajax({
            url: '/status/online',
            type: 'GET',
            datatype: 'json',
            data: {
                'status': 'online',
            }
        })
        })

        $('#signOut').click(function(){
            $.ajax({
                url: '/status/offline',
                type: 'GET',
                datatype: 'json',
                data: {
                    'status': 'offline',
                }
            })
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
