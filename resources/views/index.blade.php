<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{ $title }}</title>
	<link rel="icon" type="image/x-icon" href="{{ asset('assets/images/unand-sm.png') }}">
	<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" crossorigin="anonymous">
	<link href="{{ asset('assets/css/app.css') }}" rel="stylesheet" crossorigin="anonymous">
	<!-- Link -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
	<link href="https://cdn.datatables.net/v/dt/dt-2.1.8/datatables.min.css" rel="stylesheet">
</head>
<style>
    .modal {
        display: none;
        position: fixed;
        z-index: 1100;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%; 
        overflow: auto;
        background-color: rgb(0,0,0);
        background-color: rgba(0,0,0,0.4);
    }
    .modal-content {
        background-color: #fefefe;
        width: 30%;
        margin: 15% 35% 35%;
        padding: 15px;
        border: 1px solid #888;
    }
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }
    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
    .topbar{
        background-color: white;
        border-bottom: 1px solid #d8dde8;
    }
    .sidebar{
        background-color: white;
        border-right: 1px solid #d8dde8;
    }
    .card-title{
        background-color: #ecf2fe;
    }
    .nav-link{
        color: black;
        background-color: white;
        border-radius:  5px;
        font-family: 'Montserrat', sans-serif;
    }
    .content{
        background-color: #ecf2fe;
        min-height: 85vh;
    }
    .content-detail{
        background-color: #ecf2fe;
        padding: 1%;
        margin: 5px;
        border-radius: 5px;
    }
    .btn-account {
        display: flex;
        align-items: center; 
        justify-content: center; 
    }
</style>
<body>

<nav class="navbar topbar">
    <div class="btn-close-sidebar">        
        <div class="d-flex" style="height: 70px;">
            <div class="vr"></div>
        </div>
        <button class="btn btn-custom" id="sidebarMinimize" aria-label="Minimize sidebar">
            <img src="{{ asset('assets/images/menu.png') }}" alt="Toggle">
        </button>
    </div>

        <div class="dropdown">
            <button class="btn btn-account" type="button" id="dropdownAccount" data-bs-toggle="dropdown" aria-expanded="false">
                {{ Auth::user()->name }} <i class="bi bi-person-circle dark-icon" style="font-size: 2rem;"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownAccount">
                <li><a class="dropdown-item" href="{{ route('profile') }}">Profile</a></li>
                <li><a class="dropdown-item" href="{{ route('setting') }}">Setting</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="sidebar" id="sidebar">
    <div class="sidebar-body">
        <img class="logo" id="sidebarLogo" src="{{ asset('assets/images/unand-f.png') }}" alt="Logo">
        
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link bi bi-house-door" href="{{ route('index') }}">
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link dropdown-toggle bi bi-people" data-bs-toggle="collapse" href="#submenu1" role="button" aria-expanded="false" aria-controls="submenu1"> Pegawai
                </a>
                <div class="collapse" id="submenu1">
                    <ul class="nav flex-column ms-3">
                        <li class="nav-item mb-2">
                            <a class="nav-link" href="{{ route('data_pegawai') }}">Data Pegawai</a>
                        </li>
                        <li class="nav-item mb-2">
                            <a class="nav-link" href="{{ route('kelola_pegawai') }}">Kelola Pegawai</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link dropdown-toggle bi bi-menu-button-wide" data-bs-toggle="collapse" href="#submenu2" role="button" aria-expanded="false" aria-controls="submenu2"> SKP
                </a>
                <div class="collapse" id="submenu2">
                    <ul class="nav flex-column ms-3">
                        <li class="nav-item mb-2">
                            <a class="nav-link" href="#">Target SKP</a>
                        </li>
                        <li class="nav-item mb-2">
                            <a class="nav-link" href="#">Realisasi SKP</a>
                        </li>
                        <li class="nav-item mb-2">
                            <a class="nav-link" href="#">Penilaian Kinerja</a>
                        </li>
                        <li class="nav-item mb-2">
                            <a class="nav-link" href="#">Riwayat SKP</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>

<div class="content" id="content">
    <div class='content-detail'>
        <script src="{{ asset('assets/js/jquery-3.7.1.slim.min.js') }}"></script>
        <script src="https://cdn.datatables.net/v/dt/dt-2.1.8/datatables.min.js"></script>
        @yield('content')
        @if ($errors->any())
            <div class="text-danger small mt-2 text-center w-100">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @elseif(session('success'))
            <div class="text-success small mt-2 text-center w-100">
                {{ session('success') }}
            </div>
        @endif
    </div>
</div>
<script>
    document.getElementById("sidebarMinimize").addEventListener("click", function(){
        document.getElementById("sidebar").classList.toggle("collapsed");
        document.getElementById("content").classList.toggle("collapsed");
        const logo = document.getElementById("sidebarLogo");

        var navLinks = document.querySelectorAll('.nav-link');
        var subTitle = document.querySelectorAll('.text-dark');

        if (!document.getElementById("sidebar").classList.contains("collapsed")) {
            navLinks.forEach(function(link) {
                if (link.dataset.text) {
                    link.textContent = link.dataset.text;
                }
            });
            subTitle.forEach(function(link) {
                if(link.dataset.text){
                    link.textContent = link.dataset.text;
                }
            });
            logo.src = "{{ asset('assets/images/unand-f.png') }}";
        } else {
            navLinks.forEach(function(link) {
                link.dataset.text = link.textContent;
                link.textContent = '';
            });
            subTitle.forEach(function(link) {
                link.dataset.text = link.textContent;
                link.textContent = '';
            });
            logo.src = "{{ asset('assets/images/unand-small.png') }}";
        }
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
