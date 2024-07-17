<div class="swiper-slide">
        <img class="banner-image" src="{{ asset('images/banner8.jpg') }}" alt="Banner 3">
</div>
@extends('layout.cart')

@section('title', 'Quên mật khẩu')

@section('content')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
<h2>Quên mật khẩu</h2>
<div class="container">
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="form-group">
            <label for="email">Email</label>
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
        </div>
        
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Gửi liên kết đặt lại mật khẩu</button>
        </div>
    </form>
</div>
@endsection
