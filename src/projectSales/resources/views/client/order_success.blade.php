@extends('layout.layout_login')

@section('title', 'Đặt hàng thành công')

@section('content')
<style>
    .container {
        max-width: 400px; /* Giới hạn chiều rộng tối đa của container */
        margin: 50px auto; /* Căn giữa theo chiều ngang và khoảng cách từ trên */
        padding: 20px;
        background-color: #fff; /* Màu nền trắng */
        border-radius: 8px; /* Bo tròn các góc */
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.2); /* Đổ bóng nhẹ */
        text-align: center; /* Căn giữa nội dung trong container */
    }

    h2 {
        font-size: 24px;
        color: #007bff; /* Màu chữ của tiêu đề */
        margin-bottom: 20px; /* Khoảng cách dưới tiêu đề */
    }

    p {
        font-size: 18px;
        color: #333; /* Màu chữ của nội dung */
        margin-bottom: 30px; /* Khoảng cách dưới đoạn văn */
    }

    .btn-primary {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 12px 24px;
        border-radius: 4px;
        text-decoration: none;
        font-size: 16px;
        display: inline-block; /* Để nút bấm không chiếm toàn bộ chiều rộng */
        transition: background-color 0.3s; /* Hiệu ứng chuyển màu nền khi hover */
    }

    .btn-primary:hover {
        background-color: #0056b3;
        text-decoration: none; /* Bỏ gạch chân khi hover */
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Đặt hàng thành công</h2>
            <p>Cảm ơn bạn đã đặt hàng! Đơn hàng của bạn đã được nhận.</p>
            <a href="{{ route('home') }}" class="btn btn-primary">Tiếp tục mua sắm</a>
        </div>
    </div>
</div>

@endsection
