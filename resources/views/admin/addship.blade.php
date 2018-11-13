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
										<i class="material-icons">list</i> Tài khoản
										<div class="ripple-container"></div>
									</a>
								</li>
								<li class="">
									<a href="#settings" data-toggle="tab">
										<i class="material-icons">add</i> Thêm tài khoản
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
											<th>ID</th>
											<th>Tên</th>
											<th>Tài khoản</th>
											<th>Trạng thái</th>
											<th>Xóa</th>
										</thead>
										<tbody>
											@if($shipper->count())
											@foreach($shipper as $v)
											<tr>
												<td>{{$v->id_sp}}</td>
											
												<td>{{$v->sp_name}}</td>
												<td>{{$v->sp_email}}</td>
												<td>	
												@if($v->sp_online == 0)
												<span class="label label-info">{{"Offline"}}</span>
												@elseif($v->sp_online == 1)
												<span class="label label-success">{{"Online"}}</span>
												@endif</td>
												<td><a href="addship/{{$v->id_sp}}"  onclick="return confirm('Bạn muốn xóa?');"><i class="material-icons">close</i></a>
											
 
											</tr>
											@endforeach
											@endif
										</tbody>
										
									</table>
						</div>
						<div class="tab-pane" id="settings">
							    <div class="row" style="padding:50px">
									<form action="{{ url('addpship') }}" class="form-image-upload" method="POST" enctype="multipart/form-data">
										{{ csrf_field() }}
											<div class="row">
												<div class="col-md-12">
													<strong>Tên Shiper</strong>
													<input type="text" name="sp_name" class="form-control" placeholder="Nhập tên người giao hàng">
												</div>
												<div class="col-md-12">
													<strong>Tài khoản</strong>
													<input type="email" name="sp_email" class="form-control" placeholder="Nhập tài khoản">
												</div>
												<div class="col-md-12">
													<strong>Mật khẩu</strong>
													<input type="password" name="sp_password" class="form-control" placeholder="Nhập Mật khẩu">
												</div>
												<input type="hidden" name="sp_online" value="0" class="form-control" >
												
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
</div>
@endif
@endsection