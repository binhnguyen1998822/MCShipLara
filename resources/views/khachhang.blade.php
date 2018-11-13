@extends('layouts.header')
@section('content')
<script>
    $(document).ready(function () {
        document.getElementById("barkhachhang").className = "active";
    });
</script>
<?php $user = Auth::user();?>
<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12 col-md-12">
			<div class="card card-nav-tabs">
				<div class="card-header" data-background-color="blue" style="background:#0fb0c0">
					<div class="nav-tabs-navigation">
						<div class="nav-tabs-wrapper">
						  
							<ul class="nav nav-tabs" data-tabs="tabs">
								
								<li class="">
									<a href="#messages" data-toggle="tab">
										<i class="material-icons">list</i> Khách gọi
										<div class="ripple-container"></div>
									</a>
								</li>
								<li class="">
									<a href="#settings" data-toggle="tab">
										<i class="material-icons">add</i> Khách đã mua 
										<div class="ripple-container"></div>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="card-content">
					<div class="tab-content">
						
						<div class="tab-pane active" id="messages">			
								<table class="table">
									<thead class="text-warning">
										<th width="2%">STT</th>
										<th width="10%">Số điện thoại</th>
										<th width="10%">Thời gian</th>
										<th>Nội dung</th>
										<th width="5%"></th>
									</thead>
									@foreach($khachhang as $v)
									<tbody>
								
										<td>{{$v->id_kh}}</td>
										<td>{{$v->phone}}</td>
										<td>{{$v->created_at}}</td>													
										<td>{{$v->ghichu}}</td>
										<!-- <td><a class="fancybox fancybox.iframe material-icons " href="{{ asset('') }}khachhang/{{$v->id_kh}}">edit</a></td>-->
									</tbody>
									@endforeach
								</table>
									 {{ $khachhang->appends($_GET)->links() }}
						</div>
						
						
						<div class="tab-pane" id="settings">
									<table class="table">
									<thead class="text-warning">
										<th width="2%">STT</th>
										<th width="10%">Số điện thoại</th>
										<th width="10%">Thời gian</th>
										<th>Thiết bị</th>
										<th>Địa chỉ</th>
									</thead>
									@foreach($khachhangmua as $v)
									<tbody>
								
										<td>{{$v->id_kh}}</td>
										<td>{{$v->phone}}</td>
										<td>{{$v->created_at}}</td>													
										<td>{{$v->ten_may}}</td>
										<td>{{$v->dia_chi}}</td>
										
										<!--<td><a class="fancybox fancybox.iframe material-icons " href="{{ asset('') }}khachhang/{{$v->id_kh}}">edit</a></td>-->
									</tbody>
									@endforeach
								</table>
								{{ $khachhangmua->appends($_GET)->links() }}
											
						</div>
</div>
</div>
</div>
</div>
</div>
</div> 
<script type="text/javascript">
  var path = "{{ route('autocomplete') }}";
$('input.typeahead').typeahead({
	source:  function (query, process) {
	return $.get(path, { query: query }, function (data) {
			return process(data);
		});
	}
});
</script>
<script type="text/javascript">
 $(document).ready(function () {
	$.get("{{URL::to('ajaxRead')}}",function(data){
		$.each(data,function(i,value){
			var tr =$("<tr/>");
				tr.append($("<td/>",{
					text : value.id
				})).append($("<td/>",{
					text : value.phone
				})).append($("<td/>",{
					text : value.created_at
				})).append($("<td/>",{
					text : value.socuoc
				})).append($("<td/>",{
					text : value.ghichu
				}))
				$('#khachhang-info').append(tr);
		})
	})
})

</script>
@endsection