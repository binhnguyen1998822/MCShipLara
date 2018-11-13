@extends('layouts.header')
@section('content')
<?php $user = Auth::user();?>
@if($user->role == 'SuperAdmin')
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12 col-md-12">
			<div class="card card-nav-tabs">
				<div class="card-header" data-background-color="purple">
					<div class="nav-tabs-navigation">
						<div class="nav-tabs-wrapper">
						  
							<ul class="nav nav-tabs" data-tabs="tabs">
								
								<li class="">
									<a href="#messages" data-toggle="tab">
										<i class="material-icons">list</i>Màu sắc
										<div class="ripple-container"></div>
									</a>
								</li>
								<li class="">
									<a href="#settings" data-toggle="tab">
										<i class="material-icons">add</i> Thêm màu
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
							 @if (count($errors) > 0)
								<div class="alert alert-danger">
									<strong>Lỗi</strong> <br><br>
									<ul>
										@foreach ($errors->all() as $error)
											<li>{{ $error }}</li>
										@endforeach
									</ul>
								</div>
							@endif

							@if ($message = Session::get('success'))
							<div class="alert alert-success alert-block">
								<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>{{ $message }}</strong>
							</div>
							@endif						
									<table class="table">
										<table class="table">
										<thead class="text-primary">
											<th>STT</th>
											<th>Màu sắc</th>
											<th>Xóa</th>

										</thead>
										<tbody>
										
											@foreach($color as $v)
											<tr>
												<td>{{$v->id_cl}}</td>
											
												<td>{{$v->ten_color}}</td>
												<td><a href="{{ asset('') }}color/{{$v->id_cl}}" onclick="return confirm('Bạn muốn xóa?');"><i class="material-icons">close</i></a>
											

											</tr>
											@endforeach
									
										</tbody>
										
									</table>
						</div>
						<div class="tab-pane" id="settings">
													<form action="{{ url('pcolor') }}" class="form-image-upload" method="POST" enctype="multipart/form-data">
										{{ csrf_field() }}
								<div class="row">
									<div class="col-md-12">
										<strong>Tên màu</strong>
										<input type="text" name="ten_color" class="form-control" placeholder="Nhập màu sắc">
									</div>								   
								</div>
										<button type="submit" class="btn btn-primary pull-right">Thêm</button>
										<div class="clearfix"></div>
								</form>

</div>
</div>
</div>				
</div>
</div>
</div>
</div>


@endif
@endsection