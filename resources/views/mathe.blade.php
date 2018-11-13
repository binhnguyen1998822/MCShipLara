@extends('layouts.header')
@section('content')
<script>
    $(document).ready(function () {
        document.getElementById("barmathe").className = "active";
    });
</script>
<script>
$(document).ready(function() {
        $(document).on("click", ".check12", function () {
            var ida = $(this).parent().attr('id');
            var url = ''; 
            if ($(this).prop('checked') == true) {
				url = 'mathe/status/true';
            }
            else if ($(this).prop('checked') == false) {
				url = 'mathe/status/false';
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
<?php $user = Auth::user();?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card card-nav-tabs">
              <div class="table-responsive">
                    <table class="table">
                        <thead class="text-warning">
						<th width="5%">STT</th>
                        <th>Tên khách hàng</th>
                        <th>Số điện thoại</th>
						<th>Mã thẻ</th>
						<th>Seri</th>
						<th>Ghi chú</th>
						@if($user->super == 1)<th>Đã nạp</th>@endif
						<th>Edit</th>
                        </thead>
							@foreach($mathe as $v)
                        <tbody>
							<td>{{$v->id}}</td>
							<td>@if($user->super == 1){{$v->ten_user}} 
							@else
							{{$v->ho_ten}}@endif</td>
							<td>{{$v->so_dt}}</td>
							<td>{{$v->ma_the}}</td>							
							<td>{{$v->ma_seri}}</td>
							<td>{{$v->mt_note}}</td>							
							@if($user->super == 1)<td>
													<div class="checkbox">
														<label id="{{$v->id}}">
															<input type="checkbox" id="check{{$v->id}}" <?php echo $v->is_mathe == 3 ? "checked" : '' ?> class="check12">
														</label>
													</div></td>@endif
							<td><a class="material-icons " href="{{ asset('') }}mathe/{{$v->id}}">edit</a></td>
						
                        </tbody>
							@endforeach
                    </table>
					 </div>
     {{ $mathe->appends($_GET)->links() }}
            </div>
        </div>
    </div>
</div >
@endsection