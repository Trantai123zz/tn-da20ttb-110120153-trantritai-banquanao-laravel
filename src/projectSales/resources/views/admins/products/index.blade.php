@extends('admins.admin_layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Danh sách sản phẩm</h3>
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
                                    <th>Màu sắc, size</th>
                                    <th>Giá nhâp</th>
                                    <th>Giá bán</th>
                                    <th>Danh mục</th>
                                    <th>Thương hiêu</th>


                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $key => $item)
                                    <tr>
                                        <td>{{ $key }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td><a href="{{ route('add-color-size', [$item->id]) }}">Thêm màu sắc kích thước</a>
                                        </td>
                                        <td>{{ number_format($item->price_import, 0, ',', '.') }}đ</td>
                                        <td>{{ number_format($item->price_sell, 0, ',', '.') }}đ</td>
                                        <td>{{ $item->category->name }}</td>
                                        <td>{{ $item->brand->name }}</td>


                                        <td>
                                            <a href="{{ route('product.edit', [$item->id]) }}"
                                                class="btn btn-primary ">Edit</a>

                                            <form action="{{ route('product.destroy', [$item->id]) }}" method="POST">
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
