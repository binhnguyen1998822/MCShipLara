@extends('layouts.header')
@section('content')
<?php $user = Auth::user();?>
@if($user->role !== 'Nhap')
<button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#myModal">Nhập</button>
@endif
<a type="button" href="{{ url('export')}}?datefilter=<?php echo $datefilter ?>" class="btn btn-success pull-right">Xuất</a>
<h3 class="card-title"><?php echo $datefilter ?></h3>
<script>
    $(document).ready(function () {
        document.getElementById("barreport").className = "active";
    });
</script>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card card-nav-tabs">
                <table class="table">
                    <table class="table">
                        <thead class="text-warning">
                        <th>Mã</th>
                        <th>Loại Ship</th>
                        <th>Người nhập</th>
                        <th>Tên Khách hàng</th>
                        <th>Số Điện Thoại</th>
                        <th>Sản phẩm</th>
                        <th>Mã vận đơn</th>
                        <th>Số tiền</th>
                        <th>Trạng thái</th>
                        <th>Ngày gửi</th>
                        <th></th>
                        </thead>
                        <tbody>
                        @if($report->count())
                            @foreach($report as $v)
                                <tr>
                                    <td>MC-{{$v->id}}</td>
                                    <td>{{$v->loaiship->loai_ship}}</td>
                                    <td>{{$v->user->name}}</td>
                                    <td>{{$v->ho_ten}}</td>
                                    <td>{{$v->so_dt}}</td>
                                    <td>{{$v->ten_may}}</td>
                                    <td><a href="http://www.vnpost.vn/vi-vn/dinh-vi/buu-pham?key={{$v->ma_vd}}" target="_blank">{{$v->ma_vd}}</a></td>
                                    <td>
                                        <?php $sotien = $v->so_tien;
                                        echo number_format(($sotien), 0, ",", ".") . ' đ'?>
                                    </td>
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
                                    <td><a class="fancybox fancybox.iframe material-icons text-success "
                                           href="{{ asset('') }}donhang/{{$v->id}}">remove_red_eye</a></td>
                                </tr>

                            @endforeach
                        @endif

                        </tbody>
                    </table>
                {{ $report->appends($_GET)->links() }}
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