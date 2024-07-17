@extends('admins.admin_layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Danh sách đơn hàng</h3>

                        <style>
                        .card-header .card-title {
                            font-size: 24px; /* Kích thước chữ */
                            font-weight: bold; /* In đậm chữ */
                                      }
                          </style>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>STT</th>

                                    <th>Thành tiền</th>
                                    <th>Trang thái</th>
                                    <th>Chi phí vận chuyển</th>
                                    <th>Ghi chú</th>
                                    <th>Thời gian tạo</th>

                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $key => $order)
                                    <tr>
                                        <td>{{ $key }}</td>

                                        <td>{{ number_format($order->total_money, 0, ',', '.') }}vnđ</td>
                                        <td>
                                            @if ($order->order_status == 0)
                                                <span class="text text-success">Đơn hàng mới</span>
                                            @else
                                                <span class="text text-danger">Đơn hàng đã xử lý</span>
                                            @endif
                                        </td>
                                        <td>{{ $order->transport_fee }}</td>
                                        <td>{{ $order->note }}</td>
                                        <td>{{ $order->created_at }}</td>


                                        <td>
                                            <a href="{{ route('order.show', [$order->id]) }}" class="btn btn-primary ">View
                                                Order</a>

                                            <form action="{{ route('order.destroy', [$order->id]) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button onclick="return confirm('Are u want to delete?');"
                                                    class="btn btn-danger">Delete</button>

                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
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
