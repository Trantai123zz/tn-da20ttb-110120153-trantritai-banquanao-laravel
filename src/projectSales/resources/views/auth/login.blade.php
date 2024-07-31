<div class="swiper-slide">
        <img class="banner-image" src="{{ asset('images/banner4.jpg') }}" alt="Banner 3">
</div>
@extends('layout.cart')

@section('title', 'Đăng nhập')

@section('content')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">

<div class="container">
    <form method="POST" action="{{ route('login') }}">
    <h2>Đăng nhập</h2>
        @csrf
        <div class="form-group">
            <label for="email">Email</label>
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
        </div>
        
        <div class="form-group">
            <label for="password">Mật khẩu</label>
            <input id="password" type="password" class="form-control" name="password" required>
        </div>
        
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Đăng nhập</button>
            <a href="{{ route('auth.google') }}" class="btn btn-primary">
    Đăng nhập với Google
</a>
        </div>
        <div class="register-link">
        <p>Bạn chưa có tài khoản? <a href="{{ route('register') }}">Đăng ký ngay</a></p>
        <p><a href="{{ route('password.request') }}">Quên mật khẩu?</a></p>
        </div>
        <div>
        @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        </div>
    </form>
</div>

@endsection
