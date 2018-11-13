@extends('layouts.header')
@section('content')
<link rel="stylesheet" href="css/on-off.css" type="text/css">
<?php $user = Auth::user();?>
<script>
    $(document).ready(function () {
        document.getElementById("bardonship").className = "active";
    });
</script>

	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12 col-md-12">
			<div class="card card-nav-tabs">
				<div class="card-content">
					<div class="tab-content">
						 
						<div class="tab-pane active" id="messages">						
									<table class="table">
										<table class="table">
										<thead class="text-warning">
											<th>Tên Shipper</th>
											<th>Số đơn</th>
											<th>Thu nhập</th>
										</thead>
										<tbody>
											@if($donship->count())
											@foreach($donship	 as $v)
											<tr>
												<td>{{$v->shipper->sp_name}}</td>
												<td>{{$v->sodon}}</td>
												<td style="color:red" ><strong><?php 
													$sodon =$v->sodon;
													$thunhap =$sodon*10000;
													echo number_format($thunhap) .' đ' ?></strong></td>
											</tr>
											@endforeach
											@endif
										</tbody>
									
					
										
									</table>
						</div>

						</div>
					</div>
	</div>
</div>
</div>
</div>
@endsection