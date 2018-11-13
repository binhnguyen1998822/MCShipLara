@extends('layouts.header')
@section('content')
<?php $user = Auth::user();?>
@if($user->role == 'SuperAdmin')
<form action="{{ url('phoahong') }}" method="POST" enctype="multipart/form-data" onsubmit="return checkForm(this);">
{{ csrf_field() }}	
<div class="row">	
						<div class="col-md-12">			
                            <div class="card">
                                <div class="card-header" data-background-color="green" style="background:#0fb0c0">
								<div class="status pull-right" >
									<button type="submit" class="btn btn-primary btn-fab btn-round">
										<i class="material-icons">favorite</i>
									<div class="ripple-container"></div></button>
                                    </div>
                                    <h4 class="title">Hoa Hồng</h4>
                                    <p class="category">Tính hoa hồng</p>
									
                                </div>
                                <div class="card-content"> 
								@foreach($hoahong as $v)
									 <div class="row">
												<div class="col-md-12">
													<div class="form-group label-floating">
														<strong class="control-label">Bảo hành vàng</strong>
														<input type="text" name="hh_bhv" id="hh_bhv" value="{{$v->hh_bhv}}" autocomplete="off" class="form-control" >
													</div>
												</div>
									</div>
									 <div class="row">
												<div class="col-md-12">
													<div class="form-group label-floating">
														<strong class="control-label">Bảo hành thường</strong>
														<input type="text" name="hh_mayban" id="hh_mayban" value="{{$v->hh_mayban}}" autocomplete="off" class="form-control" >
													</div>
												</div>
									</div>
									 <div class="row">
												<div class="col-md-12">
													<div class="form-group label-floating">
														<strong class="control-label">Phụ kiện</strong>
														<input type="text" name="hh_phukien" id="hh_phukien" value="{{$v->hh_phukien}}" autocomplete="off" class="form-control" >
													</div>
												</div>
									</div>
								@endforeach
								</div>
							</div>
						</div>		
</div>                                
</form>                                
@endif
@endsection