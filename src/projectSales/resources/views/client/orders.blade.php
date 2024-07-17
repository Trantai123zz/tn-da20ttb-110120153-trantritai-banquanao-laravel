<!-- resources/views/checkout/index.blade.php -->
@extends('layout.app')

@section('content')
    <div class="container">
        <h2>Đặt hàng</h2>

        @if (count($cart) > 0)
            <table class="table">
                <!-- Your cart items table -->
            </table>

            <!-- Form đặt hàng -->
            <form action="{{ route('checkout.processPayment') }}" method="post">
                @csrf

                <!-- Các trường thông tin người dùng cần điền -->
                <div class="form-group">
                    <label for="name">Họ và tên</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="phone">Điện thoại</label>
                    <input type="text" id="phone" name="phone" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="note">Ghi chú</label>
                    <textarea id="note" name="note" class="form-control"></textarea>
                </div>

                <!-- Thêm các trường thông tin khác cần thiết -->

                <button type="submit" class="btn btn-primary">Thanh toán</button>
            </form>
        @else
            <p>Giỏ hàng của bạn đang trống.</p>
        @endif
    </div>
@endsection
