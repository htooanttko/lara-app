<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('image/icons8-leaf-48.png') }}">

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
    <link rel="stylesheet" href="{{ asset('css/light_dark.css') }}">
    <title>Document</title>
</head>

<body class="lightTextClass opacity-75 d-flex justify-content-center align-items-center" style="height: 100vh">
    <div class="p-5" style="width: 400px">
       @if (session('notMatch'))
        <div class="alert alert-warning alert-dismissible fade show d-flex" role="alert">
            <p>
                {{ session('notMatch') }}
            </p>
            <button type="button" class="btn close" data-bs-dismiss="alert" aria-label="Close">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
       @endif
    <div class="mb-2">
        <div class=" mb-2" style="width:25px">
            <img class="w-100" src="{{ asset('image/icons8-leaf-48.png') }}" alt="">
        </div>
        <p class="mb-2 fw-bold">Reset Your Password</p>
        <p>Enter your old password and your new password <br> below to reset your password</p>
    </div>

<form action="{{ route('profile#accountPasswordChange') }}" method="post" class="">
    @csrf
    <div class=" my-2">
        <label for="oldPassword" class=" mb-2 fw-bold">Old Password</label>
        <div class="input-group">
            <input type="password" name="oldPassword" id="oldPassword" class="form-control bg-light @error('oldPassword') is-invalid @enderror" placeholder="Enter old password" value="{{ old('oldPassword') }}">
            <div class="input-group-text bg-light">
                <i class="fa-regular fa-eye" id="oldToggleIconShow" style="display: none"></i>
                <i class="fa-regular fa-eye-slash" id="oldToggleIconHide"></i>
            </div>
            @error('oldPassword')
                <small class="invalid-feedback">
                    {{ $message }}
                </small>
            @enderror
        </div>
    </div>

    <div class=" my-2">
        <label for="newPassword" class=" mb-2 fw-bold">New Password</label>
        <div class="input-group">
            <input type="password" name="newPassword" id="newPassword" class=" form-control bg-light @error('newPassword') is-invalid @enderror" placeholder="Enter new password" value="{{ old('newPassword') }}">
            <div class="input-group-text bg-light">
                <i class="fa-regular fa-eye" id="newToggleIconShow" style="display: none"></i>
                <i class="fa-regular fa-eye-slash" id="newToggleIconHide"></i>
            </div>
            @error('newPassword')
            <small class="invalid-feedback">
                {{ $message }}
            </small>
            @enderror
        </div>
    </div>

    <div class=" my-2">
        <label for="confirmNewPassword" class=" mb-2 fw-bold">Confirm New Password</label>
        <div class="input-group">
            <input type="password" name="confirmNewPassword" id="confirmNewPassword" class=" form-control bg-light @error('confirmNewPassword') is-invalid @enderror"  placeholder="Enter new password again" value="{{ old('confirmNewPassword') }}">
            <div class="input-group-text bg-light">
                <i class="fa-regular fa-eye" id="confirmNewPasswordToggleIconShow" style="display: none"></i>
                <i class="fa-regular fa-eye-slash" id="confirmNewPasswordToggleIconHide"></i>
            </div>
            @error('confirmNewPassword')
            <small class="invalid-feedback">
                {{ $message }}
            </small>
            @enderror
        </div>
    </div>

    <div class="mt-3 col">
        <button type="submit" class=" w-100 btn btn-primary opacity-75 fw-bold">Reset Password</button>
    </div>
</form>

  </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
    integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('js/light_dark.js') }}"></script>

<script>
$(document).ready(function() {
    const oldPassword = $('#oldPassword');
    const oldToggleIconShow = $('#oldToggleIconShow');
    const oldToggleIconHide = $('#oldToggleIconHide');
    const newPassword = $('#newPassword');
    const newToggleIconShow = $('#newToggleIconShow');
    const newToggleIconHide = $('#newToggleIconHide');
    const confirmNewPassword = $('#confirmNewPassword');
    const confirmNewPasswordToggleIconShow = $('#confirmNewPasswordToggleIconShow');
    const confirmNewPasswordToggleIconHide = $('#confirmNewPasswordToggleIconHide');

    oldToggleIconHide.click(function() {
            oldPassword.attr('type', 'text');
            oldToggleIconHide.css('display','none')
            oldToggleIconShow.css('display','block')
    });
    oldToggleIconShow.click(function() {
            oldPassword.attr('type', 'password');
            oldToggleIconShow.css('display','none')
            oldToggleIconHide.css('display','block')
    });

    newToggleIconHide.click(function() {
            newPassword.attr('type', 'text');
            newToggleIconHide.css('display','none')
            newToggleIconShow.css('display','block')
    });
    newToggleIconShow.click(function() {
            newPassword.attr('type', 'password');
            newToggleIconShow.css('display','none')
            newToggleIconHide.css('display','block')
    });

    confirmNewPasswordToggleIconHide.click(function() {
            confirmNewPassword.attr('type', 'text');
            confirmNewPasswordToggleIconHide.css('display','none')
            confirmNewPasswordToggleIconShow.css('display','block')
    });
    confirmNewPasswordToggleIconShow.click(function() {
            confirmNewPassword.attr('type', 'password');
            confirmNewPasswordToggleIconShow.css('display','none')
            confirmNewPasswordToggleIconHide.css('display','block')
    });


});
</script>
</html>
