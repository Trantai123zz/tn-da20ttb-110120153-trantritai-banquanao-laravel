@extends('admins.admin_layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">


                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Chỉnh sửa danh mục</h3>
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
                        <form method="POST" action="{{ route('category.update', [$category->id]) }}">
                            @method('PUT')
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên</label>
                                    <input type="text" class="form-control" value="{{ $category->name }}" name="name"
                                        onkeyup="ChangeToSlug();" id="slug" placeholder="....">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Slug</label>
                                    <input type="text" class="form-control" value="{{ $category->slug }}" name="slug"
                                        id="convert_slug" placeholder="....">
                                </div>

                                <div class="form-group">
                                    <label for="exampleSelectBorder">Status
                                        <select class="custom-select form-control-border" name="parent_id"
                                            id="exampleSelectBorder">
                                            @if ($category->parent_id == 1)
                                                <option selected value="1">Danh mục cha</option>
                                                <option value="0">Danh mục phụ</option>
                                            @else
                                                <option value="1">Danh mục cha</option>
                                                <option selected value="0">Danh mục phụ</option>
                                            @endif

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
