@extends('layouts.header')
@section('content')
    <div class="container-fluid mt--7">
        <!-- Table -->
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <h3 class="mb-0">Báo cáo</h3>
                        <div class="float-right">
                            @if(Auth::user()->role !== 'Nhap')
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#myModal">
                                Nhập
                            </button>
                            @endif
                            <a href="{{ url('export')}}?datefilter=<?php echo $datefilter ?>" class="btn btn-success float-right">Xuất</a>
                        </div>
                    </div>
                    <div class="table-responsive">
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
                                        <td><a href="{{ asset('') }}donhang/{{$v->id}}"><i
                                                        class="fas fa-ellipsis-v"></i></a></td>
                                    </tr>

                                @endforeach
                            @endif

                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        <nav aria-label="...">
                            <ul class="pagination justify-content-end mb-0">
                                {{ $report->appends($_GET)->links( "pagination::bootstrap-4") }}
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