<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>เว็บไซต์จองสนามกีฬา {{ isset($title) ? '| ' . $title : '' }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <!-- Ionicons -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/Icons.png') }}">
    <!-- Tempusdominus Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- sweetalert2 -->
    <link href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>

</head>

<body>

    <main class="d-flex flex-nowrap" style="height: 100vh">
        <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="width: 280px;">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <span class="fs-4">ระบบจองสนามกีฬา</span>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="{{route('dashboard')}}" class="nav-link active" aria-current="page">
                        <i class="fa-solid fa-gauge"></i>
                        แดชบอร์ด
                    </a>
                </li>
                <li>
                    <a href="{{route('stadium')}}" class="nav-link text-white">
                        <i class="fa-solid fa-medal"></i>
                        สนามกีฬา
                    </a>
                </li>
                <li>
                    <a href="{{route('reserve')}}" class="nav-link text-white">
                        <i class="fa-solid fa-bookmark"></i>
                        การจอง
                    </a>
                </li>
                <li>
                    <a href="{{route('payment')}}" class="nav-link text-white">
                        <i class="fa-solid fa-hand-holding-dollar"></i>
                        การชำระเงิน
                    </a>
                </li>
                <li>
                    <a href="{{route('rule')}}" class="nav-link text-white">
                        <i class="fa-solid fa-scale-balanced"></i>
                        กฎกติกา
                    </a>
                </li>
            </ul>
            <hr>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <div class="dropdown">
                        <a href="#"
                            class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://github.com/mdo.png" alt="" width="32" height="32"
                                class="rounded-circle me-2">
                            <strong>{{ Auth::user()->username }}</strong>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                            <li><a class="dropdown-item" href="{{ route('logout') }}">ออกจากระบบ <i
                                        class="fa-solid fa-right-from-bracket"></i></a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
        <div class="container">
            <section class="content">
                @include('sweetalert::alert')
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0"> {{ isset($title) ? '| ' . $title : '' }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    @yield('body')
                </div>
            </section>
        </div>

    </main>




    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <!-- sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>


</body>

</html>
