@extends('admins.admin_layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Danh sách danh mục</h3>

                        <style>
                        .card-header .card-title {
                            font-size: 24px; /* Kích thước chữ */
                            font-weight: bold; /* In đậm chữ */
                                      }
                          </style>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap" id="myTable">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên</th>
                                    <th>Slug</th>
                                    <th>Ngày tạo</th>
                                    <th>hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($category as $key => $cate)
                                    <tr>
                                        <td>{{ $key }}</td>
                                        <td>{{ $cate->name }}</td>
                                        <td>{{ $cate->slug }}</td>
                                        <td>{{ $cate->created_at }}</td>


                                        <td>
                                            <a href="{{ route('category.edit', [$cate->id]) }}"
                                                class="btn btn-primary ">Edit</a>

                                            <form action="{{ route('category.destroy', [$cate->id]) }}" method="POST">
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
