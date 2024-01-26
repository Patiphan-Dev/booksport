@php
    $current_route = request()
        ->route()
        ->getName();
@endphp

<div class="bg-dark">
    <footer class="container py-3 mt-3">
        <ul class="nav justify-content-center border-bottom pb-3 mb-3">
            <li class="nav-item">
                <a class="nav-link fw-bold py-1 text-white {{ $current_route == 'home' ? 'active' : '' }}" aria-current="page"
                    href="{{ route('home') }}">หน้าแรก</a>
            </li>
            <li class="nav-item">
                <a class="nav-link fw-bold py-1 text-white {{ $current_route == 'about' ? 'active' : '' }}"
                    href="{{ route('about') }}">เกี่ยวกับเรา</a>
            </li>
            <li class="nav-item">
                <a class="nav-link fw-bold py-1 text-white {{ $current_route == 'getStadium' ? 'active' : '' }}"
                    href="{{ route('getStadium', ['id' => 1]) }}">สนามกีฬา</a>
            </li>
            <li class="nav-item">
                <a class="nav-link fw-bold py-1 text-white {{ $current_route == 'bookingAll' ? 'active' : '' }}"
                    href="{{ route('bookingAll') }}">จองสนาม</a>
            </li>
        </ul>
        <p class="text-center text-white">© 2023 Company, Inc</p>
    </footer>
</div>
