@extends('admins.admin_layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">


                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Tạo mới danh mục</h3>
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
                        <form method="POST" action="{{ route('category.store') }}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên</label>
                                    <input type="text" class="form-control" name="name" onkeyup="ChangeToSlug();"
                                        id="slug" placeholder="....">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Slug</label>
                                    <input type="text" class="form-control" name="slug" id="convert_slug"
                                        placeholder="....">
                                </div>

                                <div class="form-group">
                                    <label for="exampleSelectBorder">Status
                                        <select class="custom-select form-control-border" name="parent_id"
                                            id="exampleSelectBorder">
                                            <option value="1">Danh mục cha</option>


                                        </select>
                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
