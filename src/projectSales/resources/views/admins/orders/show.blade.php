@extends('admins.admin_layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">

                        <h3 class="card-title">Mã Đơn Hàng : #{{ $order->id }}</h3>
                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control float-right"
                                    placeholder="Search">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên Sản Phẩm</th>
                                    <th>Size</th>
                                    <th>Màu sắc</th>
                                    <th>Giá </th>
                                    <th>Số lượng</th>

                                    <th>Ngày tạo</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order_detail as $key => $order)
                                    <tr>
                                        <td>{{ $key }}</td>
                                        <td>{{ $order->product->name }}</td>
                                        <td>{{ $order->size }}</td>
                                        <td>{{ $order->color }}</td>
                                        <td>{{ number_format($order->unit_price, 0, ',', '.') }}vnđ</td>
                                        <td>{{ $order->quantity }}</td>
                                        <td>{{ $order->created_at }}</td>


                                    </tr>
                                @endforeach
                                <tr>
                                    <td>
                                        <form method="POST" action="{{ route('update-order', [$order->order_id]) }}">
                                            @csrf
                                            <input type="submit" class="btn btn-primary" value="Cập nhật đơn hàng">
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
@endsection
