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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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
        margin: 5% 35% 0% 35%;
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
    .modal-custom-width {
        max-width: 90% !important;
    }
    .modal-custom-width-lx {
        max-width: 100% !important;
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
            @if($user->hasRole('pegawai') || $user->hasRole('atasan'))
                <li class="nav-item">
                    <a class="nav-link dropdown-toggle bi bi-menu-button-wide {{ Request::routeIs('rencana_skp', 'intervensi_skp') ? '' : 'collapsed' }}" 
                       data-bs-toggle="collapse" 
                       href="#submenu2" 
                       role="button" 
                       aria-expanded="{{ Request::routeIs('rencana_skp', 'intervensi_skp') ? 'true' : 'false' }}" 
                       aria-controls="submenu2">
                       SKP Tahunan
                    </a>
                    <div class="collapse {{ Request::routeIs('rencana_skp', 'periodeSkp', 'intervensi_skp', 'periodeIntervensi', 'evaluasi_skp','periodeEvaluasi') ? 'show' : '' }}" id="submenu2">
                        <ul class="nav flex-column ms-3">
                            <li class="nav-item mb-2">
                                <a class="nav-link {{ Request::routeIs('rencana_skp') ? 'active' : '' }}" href="{{ route('rencana_skp') }}">Rencana SKP</a>
                            </li>
                            <li class="nav-item mb-2">
                                <a class="nav-link {{ Request::routeIs('intervensi_skp') ? 'active' : '' }}" href="{{ route('intervensi_skp') }}">Matriks Peran Hasil</a>
                            </li>
                            <li class="nav-item mb-2">
                                <a class="nav-link {{ Request::routeIs('evaluasi_skp') ? 'active' : '' }}" href="{{ route('evaluasi_skp') }}">
                                Evaluasi SKP</a>
                            </li>
                            <li class="nav-item mb-2">
                                <a class="nav-link" href="#">Arsip SKP</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link dropdown-toggle bi bi-menu-button-wide collapsed" 
                       data-bs-toggle="collapse" 
                       href="#submenu3" 
                       role="button" 
                       aria-expanded="false" 
                       aria-controls="submenu3">
                       Log Harian
                    </a>
                    <div class="collapse {{ Request::routeIs('kalender') ? 'show' : '' }}" id="submenu3">
                        <ul class="nav flex-column ms-3">
                            <li class="nav-item mb-2">
                                <a class="nav-link {{ Request::routeIs('kalender') ? 'active' : '' }}" href="{{ route('kalender') }}">Kalender</a>
                            </li>
                            <li class="nav-item mb-2">
                                <a class="nav-link" href="#">Rekap & Capaian</a>
                            </li>
                        </ul>
                    </div>
                </li>
            @elseif($user->hasRole('admin'))
                <li class="nav-item">
                    <a class="nav-link dropdown-toggle bi bi-menu-button-wide {{ Request::routeIs('skp_periode') ? '' : 'collapsed' }}" 
                       data-bs-toggle="collapse" 
                       href="#submenu1" 
                       role="button" 
                       aria-expanded="{{ Request::routeIs('skp_periode') ? 'true' : 'false' }}" 
                       aria-controls="submenu1">
                       SKP
                    </a>
                    <div class="collapse {{ Request::routeIs('skp_periode') ? 'show' : '' }}" id="submenu1">
                        <ul class="nav flex-column ms-3">
                            <li class="nav-item mb-2">
                                <a class="nav-link {{ Request::routeIs('skp_periode') ? 'active' : '' }}" href="{{ route('skp_periode') }}">SKP Periode</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link dropdown-toggle bi bi-people {{ Request::routeIs('data_pegawai') ? '' : 'collapsed' }}" 
                       data-bs-toggle="collapse" 
                       href="#submenu2" 
                       role="button" 
                       aria-expanded="{{ Request::routeIs('data_pegawai') ? 'true' : 'false' }}" 
                       aria-controls="submenu2">
                       Pegawai
                    </a>
                    <div class="collapse {{ Request::routeIs('data_pegawai') ? 'show' : '' }}" id="submenu2">
                        <ul class="nav flex-column ms-3">
                            <li class="nav-item mb-2">
                                <a class="nav-link {{ Request::routeIs('data_pegawai') ? 'active' : '' }}" href="{{ route('data_pegawai') }}">Data Pegawai</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link dropdown-toggle bi-person-gear {{ Request::routeIs('data_user') ? '' : 'collapsed' }}" 
                       data-bs-toggle="collapse" 
                       href="#submenu3" 
                       role="button" 
                       aria-expanded="{{ Request::routeIs('data_user') ? 'true' : 'false' }}" 
                       aria-controls="submenu3">
                       Users
                    </a>
                    <div class="collapse {{ Request::routeIs('data_user') ? 'show' : '' }}" id="submenu3">
                        <ul class="nav flex-column ms-3">
                            <li class="nav-item mb-2">
                                <a class="nav-link {{ Request::routeIs('data_user') ? 'active' : '' }}" href="{{ route('data_user') }}">Managemen User</a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif
        </ul>
    </div>
</div>

<div class="content" id="content">
    <div class='content-detail'>
        <script src="{{ asset('assets/js/jquery-3.7.1.slim.min.js') }}"></script>
        <script src="https://cdn.datatables.net/v/dt/dt-2.1.8/datatables.min.js"></script>
        @yield('content')
        <script>
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses',
                    text: '{{ session('success') }}',
                });
            @endif

            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: '{{ session('error') }}',
                });
            @endif
        </script>
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
