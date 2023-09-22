<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <title>Sign Up</title>
</head>

<body style="background-color: rgb(126, 126, 126)">
    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
    @endif
    <div class="col-3 p-5 bg-secondary text-white rounded-3 m-auto mt-5 shadow-lg">
        <h1 style="border-bottom:1px solid white; " class=" pb-2 mb-3">Sign Up</h1>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mt-3">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class=" form-control" :value="old('name')"
                    placeholder="Enter Name" required>
            </div>

            <div class="mt-3">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class=" form-control" :value="old('email')"
                    placeholder="Enter Email" required>
            </div>

            <div class="mt-3">
                <label for="phone">Phone</label>
                <input type="number" name="phone" id="phone" class=" form-control" :value="old('phone')"
                    placeholder="Enter Phone Number" required>
            </div>

            <div class="mt-2">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class=" form-control" :value="old('password')"
                    placeholder="Enter Password" required>
            </div>

            <div class="mt-2">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class=" form-control"
                    :value="old('password_confirmation')" placeholder="Enter Confirm Password" required>
            </div>

            <div class="row">
                <button type="submit" class="btn btn-dark mt-4">Sign Up</button>
                <a href="{{ route('user#loginPage') }}" class="text-muted text-decoration-none pt-2">already have an Account</a>
            </div>
        </form>
    </div>
</body>

</html>


