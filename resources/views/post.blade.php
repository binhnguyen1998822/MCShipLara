@extends('layouts.header')
@section('content')
<link rel="stylesheet" href="css/on-off.css" type="text/css">
<?php $user = Auth::user();?>
<script>
    $(document).ready(function () {
        document.getElementById("barpost").className = "active";
    });
</script>
<script>
$(document).ready(function() {
        $(document).on("click", ".check12", function () {
            var ida = $(this).parent().attr('id');
            var url = ''; 
            if ($(this).prop('checked') == true) {
				url = 'post/status/true';
            }
            else if ($(this).prop('checked') == false) {
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
            }
            else if ($(this).prop('checked') == false) {
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

	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12 col-md-12">
			<div class="card card-nav-tabs">
				<div class="card-content">
					<div class="tab-content">
						 <div class="status pull-left" >
						
					   <button class="btn btn-info">
							<a type="button" data-toggle="dropdown" ><i class="material-icons">filter_list</i></a>
												  <ul class="dropdown-menu" role="menu">
													<li><a style="color:black" href="?loc=6">Đang gửi VNPost</a></li>
													<li><a style="color:black" href="?loc=4">Hoàn thành</a></li><li>
													<li><a style="color:black" href="?loc=5">Đơn bị hủy</a></li>
												  </ul>
					   </button>
					</div>
						<div class="tab-pane active" id="messages">						
									<table class="table">
										<table class="table">
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
												<?php $sotien= $v->so_tien;
												echo number_format(($sotien),0,",","."). ' đ'?> 
												</td>
												<td><a href="http://www.vnpost.vn/vi-vn/dinh-vi/buu-pham?key={{$v->ma_vd}}" target="_blank">{{$v->ma_vd}}</a></td>
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
															<input type="checkbox" id="check{{$v->id}}" <?php echo $v->trang_thai == 4 ? "checked" : '' ?> class="check12">
														</label>
													</div></td>
												<td>
													<div class="checkbox">
														<label id="{{$v->id}}">
															<input type="checkbox" id="check{{$v->id}}" <?php echo $v->trang_thai == 5 ? "checked" : '' ?> class="check11">
														</label>
													</div>
												</td>
												<td><a class="material-icons text-success " href="{{ asset('') }}donhang/{{$v->id}}">remove_red_eye</a></td>
											</tr>
											@endforeach
											@endif
										</tbody>
									
					
										
									</table>
							 {{ $post->appends($_GET)->links() }}
						</div>

						</div>
					</div>
	</div>
</div>
</div>
</div>
@endsection