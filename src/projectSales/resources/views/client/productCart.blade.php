<div class="swiper-slide">
        <img class="banner-image" src="{{ asset('images/banner8.jpg') }}" alt="Banner 3">
</div>
<link rel="stylesheet" href="{{ asset('css/cart.css') }}"><!-- resources/views/cart/index.blade.php -->
@extends('layout.cart')

@section('title', 'Giỏ hàng')

@section('content')
    <div class="main-content">
        <h1>Giỏ hàng của bạn</h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (empty($cart))
            <p>Giỏ hàng của bạn trống.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Hình ảnh</th>
                        <th>Size</th>
                        <th>Màu sắc</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cart as $id => $details)
                        <tr>
                            <td>{{ $details['name'] }}</td>
                            <td><img src="{{ asset('images/' . $details['photo']) }}" alt="{{ $details['name'] }}"
                                    width="50" height="50"></td>
                            <td>{{ $details['size'] }}</td>
                            <td>{{ $details['color'] }}</td>
                            <td>{{ $details['quantity'] }}</td>
                            <td>{{ number_format($details['price'] * $details['quantity']) }} VNĐ</td>
                            <td>
                                <form action="{{ route('cart.remove', $id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="total">
                <h3>Tổng tiền:
                    {{ number_format(array_sum(array_map(fn($details) => $details['price'] * $details['quantity'], $cart))) }}
                    VNĐ</h3>
            </div>
        @endif
        <div class="button-container">
        <a href="{{ route('product.checkout') }}" class="btn btn-primary">Thanh Toán</a>
    </div>
</div>
   

@endsection
