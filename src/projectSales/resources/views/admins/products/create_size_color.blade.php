@extends('admins.admin_layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Tạo mới màu sắc và kích cỡ</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{ route('store-size-color', [$product->id]) }}" enctype='multipart/form-data'>
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="product_name">Tên sản phẩm</label>
                                    <input type="text" class="form-control" readonly value="{{ $product->name }}" name="product_id" id="product_name">
                                </div>
                                <div class="form-group">
                                    <label for="file">Hình ảnh</label>
                                    <input type="file" class="form-control-file" name="file" id="file" required>
                                </div>

                                <div class="form-group">
                                    <label for="color_id">Màu sắc</label>
                                    <select class="custom-select" name="color_id" id="color_id">
                                        @foreach ($colors as $color)
                                            <option value="{{ $color->id }}">{{ $color->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            <div id="size-container">
                                <div id="size-container">
                                        <div class="form-group">
                                            <label for="size_id">Size</label>
                                            <select class="custom-select" name="size_ids[]">
                                                @foreach ($sizes as $size)
                                                    <option value="{{ $size->id }}">{{ $size->name }}</option>
                                                @endforeach
                                            </select>
                                         <label for="quantity">Số lượng</label>
                                            <input type="number" name="quantities[]" class="form-control" placeholder="Nhập số lượng" min="1">
                                        </div>
                                    </div>
                                </div>

                                <button type="button" class="btn btn-secondary" onclick="addSizeField()">Thêm size</button>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Lưu</button>
                            </div>
                        </form>

                        <table class="table table-hover text-nowrap mt-3">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Hình ảnh</th>
                                    <th>Màu sắc</th>
                                    <th>Size</th>
                                    <th>Số lượng</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($product_colors as $key => $productColor)
                                        @foreach ($productColor->productSizes as $productSize)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>
                                                    @if ($productColor->img)
                                                        <img src="{{ asset('images/' . $productColor->img) }}" height="80" width="80">
                                                    @else
                                                        <img src="{{ asset('images/default.png') }}" height="80" width="80">
                                                    @endif
                                                </td>
                                                <td>{{ $productColor->color->name }}</td>
                                                <td>{{ $productSize->size->name }}</td>
                                                <td>{{ $productSize->quantity }}</td>
                                                <td>
                                                    <form action="{{ route('delete-size-color', $productSize->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('Bạn có chắc chắn muốn xóa kích thước này?')" class="btn btn-danger">Xóa</button>
                                                </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function addSizeField() {
    const container = document.getElementById('size-container');
    const sizeField = document.createElement('div');
    sizeField.className = 'form-group';
    sizeField.innerHTML = `
        <label for="size_id">Size</label>
        <select class="custom-select" name="size_ids[]">
            @foreach ($sizes as $size)
                <option value="{{ $size->id }}">{{ $size->name }}</option>
            @endforeach
        </select>
        <label for="quantity">Số lượng</label>
        <input type="number" name="quantities[]" class="form-control" placeholder="Nhập số lượng" min="1">
        <button type="button" class="btn btn-danger mt-2" onclick="this.parentElement.remove()">Xóa</button>
    `;
    container.appendChild(sizeField);
}
    </script>
@endsection
