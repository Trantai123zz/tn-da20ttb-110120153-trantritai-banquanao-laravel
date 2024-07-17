@extends('layout.cart')
<link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
@section('title', 'Thanh toán đơn hàng')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <!-- Column for customer information -->
        <div class="col-md-6">
            <div class="checkout-section">
                <h2>Thông tin đặt hàng</h2>
                <div class="checkout-form">
                    <h3>Thông tin người mua</h3>
                    <p><strong>Tên:</strong> {{ $user->name }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <p><strong>Số điện thoại:</strong> {{ $user->phone_number }}</p>
                    @if($address)
                        <p><strong>Địa chỉ:</strong> {{ $address->apartment_number }}, {{ $address->ward }}, {{ $address->district }}, {{ $address->province }}</p>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Column for cart summary -->
        <div class="col-md-6">
            <div class="cart-summary">
                <h2>Thông tin giỏ hàng</h2>
                <ul class="list-group">
                    @foreach($cart as $item)
                    <li class="list-group-item">
                        <strong>{{ $item['name'] }}</strong>
                        <span class="badge badge-primary badge-pill">{{ $item['quantity'] }}</span>
                        <span class="badge badge-primary badge-pill">{{ $item['size'] }}</span>
                        <span class="badge badge-success">{{ number_format($item['price']) }} VNĐ</span>
                    </li>
                    @endforeach
                    <li class="list-group-item">
                        <span><strong>Phí vận chuyển:</strong> {{ $transportFee }}</span>
                    </li>
                    <li class="list-group-item">
                        <span><strong>Tổng cộng:</strong> {{ number_format($totalMoney ) }} VNĐ</span>
                    </li>
                </ul>
                <form action="{{ route('checkout.placeOrder') }}" method="POST" class="checkout-form">
                    @csrf
                    <input type="hidden" name="transport_fee" value="{{ $transportFee }}">
                    <input type="hidden" name="total_money" value="{{ $totalMoney }}">
                    <div class="form-group">
                        <label for="note">Ghi chú:</label>
                        <textarea name="note" id="note" class="form-control" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Đặt hàng</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
