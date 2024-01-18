@php
    $current_route = request()
        ->route()
        ->getName();
@endphp
<div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="width: 280px;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <span class="fs-4">ระบบจองสนามกีฬา</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="{{ route('dashboard') }}"
                class="nav-link text-white {{ $current_route == 'dashboard' ? 'active' : '' }}" aria-current="page">
                <i class="fa-solid fa-gauge"></i>
                แดชบอร์ด
            </a>
        </li>
        <li>
            <a href="{{ route('stadium') }}"
                class="nav-link text-white {{ $current_route == 'stadium' ? 'active' : '' }}">
                <i class="fa-solid fa-medal"></i>
                สนามกีฬา
            </a>
        </li>
        <li>
            <a href="{{ route('reserve') }}"
                class="nav-link text-white {{ $current_route == 'reserve' ? 'active' : '' }}">
                <i class="fa-solid fa-bookmark"></i>
                การจอง
            </a>
        </li>
        <li>
            <a href="{{ route('payment') }}"
                class="nav-link text-white {{ $current_route == 'payment' ? 'active' : '' }}">
                <i class="fa-solid fa-hand-holding-dollar"></i>
                การชำระเงิน
            </a>
        </li>
        <li>
            <a href="{{ route('rule') }}" class="nav-link text-white {{ $current_route == 'rule' ? 'active' : '' }}">
                <i class="fa-solid fa-scale-balanced"></i>
                กฎกติกา
            </a>
        </li>
    </ul>
    <hr>
    <ul class="navbar-nav ms-auto">
        <li class="nav-item dropdown">
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
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
