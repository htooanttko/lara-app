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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-jcrop/0.9.15/css/jquery.Jcrop.min.css"
        integrity="sha512-bbAsdySYlqC/kxg7Id5vEUVWy3nOfYKzVHCKDFgiT+GsHG/3MD7ywtJnJNSgw++HBc+w4j71MLiaeVm1XY5KDQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .preview {
            text-align: center;
            overflow: hidden;
            width: 160px;
            height: 160px;
            margin:auto;
            border: 2px solid black
        }

        .findPeople::-webkit-scrollbar {
            display: none;
        }

    </style>
    <title>Profile</title>
</head>

<body class=" bg-dark">
    @include('nav & body.nav')
    <div class=" container-fluid mt-3">
        <div class="row">
            <div class="row col-8 shadow-lg p-5 rounded mx-5" style="background-color: rgb(51, 51, 51);">
                <h4 class="text-white pb-2" style="border-bottom: 1px solid grey">Account</h4>
                <div class="col-4">

                    {{-- image start  --}}
                    <!-- Button trigger modal -->
                    <label class="btn btn-dark w-100 mt-4">
                        @if (Auth::user()->image == null)
                            <img src="{{ asset('image/defaultpic.jpg') }}"
                                class="w-100 rounded-3 shadow-lg position-relative profilePic" alt="">
                        @else
                            <img src="{{ asset('storage/' . Auth::user()->image) }}"
                                class="w-100 rounded-3 shadow-lg position-relative profilePic" alt="">
                        @endif
                        <small class=" text-white-50 d-block">tap to change picture</small>
                        <input type="file" name="image" class="cropImage d-none"
                            style="border: 1px solid rgb(92, 92, 92); background-color: rgb(92, 92, 92);">
                    </label>

                    <!-- Modal for image -->
                    <div class="modal fade" id="image" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header  bg-secondary" style="border-bottom: 1px solid black">
                                    <h1 class="modal-title fs-5 " id="staticBackdropLabel">Crop Picture</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class=" bg-dark py-3">
                                    <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="id" id="id" value="{{ Auth::user()->id }}">
                                        <div class="preview"></div>
                                </div>
                                <div class="modal-body bg-dark overflow-hidden" style="height: 45vh; border:1px solid black; filter:brightness(50%)">
                                    <img src="{{ asset('storage/' . Auth::user()->image) }}" alt=""
                                        class=" col w-100" id="cropImage" hidden>
                                </div>
                                <div class="modal-footer bg-dark" style="border-top: 1px solid black">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                    <button type="button" id="crop" class="btn btn-secondary text-dark my-2">
                                        Crop & Save
                                    </button>
                                </div>
                            </div>
                        </div>
                        {{-- image end  --}}
                    </div>

                </div>
                <div class="col">

                    <div class="row py-3 px-4">

                        {{-- username start  --}}
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-dark my-2" data-bs-toggle="modal"
                            data-bs-target="#userName">
                            <div class=" text-start ">
                                usename - <span class=" fs-5 fw-bold">{{ Auth::user()->name }}</span>
                                <small class=" text-white-50 d-block text-end">tap to change username</small>
                            </div>
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="userName" data-bs-backdrop="static" data-bs-keyboard="false"
                            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-secondary" style="border-bottom: 1px solid black">
                                        <h1 class="modal-title fs-5 " id="staticBackdropLabel">Change Username</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('profile#accountName') }}" method="POST">
                                        @csrf
                                        <div class="modal-body bg-dark">
                                            <div class=" py-3">
                                                <input type="text" name="name" id="username"
                                                    class="form-control me-2  mt-2 text-white w-100  rounded"
                                                    style="border: 1px solid rgb(92, 92, 92); background-color: rgb(92, 92, 92);"
                                                    placeholder="Enter New Username">
                                            </div>
                                        </div>
                                        <div class="modal-footer bg-dark" style="border-top: 1px solid grey">
                                            <button type="button" class="btn btn-danger"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-secondary text-dark">Save
                                                Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{-- username end  --}}

                        {{-- phone start  --}}
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-dark my-2" data-bs-toggle="modal"
                            data-bs-target="#phone">
                            <div class=" text-start ">
                                phone - <span class=" fs-5 fw-bold">{{ Auth::user()->phone }}</span>
                                <small class=" text-white-50 d-block text-end">tap to change number</small>
                            </div>
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="phone" data-bs-backdrop="static" data-bs-keyboard="false"
                            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-secondary" style="border-bottom: 1px solid black">
                                        <h1 class="modal-title fs-5 " id="staticBackdropLabel">Change Phone Number
                                        </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('profile#accountPhone') }}" method="POST">
                                        @csrf
                                        <div class="modal-body bg-dark">
                                            <div class=" py-3">
                                                <input type="number" name="phone" id="phone"
                                                    class="form-control me-2  mt-2 text-white w-100  rounded"
                                                    style="border: 1px solid rgb(92, 92, 92); background-color: rgb(92, 92, 92);"
                                                    placeholder="Enter New Phone Number">
                                            </div>
                                        </div>
                                        <div class="modal-footer bg-dark" style="border-top: 1px solid grey">
                                            <button type="button" class="btn btn-danger"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-secondary text-dark">Save
                                                Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{-- phone end  --}}

                        {{-- email start  --}}
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-dark my-2" data-bs-toggle="modal"
                            data-bs-target="#email">
                            <div class=" text-start ">
                                email - <span class=" fs-5 fw-bold">{{ Auth::user()->email }}</span>
                                <small class=" text-white-50 d-block text-end">tap to change email</small>
                            </div>
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="email" data-bs-backdrop="static" data-bs-keyboard="false"
                            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-secondary" style="border-bottom: 1px solid black">
                                        <h1 class="modal-title fs-5 " id="staticBackdropLabel">Change Email</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('profile#accountEmail') }}" method="POST">
                                        @csrf
                                        <div class="modal-body bg-dark">
                                            <div class=" py-3">
                                                <input type="email" name="email" id="email"
                                                    class="form-control me-2  mt-2 text-white w-100  rounded"
                                                    style="border: 1px solid rgb(92, 92, 92); background-color: rgb(92, 92, 92);"
                                                    placeholder="Enter New Email">
                                            </div>
                                        </div>
                                        <div class="modal-footer bg-dark" style="border-top: 1px solid grey">
                                            <button type="button" class="btn btn-danger"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-secondary text-dark">Save
                                                Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{-- email end  --}}

                        {{-- bio start  --}}
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-dark my-2" data-bs-toggle="modal"
                            data-bs-target="#bio">
                            <div class=" text-start ">
                                Bio - <span class=" fs-5 fw-bold">{{ Auth::user()->bio }}</span>
                                <small class=" text-white-50 d-block text-end">Add a few words about yourself</small>
                            </div>
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="bio" data-bs-backdrop="static" data-bs-keyboard="false"
                            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-secondary" style="border-bottom: 1px solid black">
                                        <h1 class="modal-title fs-5 " id="staticBackdropLabel">Bio</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('profile#accountBio') }}" method="POST">
                                        @csrf
                                        <div class="modal-body bg-dark">
                                            <div class=" py-3">
                                                <input type="text" name="bio" id="bio"
                                                    class="form-control me-2  mt-2 text-white w-100  rounded"
                                                    style="border: 1px solid rgb(92, 92, 92); background-color: rgb(92, 92, 92);"
                                                    placeholder="Bio">
                                            </div>
                                        </div>
                                        <div class="modal-footer bg-dark" style="border-top: 1px solid grey">
                                            <button type="button" class="btn btn-danger"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-secondary text-dark">Save
                                                Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{-- bio end  --}}
                    </div>
                </div>
            </div>
            <div class=" col-3 mt-5 pt-5">
                <div class="row justify-content-center text-center text-white-50">
                    <div class="col-md-7">
                        <p class="copyright">&copy; Copyright Team. All Rights Reserved</p>
                        <div class="credits">
                            Designed by <em>SnapView</em>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
    integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
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

        var $modal = $('#image');
        var image = document.getElementById('cropImage');
        var cropper;

        $("body").on("change", ".cropImage", function(e) {
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
                        url: "/account/image/update",
                        data: {
                            '_token': $('#_token').val(),
                            'id': $('#id').val(),
                            'image': base64data
                        },
                        success: function(data) {
                            $modal.modal('hide');
                            location.reload();
                        }
                    });
                }
            });
        });

        if ($('#exceedMember').html()) {
            $('.modalNewGroup').modal("show");
        }
    })
</script>

</html>
