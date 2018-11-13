@extends('layouts.app')
@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12 col-md-12">
			<div class="card card-nav-tabs">
				
						
									
									<table class="table">
										<table class="table">
										<thead class="text-warning">
											<th>Người sửa</th>
											<th>Khách hàng</th>
											<th>SDT</th>
											<th>Tên máy</th>
											<th>Số tiền</th>
											<th>Mã vận đơn</th>
											<th>Trạng thái</th>
											<th>Giờ thay đổi</th>
	
										</thead>
										<tbody>
										@if($history->count())
											@foreach($history as $v)
											<tr>
												<td>{{$v->user->name}}</td>
	
												<td>{{$v->ho_ten}}</td>
												<td>{{$v->so_dt}}</td>
												<td>{{$v->ten_may}}</td>
												<td>
												<?php $sotien= $v->so_tien;
												echo number_format(($sotien),0,",",".") ." đ"?> 
												</td>
												<td>{{$v->ma_vd}}</td>
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
												<span class="label label-info">{{"Gửi VNPost"}}</span>
												@endif											
												</td>
												<td>{{$v->created_at}}</td>
											
											</tr>
										@endforeach
										@endif	
										</tbody>										
									</table>
									
					
						</div>

						</div>
					</div>
	</div>
@endsection