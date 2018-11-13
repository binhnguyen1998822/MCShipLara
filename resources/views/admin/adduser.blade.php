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
											<th>Quyền</th>
											<th>Nhóm</th>
											<th>Xóa</th>
										</thead>
										<tbody>
											@if($adduser->count())
											@foreach($adduser as $v)
											<tr>
												<td>{{$v->id}}</td>
											
												<td>{{$v->name}}</td>
												<td>{{$v->email}}</td>
												<td>	
												@if($v->role == 'SuperAdmin')
												{{"SuperAdmin"}}
												@elseif($v->role == 'Nhap' )
												{{"Nhập đơn"}}
												@elseif($v->role == 'Kho' )
												{{"Quản kho"}}
												@endif</td>
												<td>{{$v->nhom}}</td>
												<td><a href="adduser/{{$v->id}}"  onclick="return confirm('Bạn muốn xóa?');"><i class="material-icons">close</i></a>
												
 
											</tr>
											@endforeach
											@endif
										</tbody>
										
									</table>
						</div>
						<div class="tab-pane" id="settings">
							    <div class="row">

                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Tên</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Email</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
					
                        <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                            <label for="role" class="col-md-4 control-label">Quyền</label>

                            <div class="col-md-6">
                             
										<select class="form-control" type="role" id="role" name="role" required>
											<option value="Nhap">Nhập đơn</option>
											<option value="Kho">Quản kho</option>
											<option value="SuperAdmin">SuperAdmin</option>
										</select>

                                @if ($errors->has('role'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('role') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>					
                        <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                            <label for="role" class="col-md-4 control-label">Nhóm</label>

                            <div class="col-md-6">
                             
										<select class="form-control" type="role" id="nhom" name="nhom">
											<option value="Admin">Admin</option>
											<option value="Facebook">Facebook</option>
											<option value="Hotline">Hotline</option>
											<option value="LeTan">LeTan</option>
										</select>

                                @if ($errors->has('nhom'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nhom') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>					
						
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Mật khẩu</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Nhập lại mật khẩu</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Thêm tài khoản
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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