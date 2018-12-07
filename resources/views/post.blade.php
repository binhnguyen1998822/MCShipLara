@extends('layouts.header')
@section('content')
    <?php $user = Auth::user();?>


    <script>
        $(document).ready(function () {
            $(document).on("click", ".check12", function () {
                var ida = $(this).parent().attr('id');
                var url = '';
                if ($(this).prop('checked') == true) {
                    url = 'post/status/true';
                } else if ($(this).prop('checked') == false) {
                    url = 'post/status/false';
                }
                $.ajax({
                    url: url,
                    type: 'get',
                    data: 'id=' + ida,
                    success: function (result) {
                        notification("topright", "success", "fa fa-check-circle vd_green", "Thành công", "Hoàn thất thay đổi thạng thái");
                    }
                });
            });
            $(document).on("click", ".check11", function () {
                var ida = $(this).parent().attr('id');
                var url = '';
                if ($(this).prop('checked') == true) {
                    url = 'post1/status/true';
                } else if ($(this).prop('checked') == false) {
                    url = 'post1/status/false';
                }
                $.ajax({
                    url: url,
                    type: 'get',
                    data: 'id=' + ida,
                    success: function (result) {
                        notification("topright", "success", "fa fa-check-circle vd_green", "Thành công", "Hoàn thất thay đổi thạng thái");
                    }
                });
            });

        });
    </script>
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
                                        <input class="form-control form-control-alternative" type="text"
                                               name="datefilter" value="{{$cachesearch->datefilter}}"
                                               autocomplete="off"/>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-control-label">Số điện thoại</label>
                                        <input type="text" class="form-control form-control-alternative" name="so_dt"
                                               autocomplete="off"
                                               value="{{$cachesearch->so_dt}}">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-control-label">Trạng thái</label>
                                        <select class="form-control form-control-alternative" name="trang_thai">
                                            <option value="">...</option>
                                            @foreach($trangthai as $s)
                                                <option value="{{$s->idtt}}"
                                                        @if($cachesearch->trang_thai == $s->idtt)selected @endif>{{$s->ten_trangthai}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-control-label">Loại ship</label>
                                        <select class="form-control form-control-alternative" name="id_loaiship">
                                            <option value="">...</option>
                                            @foreach($loaiship as $s)
                                                <option value="{{$s->idsp}}"
                                                        @if($cachesearch->id_loaiship == $s->idsp)selected @endif>{{$s->loai_ship}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-control-label">Loại bảo hành</label>
                                        <select class="form-control form-control-alternative" name="id_bh">
                                            <option value="">...</option>
                                            @foreach($loaibh as $v)
                                                <option value="{{$v->idbh}}"
                                                        @if($cachesearch->id_bh == $v->idbh)selected @endif>{{$v->loai_bh}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-1">
                                        <label class="form-control-label">Lọc</label>
                                        <input type="submit" class="form-control form-control-alternative btn-success"
                                               value="Tìm kiếm">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">VNPost</h3>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="testTable" class="table align-items-center table-flush">
                            <thead class="text-warning">
                            <th>Mã</th>
                            <th>Loại Ship</th>
                            <th>Người nhập</th>
                            <th>Tên Khách hàng</th>
                            <th>Số Điện Thoại</th>
                            <th>Sản phẩm</th>
                            <th>Số tiền</th>
                            <th>Mã vận đơn</th>
                            <th>Tình trạng</th>
                            <th>Ngày gửi</th>
                            <th>Thành công</th>
                            <th>Hoàn đơn</th>
                            <th></th>
                            </thead>
                            <tbody>
                            @if($post->count())
                                @foreach($post	 as $v)
                                    <tr>
                                        <td>MC-{{$v->id}}</td>

                                        <td>{{$v->loaiship->loai_ship}}</td>
                                        <td>{{$v->user->name}}</td>
                                        <td>{{$v->ho_ten}}</td>
                                        <td>{{$v->so_dt}}</td>
                                        <td>{{$v->ten_may}}</td>

                                        <td>
                                            <?php $sotien = $v->so_tien;
                                            echo number_format(($sotien), 0, ",", ".") . ' đ'?>
                                        </td>
                                        <td><a href="http://www.vnpost.vn/vi-vn/dinh-vi/buu-pham?key={{$v->ma_vd}}"
                                               target="_blank">{{$v->ma_vd}}</a></td>
                                        <td>
                                            @if($v->trang_thai == 1)
                                                <span class="label label-warning">{{"Đang chờ"}}<span>
												@elseif($v->trang_thai == 2)
                                                            <span class="label label-primary">{{"Đã xác nhận"}}</span>
                                                        @elseif($v->trang_thai == 3)
                                                            <span class="label label-info">{{"Đang giao hàng"}}</span>
                                                        @elseif($v->trang_thai == 4)
                                                            <span class="label label-success">{{"Giao hàng thành công"}}<span>
												@elseif($v->trang_thai == 5)
                                                                        <span class="label label-danger">{{"Đơn bị hủy"}}</span>
                                                                    @elseif($v->trang_thai == 6)
                                                                        <span class="label label-info">{{"Đã gửi VNPost"}}</span>
                                            @endif
                                        </td>
                                        <td>{{$v->created_at}}</td>
                                        <td>
                                            <div class="checkbox">
                                                <label id="{{$v->id}}">
                                                    <input type="checkbox" id="check{{$v->id}}"
                                                           <?php echo $v->trang_thai == 4 ? "checked" : '' ?> class="check12">
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="checkbox">
                                                <label id="{{$v->id}}">
                                                    <input type="checkbox" id="check{{$v->id}}"
                                                           <?php echo $v->trang_thai == 5 ? "checked" : '' ?> class="check11">
                                                </label>
                                            </div>
                                        </td>
                                        <td><a href="{{ asset('') }}donhang/{{$v->id}}"><i
                                                        class="fas fa-ellipsis-v  text-success"></i></a></td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        <nav aria-label="...">
                            <ul class="pagination justify-content-end mb-0">
                                {{ $post->appends($_GET)->links( "pagination::bootstrap-4") }}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">

                    <form method="post" action="{{ url('import') }}" class="form-horizontal" data-toggle="validator"
                          enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Nhập</h4>
                        </div>
                        <div class="modal-header">

                            <div class="custom-file">
                                <input type="file" name="file" data-icon="false">

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-default">Nhập</button>
                        </div>
                    </form>

                </div>

            </div>
        </div>
@endsection

