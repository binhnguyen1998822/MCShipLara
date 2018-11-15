@extends('layouts.header')
@section('content')
    <div class="container-fluid mt--7">
        <!-- Table -->
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <h3 class="mb-0">Hóa đơn</h3>
                        <div class="float-right">
                            <a class="btn btn-success"
                               style="background:#ffa000; color: #fff">{{$status->trangthai->ten_trangthai }}</a>
                            <a class="material-icons fancybox fancybox.iframe btn btn-default"
                               href="{{ url('history') }}/?lsdh={{$status->id}}">Lịch sử</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('donhang') }}/{{$status->id}}" method="POST" enctype="multipart/form-data"
                              onsubmit="return checkForm(this);">
                            {{ csrf_field() }}
                            <input type="hidden" name="id_dh" value="{{$status->id}}" class="form-control">
                            <input type="hidden" name="id_user" value="{{ Auth::user()->id }}" class="form-control">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group label-floating">
                                        <label class="control-label"><strong>Người tạo đơn</strong></label>
                                        <input type="text" value="{{$status->user->name}}" class="form-control"
                                               disabled>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Loại Ship</label>
                                        <input type="text" value="{{$status->loaiship->loai_ship}}" class="form-control"
                                               disabled>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Ngân hàng</label>
                                        <select class="form-control" id="select" name="nganhang">
                                            @foreach($bank as $b)
                                                <option value="{{$b->ten_nganhang}}"
                                                        @if($status->nganhang == $b->ten_nganhang) selected @endif>{{$b->ten_nganhang}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @if($status->id_bh == 2 )
                                    <div class="col-md-2">
                                        @elseif($status->id_bh == 1 ||$status->id_bh == 3)
                                            <div class="col-md-3">
                                                @endif
                                                <div class="form-group label-floating">
                                                    @if($status->id_bh == 1 ||$status->id_bh == 2 )
                                                        <label class="control-label">Bảo hành</label>
                                                    @elseif($status->id_bh == 3)
                                                        <label class="control-label">Combo</label>
                                                    @endif
                                                    <select class="form-control" id="select" name="id_bh">
                                                        <option value="1" @if($status->id_bh == 1) selected @endif>Bảo
                                                            Hành Thường
                                                        </option>
                                                        <option value="2" @if($status->id_bh == 2) selected @endif>Bảo
                                                            Hành Vàng
                                                        </option>
                                                        <option value="3" @if($status->id_bh == 3) selected @endif>
                                                            Combo
                                                        </option>
                                                    </select>

                                                </div>
                                            </div>
                                            @if($status->id_bh == 2 )
                                                <div class="col-md-1">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Thời gian</label>
                                                        <input type="text" name="thang_bh" id="thang_bh"
                                                               value="{{$status->thang_bh}} tháng" class="form-control">
                                                    </div>
                                                </div>
                                            @endif
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Khách hàng</label>
                                                <input type="text" name="ho_ten" id="hoten" value="{{$status->ho_ten}}"
                                                       class="form-control" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Số điện thoại</label>
                                                <input type="text" name="so_dt" id="sdt" value="{{$status->so_dt}}"
                                                       class="form-control" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Địa chỉ</label>
                                                <input type="text" name="dia_chi" id="diachi"
                                                       value="{{$status->dia_chi}}" class="form-control"
                                                       autocomplete="off">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Tên máy</label>
                                                <input type="text" name="ten_may" id="ten_may"
                                                       value="{{$status->ten_may}}" class="form-control typeahead"
                                                       autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Dung lượng</label>
                                                <input type="text" id="dungluong" name="sp_dungluong"
                                                       value="{{$status->sp_dungluong}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-group label-floating">
                                                <label class="control-label">RAM</label>
                                                <input type="text" id="ram" name="ram" value="{{$status->ram}}"
                                                       class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Màu sắc</label>
                                                <select class="form-control" id="select" name="sp_color">
                                                    @foreach($color as $b)
                                                        <option value="{{$b->ten_color}}"
                                                                @if($status->sp_color == $b->ten_color) selected @endif>{{$b->ten_color}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        @if($status->id_loaiship == 3 )
                                            <div class="col-md-4">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">IMEI</label>
                                                    <input type="text" id="imei" name="imei" value="{{$status->imei}}"
                                                           class="form-control" autocomplete="off" required>
                                                </div>
                                            </div>
                                        @elseif($status->id_loaiship == 1 ||$status->id_loaiship == 2)
                                            @if($status->trang_thai == 2 ||$status->trang_thai == 6||$status->trang_thai == 4 )
                                                <div class="col-md-4">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Mã vận đơn</label>
                                                        <input type="text" id="mavd" name="ma_vd"
                                                               value="{{$status->ma_vd}}" class="form-control"
                                                               autocomplete="off" required>
                                                    </div>
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Tổng tiền</label>
                                                <input type="text" name="so_tien" id="getvalue"
                                                       value="{{$status->so_tien}}" class="form-control"
                                                       autocomplete="off">
                                                <p>Tổng tiền: <strong style="color:red"><span
                                                                id="setresult"><?php echo number_format(($status->so_tien))?>
                                                            đ</span></strong></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Phụ kiện</label>
                                                <div class="form-group label-floating">
                                                    <input type="text" name="phukien" value="{{$status->phukien}}"
                                                           class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Ghi chú</label>
                                                <div class="form-group label-floating">
                                                    <input type="text" name="ghi_chu" value="{{$status->ghi_chu}}"
                                                           class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    @if(Auth::user()->role == 'Kho')

                                        @if($status->id_loaiship == 1 || $status->id_loaiship == 2)
                                            @if( $status->trang_thai == 2)
                                                <div class="col-sm-6 float-right">
                                                    <input type="hidden" name="trang_thai" id="edtgiaohang" value="6"
                                                           class="form-control">
                                                    <input class="btn btn-success float-right" id="btngiaohang"
                                                           type="submit" name="myButton" value="Gửi VNPost"
                                                           onclick="disHuydon()">
                                                </div>
                                            @endif
                                        @endif

                                        @if($status->trang_thai == 1)
                                            <div class="col-sm-6 float-right">
                                                <input type="hidden" name="trang_thai" value="2" class="form-control">
                                                <input class="btn btn-primary float-right" type="submit" name="myButton"
                                                       value="Chấp nhận" onclick="disHuydon()">
                                            </div>
                                        @elseif($status->id_loaiship == 3 && $status->trang_thai == 2 || $status->trang_thai == 3)
                                            <div class="col-sm-6 float-right">
                                                <input type="hidden" name="trang_thai" value="4" class="form-control">
                                                <input class="btn btn-primary float-right" type="submit" name="myButton"
                                                       value="Giao hàng thành công" onclick="disHuydon()">
                                            </div>
                                            <div class="col-sm-6 float-right">
                                                <input type="hidden" name="trang_thai" id="edthuydon" value="5"
                                                       class="form-control">
                                                <input class="btn btn-danger float-right" id="btnhuydon" type="submit"
                                                       name="myButton" value="Hủy đơn" onclick="disHoanthanh()">
                                            </div>
                                        @elseif($status->id_loaiship != 3 && $status->trang_thai == 2 || $status->trang_thai == 3)
                                            <div class="col-sm-6 float-right">
                                                <input type="hidden" name="trang_thai" id="edthuydon" value="5"
                                                       class="form-control">
                                                <input class="btn btn-danger float-right" id="btnhuydon" type="submit"
                                                       name="myButton" value="Hủy đơn" onclick="disHoanthanh()">
                                            </div>
                                        @endif

                                        @if($status->trang_thai == 4 && $status->ma_vd == null)
                                            @if($status->id_loaiship == 1 || $status->id_loaiship == 2)
                                                <input class="btn btn-primary float-right" type="submit" name="myButton"
                                                       value="Cập nhập mã vận đơn">
                                            @endif
                                        @endif

                                        @if($status->trang_thai == 6)
                                            <div class="col-sm-6 float-right">
                                                <input type="hidden" name="trang_thai" value="4" class="form-control">
                                                <input class="btn btn-primary float-right" type="submit" name="myButton"
                                                       value="Giao hàng thành công" onclick="disHuydon()">
                                            </div>
                                        @endif
                                    @endif



                                    @if(Auth::user()->role == 'SuperAdmin')
                                        <div class="col-sm-6 float-right">
                                            <label>Hành động</label>
                                            <select class="form-control" id="select" name="trang_thai">
                                                @foreach($trangthai as $v)
                                                    <option value="{{$v->idtt}}">{{$v->ten_trangthai}}</option>
                                                @endforeach
                                            </select>
                                            <br>
                                            <input class="btn btn-primary float-right" type="submit" name="myButton"
                                                   value="Cập nhập">
                                        <!--<a href="{{ url('deldonhang') }}/{{$status->id}}" onclick="return confirm('Bạn muốn xóa đơn hàng này?');" class="btn btn-danger float-right">Xóa</a>-->

                                        </div>
                                    @endif

                                    @if(Auth::user()->role == 'Nhap')
                                        @if($status->trang_thai == 1)
                                            <div class="col-sm-6 float-right">
                                                <input type="hidden" name="trang_thai" id="edthuydon" value="5"
                                                       class="form-control">
                                                <input class="btn btn-danger float-right" id="btnhuydon" type="submit"
                                                       name="myButton" value="Hủy đơn" onclick="disHoanthanh()">
                                            </div>
                                        @endif
                                    @endif

                                    <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <script>
            function disHuydon() {
                document.getElementById("edthuydon").disabled = true;
                document.getElementById("btnhuydon").disabled = true;


            }

            function disHoanthanh() {
                document.getElementById("imei").disabled = true;
                document.getElementById("edtgiaohang").disabled = true;
                document.getElementById("btngiaohang").disabled = true;

            }

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