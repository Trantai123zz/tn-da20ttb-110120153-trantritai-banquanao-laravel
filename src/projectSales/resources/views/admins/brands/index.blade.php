@extends('admins.admin_layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Danh sách thương hiệu</h3>

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
                                    <th>Hành động</th>
                                </tr>
                                    </thead>
                            <tbody>
                                @foreach ($brand as $key => $bra)
                                    <tr>
                                        <td>{{ $key }}</td>
                                        <td>{{ $bra->name }}</td>


                                        <td>
                                            <a href="{{ route('brand.edit', [$bra->id]) }}"
                                                class="btn btn-primary ">Edit</a>

                                            <form action="{{ route('brand.destroy', [$bra->id]) }}" method="POST">
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
