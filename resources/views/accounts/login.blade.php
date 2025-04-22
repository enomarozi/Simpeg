<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
	<link rel="icon" href="{{ asset('assets/images/unand-sm.png') }}" type="image/x-icon">
	<title>Login</title>
</head>
<style type="text/css">
    body {
        background-image: url("{{ asset('assets/images/rektorat.jpg') }}");
        background-size: cover; 
        background-position: center center;
        background-attachment: fixed; 
        height: 100vh;
        justify-content: center;
        align-items: center;
        margin: 0;
    }
	form{
		margin-top: 20px;
        background: transparent;
	}
    .status_message{
        width: 25%;
        margin-left: 37.5%;
        margin-right: 37.5%;
    }
</style>
<body>
<div class="container d-flex justify-content-center align-items-center flex-column" style="height: 80vh;">
    <div class="card col-md-3 p-3 shadow">
        <img src="{{ asset('assets/images/unand.png')}}"> 
        <form action="{{ route('loginAction') }}" method="POST">
            @csrf
            <div class="mb-3">
                <input type="text" name="username" class="form-control" placeholder="Username" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <div class="d-flex justify-content-between mb-3 small">
                <div>
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember">Keep Me Logged In</label>
                </div>
            </div>
            <button type="submit" class="btn btn-success w-100">Login</button>
        </form>
    </div>
    <div class="w-100 mt-5">
        @if ($errors->has('error'))
            <div class="card p-3 text-danger small text-center status_message">
                {{ $errors->first('error') }}
            </div>
        @elseif (session('success'))
            <div class="card p-3 text-success small text-center">
                {{ session('success') }}
            </div>
        @else
            <div class="card p-3 text-danger small text-center invisible">
                Placeholder for error or success message
            </div>
        @endif
    </div>
</div>
</body>
</html>