<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login SIMPEG - Sistem Informasi Pegawai</title>
  <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
  <link rel="icon" href="{{ asset('assets/images/unand-sm.png') }}" type="image/x-icon" />
  <style>
    body {
      background: url("{{ asset('assets/images/rektorat.jpg') }}") no-repeat center center fixed;
      background-size: cover;
      height: 100vh;
    }
  </style>
</head>
<body class="d-flex justify-content-center align-items-center">
    <main class="bg-white bg-opacity-75 rounded-4 shadow p-4" style="max-width: 390px; width: 100%;">
        <div class="text-center mb-4">
            <img src="{{ asset('assets/images/unand.png') }}" alt="Logo Unand" class="mb-3" style="max-width: 120px;" />
            <h5 class="fw-bold text-success lh-base">
            SIMPEG - Sistem Informasi Pegawai
            </h5> 
        </div>
        <form action="{{ route('loginAction') }}" method="POST" autocomplete="off" novalidate>
        @csrf
            <div class="mb-3">
                <input
                  type="text"
                  name="username"
                  class="form-control form-control-lg"
                  placeholder="Username"
                  value="administrator"
                  required
                  autofocus
                  autocomplete="username"
                />
            </div>
            <div class="mb-3">
                <input
                  type="password"
                  name="password"
                  class="form-control form-control-lg"
                  placeholder="Password"
                  value="12345678"
                  required
                  autocomplete="current-password"
                />
            </div>
            <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" id="remember" name="remember" />
                <label class="form-check-label" for="remember">Keep Me Logged In</label>
            </div>
            <button type="submit" class="btn btn-success btn-lg w-100">Login</button>
        </form>
        <div class="mt-3">
            @if ($errors->has('error'))
                <div class="alert alert-danger text-center mb-0 small">
                    {{ $errors->first('error') }}
                </div>
            @elseif (session('success'))
                <div class="alert alert-success text-center mb-0 small">
                    {{ session('success') }}
                </div>
            @else
                <div class="invisible">placeholder</div>
            @endif
        </div>
    </main>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
