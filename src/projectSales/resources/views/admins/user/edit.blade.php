<!-- resources/views/admin/users/edit.blade.php -->

@extends('admins.admin_layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">
                        <h3 class="card-title">Cập nhật thông tin khách hàng</h3>
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
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <!-- form start -->
                    <form method="POST" action="{{ route('user.update', [$user->id]) }}">
                        @method('PUT')
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Tên</label>
                                <input type="text" class="form-control" value="{{ $user->name }}" name="name" placeholder="Tên khách hàng">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" value="{{ $user->email }}" name="email" placeholder="Email khách hàng">
                            </div>
                            <div class="form-group">
                                <label for="phone_number">Số điện thoại</label>
                                <input type="text" class="form-control" value="{{ $user->phone_number }}" name="phone_number" placeholder="Số điện thoại khách hàng">
                            </div>
                            <div class="form-group">
                                <label for="apartment_number">Số nhà</label>
                                <input type="text" class="form-control" value="{{ $user->addresses->first()->apartment_number }}" name="apartment_number" placeholder="Số nhà khách hàng">
                            </div>
                            <div class="form-group">
                                <label for="ward">Phường/xã</label>
                                <input type="text" class="form-control" value="{{ $user->addresses->first()->ward }}" name="ward" placeholder="Phường/xã khách hàng">
                            </div>
                            <div class="form-group">
                                <label for="district">Quận/huyện</label>
                                <input type="text" class="form-control" value="{{ $user->addresses->first()->district }}" name="district" placeholder="Quận/huyện khách hàng">
                            </div>
                            <div class="form-group">
                                <label for="province">Tỉnh/thành phố</label>
                                <input type="text" class="form-control" value="{{ $user->addresses->first()->province }}" name="province" placeholder="Tỉnh/thành phố khách hàng">
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
@endsection
