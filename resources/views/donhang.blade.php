@extends('layouts.header')
@section('content')
    <?php $user = Auth::user();?>

    <script>
        $(document).ready(function () {
            $('#mvd').attr('en', 'disabled');
            $('select[name="id_loaiship"]').on('change', function () {
                var others = $(this).val();
                if (others == "1") {
                    document.getElementById("ma_the").disabled = false;
                    document.getElementById("ma_seri").disabled = false;

                }
                else {
                    document.getElementById("ma_the").disabled = true;
                    document.getElementById("ma_seri").disabled = true;
                }
            });

            $('select[name="id_bh"]').on('change', function () {
                var others = $(this).val();
                if (others == "2") {
                    document.getElementById("thang_bh").disabled = false;

                }
                else {
                    document.getElementById("thang_bh").disabled = true;
                }
            });

        });

    </script>
    <style>
        .max-lines {
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            max-width: 80px;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
        }
    </style>
    <div class="container-fluid mt--7">
        <!-- Table -->
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <form action="" method="GET">
                        <div class="row">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-control-label">Thời gian</label>
                                        <input class="form-control form-control-alternative" type="text" name="datefilter" value="{{$cachesearch->datefilter}}" autocomplete="off"/>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-control-label">Số điện thoại</label>
                                        <input type="text" class="form-control form-control-alternative" name="so_dt" autocomplete="off"
                                               value="{{$cachesearch->so_dt}}">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-control-label">Trạng thái</label>
                                        <select class="form-control form-control-alternative" name="trang_thai">
                                            <option value="">...</option>
                                        @foreach($trangthai as $s)
                                            <option value="{{$s->idtt}}" @if($cachesearch->trang_thai == $s->idtt)selected @endif>{{$s->ten_trangthai}}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-control-label">Loại ship</label>
                                        <select class="form-control form-control-alternative" name="id_loaiship">
                                            <option value="">...</option>
                                            @foreach($loaiship as $s)
                                                <option value="{{$s->idsp}}" @if($cachesearch->id_loaiship == $s->idsp)selected @endif>{{$s->loai_ship}}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-control-label">Loại bảo hành</label>
                                        <select class="form-control form-control-alternative" name="id_bh">
                                            <option value="">...</option>
                                            @foreach($loaibh as $v)
                                                <option value="{{$v->idbh}}" @if($cachesearch->id_bh == $v->idbh)selected @endif>{{$v->loai_bh}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-1">
                                        <label class="form-control-label">Lọc</label>
                                        <input type="submit" class="form-control form-control-alternative btn-success" value="Tìm kiếm">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Hóa đơn</h3>
                            </div>
                            <div class="col text-right">
                                <a data-toggle="modal"
                                   data-target="#exampleModal" class="btn btn-sm btn-success" style="color: #fff">Thêm đơn</a>
                                <a href="{{ url('exportdh') }}?datefilter={{$cachesearch->datefilter}}&so_dt={{$cachesearch->so_dt}}&trang_thai={{$cachesearch->trang_thai}}&id_loaiship={{$cachesearch->id_loaiship}}" class="btn btn-sm btn-success">Xuất</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="testTable" class="table align-items-center table-flush">
                            <thead class="text-success">
                            <th>Loại Ship</th>
                            <th>Cơ sở nhận</th>
                            <th>Tên Khách hàng</th>
                            <th>Số Điện Thoại</th>
                            <th>Sản phẩm</th>
                            <th>Số tiền</th>
                            <th>Trạng thái</th>
                            <th>Ghi chú</th>
                            <th>Thời gian</th>
                            <th></th>
                            </thead>
                            <tbody>
                            @if($donhang->count())
                                @foreach($donhang as $v)
                                    <tr>


                                        <td>{{$v->loaiship->loai_ship}}</td>
                                        <td>{{$v->co_so}}</td>
                                        <td>{{$v->ho_ten}}</td>
                                        <td>{{$v->so_dt}}</td>
                                        <td>{{$v->ten_may}}</td>

                                        <td>
                                            <?php $sotien = $v->so_tien;
                                            echo number_format(($sotien), 0, ",", ".") . ' đ'?>
                                        </td>
                                        <td>
                                            @if($v->trang_thai == 1)
                                                <span class="badge badge-dot mr-4"><i
                                                            class="bg-warning"></i>{{"Đang chờ"}}<span>
												@elseif($v->trang_thai == 2)
                                                            <span class="badge badge-dot mr-4"><i
                                                                        class="bg-primary"></i>{{"Xác nhận"}}</span>
                                                        @elseif($v->trang_thai == 3)
                                                            <span class="badge badge-dot mr-4"><i
                                                                        class="bg-info"></i>{{"Đang giao"}}</span>
                                                        @elseif($v->trang_thai == 4)
                                                            <span class="badge badge-dot mr-4"><i
                                                                        class="bg-success"></i> {{"Thành công"}}
                                                                <span>
												@elseif($v->trang_thai == 5)
                                                                        <span class="badge badge-dot mr-4"><i
                                                                                    class="bg-danger"></i>{{"Hủy"}}</span>
                                                                    @elseif($v->trang_thai == 6)
                                                                        <span class="badge badge-dot mr-4"><i
                                                                                    class="bg-info"></i>{{"VNPost"}}</span>
                                            @endif
                                        </td>
                                        <td><a data-toggle="tooltip" data-placement="top"
                                               data-original-title="{{$v->ghi_chu}}"
                                               class="max-lines">{{$v->ghi_chu}}</a></td>
                                        <td>{{$v->created_at}}</td>
                                        <td><a href="{{ asset('') }}donhang/{{$v->id}}" class="btn btn-sm btn-success">Sửa</a></td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        <nav aria-label="...">
                            <ul class="pagination justify-content-end mb-0">
                                {{ $donhang->appends($_GET)->links( "pagination::bootstrap-4") }}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" style="width:100%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Thêm đơn hàng mới</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ url('nhap') }}" method="POST" enctype="multipart/form-data"
                          onsubmit="return checkForm(this);" id="reg_form">
                        <div class="modal-body">

                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-control-label">Khách hàng</label>
                                    <input type="text" name="ho_ten" class="form-control"
                                           placeholder="Họ và tên khách hàng" autocomplete="off" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-control-label">Số điện thoại</label>
                                    <input type="number" name="so_dt" class="form-control typeaheadphone"
                                           autocomplete="off" placeholder="Nhập số điện thoại" required>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-control-label">Địa Chỉ</label>
                                    <input type="text" name="dia_chi" class="form-control"
                                           placeholder="Nơi giao hàng đến " autocomplete="off" required>
                                </div>

                                <div class="col-md-3">
                                    <label class="form-control-label">Thiết bị</label>
                                    <input type="text" name="ten_may" class="form-control typeahead" autocomplete="off"
                                           placeholder="Điện thoại đi ship" required>
                                </div>

                                <div class="col-md-1">
                                    <label class="form-control-label">Dung lượng</label>
                                    <select class="form-control" id="select" name="sp_dungluong">
                                        @foreach($dungluong as $v)
                                            <option value="{{$v->so_dungluong}}">{{$v->so_dungluong}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-1">
                                    <label class="form-control-label">RAM</label>
                                    <select class="form-control" id="select" name="ram">
                                        <option value="1GB">1GB</option>
                                        <option value="2GB">2GB</option>
                                        <option value="3GB">3GB</option>
                                        <option value="4GB">4GB</option>
                                        <option value="6GB">6GB</option>
                                        <option value="8GB">8GB</option>
                                        <option value="8GB">16GB</option>


                                    </select>
                                </div>

                                <div class="col-md-1">
                                    <label class="form-control-label">Màu sắc</label>
                                    <select class="form-control" id="select" name="sp_color">
                                        @foreach($color as $v)
                                            <option value="{{$v->ten_color}}">{{$v->ten_color}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-control-label">Cơ sở nhận</label>
                                        <select class="form-control" id="select" name="co_so">
                                            @foreach($coso as $v)
                                                <option value="{{$v->ten_coso}}">{{$v->ten_coso}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="form-control-label">Bảo hành</label>
                                        <select class="form-control" id="select" name="id_bh">
                                            @foreach($loaibh as $v)
                                                <option value="{{$v->idbh}}">{{$v->loai_bh}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label class="form-control-label">Thời gian</label>
                                        <select class="form-control" id="thang_bh" name="thang_bh" disabled>
                                            <option value="6">6 tháng</option>
                                            <option value="12">12 tháng</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-control-label">Ngân hàng</label>
                                        <select class="form-control" name="nganhang">
                                            @foreach($bank as $v)
                                                <option value="{{$v->ten_nganhang}}">{{$v->ten_nganhang}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-control-label">Loại Ship</label>
                                        <select class="form-control" name="id_loaiship">
                                            @foreach($loaiship as $v)
                                                <option value="{{$v->idsp}}">{{$v->loai_ship}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-control-label">Phụ kiện</label>
                                    <input type="text" id="dpk" name="phukien" class="form-control"
                                           placeholder="Linh kiện kèm theo máy" required>
                                </div>

                                <div class="col-md-3">
                                    <label class="form-control-label">Thẻ điện thoại</label>
                                    <input type="text" id="ma_the" name="ma_the" class="form-control"
                                           placeholder="Thẻ điện thoại" autocomplete="off" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-control-label">Seri</label>
                                    <input type="text" id="ma_seri" name="ma_seri" class="form-control"
                                           placeholder="Mã seri" autocomplete="off" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-control-label">Ghi chú</label>
                                    <input type="text" name="ghi_chu" class="form-control" placeholder="Ghi lại đỡ quên"
                                           required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-control-label">Tổng Tiền</label>
                                    <input type="text" name="so_tien" id="getvalue" class="form-control"
                                           placeholder="Nhập đầy đủ số tiền" autocomplete="off" required>
                                    <p style="padding-top: 10px">Tổng tiền: <strong style="color:red"><span
                                                    id="setresult">0 đ</span></label></p>
                                </div>


                            </div>
                            <div class="clearfix"></div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                            <button type="submit" name="myButton" class="btn btn-success">Thêm đơn</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            var pathx = "{{ route('autocompletephone') }}";
            $('input.typeaheadphone').typeahead({
                source: function (query, process) {
                    return $.get(pathx, {query: query}, function (data) {
                        return process(data);
                    });
                }
            });
        </script>

        <script type="text/javascript">
            var path = "{{ route('autocomplete') }}";
            $('input.typeahead').typeahead({
                source: function (query, process) {
                    return $.get(path, {query: query}, function (data) {
                        return process(data);
                    });
                }
            });
        </script>

@endsection