@php
    $current_route = request()
        ->route()
        ->getName();
@endphp
<nav class="navbar navbar-expand-lg navbar-dark bg-dark py-3 position-sticky fixed-top">{{-- fixed-top --}}
    <div class="container">
        <a class="navbar-brand" href="{{ URL('/') }}">Your Logo</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ $current_route == 'home' ? 'active' : '' }}" aria-current="page"
                        href="{{ route('home') }}">หน้าแรก</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $current_route == 'about' ? 'active' : '' }}"
                        href="{{ route('about') }}">เกี่ยวกับเรา</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $current_route == 'stadium' ? 'active' : '' }}"
                        href="{{ route('getStadium',['id'=>1]) }}">สนามกีฬา</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $current_route == 'stadium' ? 'active' : '' }}"
                        href="{{ route('bookingAll') }}">จองสนาม</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                @guest
                    <li class="nav-item">
                        <a class="btn btn-sm btn-outline-secondary nav-link {{ request()->is('login') ? 'active' : '' }}"
                            href="{{ route('getLogin') }}">เข้าสู่ระบบ</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-sm btn-outline-secondary nav-link {{ request()->is('register') ? 'active' : '' }}"
                            href="{{ route('getRegister') }}">สมัครสมาชิก</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            {{ Auth::user()->username }}
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}">Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
