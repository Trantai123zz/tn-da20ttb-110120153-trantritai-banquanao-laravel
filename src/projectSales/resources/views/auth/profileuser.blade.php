<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@extends('layout.newlayout')

@section('title', 'Thông tin cá nhân')

@section('content')
<div class="container">
    <div class="profile-info">
        <h3>Thông tin cá nhân</h3>
        <p><strong>Tên:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Số điện thoại:</strong> {{ $user->phone_number }}</p>
        @if($user->address)
            <p><strong>Tỉnh:</strong> {{ $user->address->province }}</p>
            <p><strong>Quận/huyện:</strong> {{ $user->address->district }}</p>
            <p><strong>Phường/xã:</strong> {{ $user->address->ward }}</p>
            <p><strong>Địa chỉ cụ thể:</strong> {{ $user->address->apartment_number }}</p>
        @endif

        <div class="profile-actions">
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-danger">Đăng xuất</button>
            </form>
        </div>
    </div>

    <div class="change-password-container">
        <h3>Thay đổi mật khẩu</h3>
        

        <form action="{{ route('change.password') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="current_password">Mật khẩu hiện tại</label>
                <input type="password" id="current_password" name="current_password" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="new_password">Mật khẩu mới</label>
                <input type="password" id="new_password" name="new_password" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="new_password_confirmation">Nhập lại mật khẩu mới</label>
                <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Đổi mật khẩu</button>
             <!-- Display success message -->
             @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Display validation errors -->
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
        </form>
    </div>
    <div class="orders-container">
        <h3>Danh sách đơn hàng</h3>
        <ul class="list-group">
            @foreach($orders as $order)
            <li class="list-group-item">
                <a href="{{ route('orders.details', $order->id) }}">Đơn hàng #{{ $order->id }}</a>
                <span class="badge badge-primary">{{ number_format($order->total_money) }} VNĐ</span>
            </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
