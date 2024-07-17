@extends('admins.admin_layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">


                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Cập nhật sẩn phẩm</h3>
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{ route('product.update', [$item->id]) }}"
                            enctype='multipart/form-data'>
                            @method('PUT')
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên</label>
                                    <input type="text" class="form-control" value="{{ $item->name }}" name="name"
                                        placeholder="....">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá nhập vào</label>
                                    <input type="text" class="form-control" value="{{ $item->price_import }}"
                                        name="price_import" id="exampleInputEmail1" placeholder="....">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá bán </label>
                                    <input type="text" class="form-control" value="{{ $item->price_sell }}"
                                        name="price_sell" id="exampleInputEmail1" placeholder="....">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả</label>
                                    <textarea class="form-control" name="description" id="editor1">{{ $item->description }}</textarea>
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh</label>
                                    <input type="file" required class="form-control-file" name="filee" 
                                        placeholder="....">
                                </div>
                                <div class="form-group">
                                    <label for="exampleSelectBorder">Danh mục
                                        <select class="custom-select " name="category_id" id="exampleSelectBorder">
                                            @foreach ($category as $key => $cate)
                                                <option {{ $cate->id == $item->category_id ? 'selected' : '' }}
                                                    value="{{ $cate->id }}">{{ $cate->name }}</option>
                                            @endforeach
                                        </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleSelectBorder">Thương hiệu
                                        <select class="custom-select " name="brand_id" id="exampleSelectBorder">
                                            @foreach ($brand as $key => $bra)
                                                <option {{ $bra->id == $item->brand_id ? 'selected' : '' }}
                                                    value="{{ $bra->id }}">{{ $bra->name }}</option>
                                            @endforeach


                                        </select>
                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
