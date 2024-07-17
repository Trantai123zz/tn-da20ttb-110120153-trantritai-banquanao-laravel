<link rel="stylesheet" href="{{ asset('css/navi.css') }}">

<div class="navigation">
    <ul class="left-menu">
        <li><a href="/">Trang Chủ</a></li>
        <li><a href="/about">Giới thiệu</a></li>
        <li><a href="/contact">Liên Hệ</a></li>
    </ul>
    <ul class="right-menu">
        <form action="{{ route('search') }}" method="GET" class="search-form">
            <input type="text" name="query" placeholder="Tìm kiếm sản phẩm..." required>
            <button type="submit"><i class="fas fa-search"></i></button>
        </form>
        <li class="nav-icon">
            <a href="/cart"><img src="{{ asset('images/giohang1.png') }}" alt="Cart" class="icon" /></a>
        </li>
        @if(Auth::check())
            <li class="nav-icon user-profile">
                <a href="{{ route('profile.show') }}" class="user-link">
                    <img src="{{ asset('images/icon-user.jpg') }}" alt="Account" class="icon"/>
                    <div class="user-info">
                        <span>{{ Auth::user()->name }}</span>
                    </div>
                </a>
            </li>
        @else
            <li class="nav-icon">
                <a href="/login"><img src="{{ asset('images/icon-user.jpg') }}" alt="Account" class="icon"/></a>
            </li>
        @endif
    </ul>
</div>
