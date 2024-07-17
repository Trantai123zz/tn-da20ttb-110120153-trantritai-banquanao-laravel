@extends('admins.admin_layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Danh sách khách hàng</h3>
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
                                    <th>Tên</th>
                                    <th>Email</th>
                                    <th>Số điện thoại</th>
                                    <th>Địa chỉ</th>
                                    <th>Ngày tạo</th>
                                  
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $key => $customer)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $customer->name }}</td>
                                        <td>{{ $customer->email }}</td>
                                        <td>{{ $customer->phone_number }}</td>
                                        <td>
                                            @foreach ($customer->addresses as $address)
                                                {{ $address->apartment_number }}, {{ $address->ward }},
                                                {{ $address->district }}, {{ $address->province }}<br>
                                            @endforeach
                                        </td>
                                        <td>{{ $customer->created_at ? $customer->created_at->format('d-m-Y H:i') : 'N/A' }}</td>
                                
                                        <td>
                                            <a href="{{ route('user.edit', [$customer->id]) }}" class="btn btn-primary">Edit</a>

                                            <form action="{{ route('user.destroy', [$customer->id]) }}" method="POST" style="display:inline;">
                                                @method('DELETE')
                                                @csrf
                                                <button onclick="return confirm('Bạn có chắc chắn muốn xóa?');" class="btn btn-danger">Delete</button>
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
