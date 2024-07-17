<div class="swiper-slide">
        <img class="banner-image" src="{{ asset('images/odt.jpg') }}" alt="Banner 3">
</div>
@extends('layout.cart')
<link rel="stylesheet" href="{{ asset('css/order_detail.css') }}">

@section('title', 'Chi tiết đơn hàng')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header">
            <h5 class="mb-0">{{ __('Chi tiết đơn hàng') }}</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>{{ __('Mã đơn hàng') }}</th>
                        <th>{{ __('Sản phẩm') }}</th>
                        <th>{{ __('Kích thước') }}</th>
                        <th>{{ __('Màu sắc') }}</th>
                        <th>{{ __('Giá đơn vị') }}</th>
                        <th>{{ __('Số lượng') }}</th>
                        <th>{{ __('Thành tiền') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orderDetails as $orderDetail)
                    <tr>
                        <td>{{ $orderDetail->id }}</td>
                        <td>{{ $orderDetail->product->name ?? 'N/A' }}</td>
                        <td>{{ $orderDetail->size ?? 'N/A' }}</td>
                        <td>{{ $orderDetail->color }}</td>
                        <td>{{ number_format($orderDetail->unit_price) }} VNĐ</td>
                        <td>{{ $orderDetail->quantity }}</td>
                        <td>{{ number_format($orderDetail->unit_price * $orderDetail->quantity) }} VNĐ</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
