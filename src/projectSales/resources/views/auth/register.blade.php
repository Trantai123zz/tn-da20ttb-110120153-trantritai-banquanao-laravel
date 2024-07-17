<div class="swiper-slide">
        <img class="banner-image" src="{{ asset('images/banner8.jpg') }}" alt="Banner 3">
</div>
@extends('layout.cart')

@section('title', 'Đăng ký')

@section('content')
<link rel="stylesheet" href="{{ asset('css/regis_form.css') }}">

<div class="register-container">
    <h1>Đăng ký</h1>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-column">
            <div>
                <label for="name">Họ và tên</label>
                <input type="text" id="name" name="name" required autofocus>
            </div>
            <div>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div>
                <label for="password">Mật khẩu</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div>
                <label for="password_confirmation">Nhập lại mật khẩu</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>
        </div>
        <div class="form-column">
            <div>
                <label for="phone_number">Số điện thoại</label>
                <input type="text" id="phone_number" name="phone_number" required>
            </div>
            <div>
                <label for="province">Tỉnh/thành phố</label>
                <input type="text" id="province" name="province" required>
            </div>
            <div>
                <label for="district">Quận/huyện</label>
                <input type="text" id="district" name="district" required>
            </div>
            <div>
                <label for="ward">Phường/xã</label>
                <input type="text" id="ward" name="ward" required>
            </div>
            <div>
                <label for="apartment_number">Số nhà</label>
                <input type="text" id="apartment_number" name="apartment_number" required>
            </div>
        </div>
        <button type="submit">Đăng ký</button>
        @if ($errors->any())
            <div class="error-messages">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </form>
</div>
@endsection
