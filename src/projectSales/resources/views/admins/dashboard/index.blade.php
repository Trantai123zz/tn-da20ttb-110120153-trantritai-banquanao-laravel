@extends('admins.admin_layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                   
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <p class="title_thongke">Thống kê đơn hàng doanh số</p>
                        <style>
                        .title_thongke {
                            font-size: 24px; /* Kích thước chữ */
                            font-weight: bold; /* In đậm chữ */
                                      }
                          </style>
                        <form autocomplete="off">
                            @csrf

                            <div class="col-md-6">
                                <p>Từ ngày: <input type="text" id="datepicker" class="form-control"></p>

                                <input type="button" id="btn-dashboard-filter" class="btn btn-primary btn-sm"
                                    value="Lọc kết quả"></p>

                            </div>

                            <div class="col-md-6">
                                <p>Đến ngày: <input type="text" id="datepicker2" class="form-control"></p>

                            </div>

                            <div class="col-md-6">
                                <p>
                                    Lọc theo:
                                    <select class="dashboard-filter form-control">
                                        <option>--Chọn--</option>

                                        <option value="7ngay">7 ngày qua</option>
                                        <option value="thangtruoc">tháng trước</option>
                                        <option value="thangnay">tháng này</option>
                                        <option value="365ngayqua">365 ngày qua</option>
                                    </select>
                                </p>
                            </div>

                        </form>

                        <div class="col-md-12">
                            <div id="chart" style="height: 250px;"></div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
@endsection
