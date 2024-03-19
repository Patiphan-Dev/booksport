@php
    $current_route = request()
        ->route()
        ->getName();
@endphp
<style>
    .navbar-collapse {
        text-align: center;
    }
</style>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark py-3 position-sticky d-block d-md-none">
    {{-- fixed-top --}}
    <div class="container">
        <a class="navbar-brand" href="{{ URL('/') }}">
            <img src="{{ asset('assets/images/logo.png') }}" alt="" style="width:10vw">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                        class="nav-link text-white fw-bold py-1 {{ $current_route == 'dashboard' ? 'active' : '' }}"
                        aria-current="page">
                        <i class="fa-solid fa-gauge"></i>
                        แดชบอร์ด
                    </a>
                </li>
                <li>
                    <a href="{{ route('user') }}" class="nav-link text-white {{ $current_route == 'user' ? 'active' : '' }}">
                        <i class="fa-solid fa-users"></i>
                        ผู้ใช้งาน
                    </a>
                </li>
                <li>
                    <a href="{{ route('stadium') }}"
                        class="nav-link text-white fw-bold py-1 {{ $current_route == 'stadium' ? 'active' : '' }}">
                        <i class="fa-solid fa-medal"></i>
                        สนามกีฬา
                    </a>
                </li>
                <li>
                    <a href="{{ route('reserve') }}"
                        class="nav-link text-white fw-bold py-1 {{ $current_route == 'reserve' ? 'active' : '' }}">
                        <i class="fa-solid fa-bookmark"></i>
                        รายงานการจอง
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a href="#" class="align-items-center text-white text-decoration-none dropdown-toggle"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://github.com/mdo.png" alt="" width="32" height="32"
                            class="rounded-circle me-2">
                        <strong>{{ Auth::user()->username }}</strong>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                        <li><a class="dropdown-item" href="{{ route('logout') }}">ออกจากระบบ <i
                                    class="fa-solid fa-right-from-bracket"></i></a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
