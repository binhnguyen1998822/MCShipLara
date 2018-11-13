@extends('layouts.header')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="card card-profile">
				<div class="card-avatar">
					<p>
						<img class="img" src="{{ url('assets/img/favicon.png') }}" />
					</p>
				</div>
				<div class="content">

					<h4 class="card-title">{{ Auth::user()->name }}</h4>
					<strong><h6 style="color:red" class="card-title">Hoa hồng   : <?php echo number_format($tln) .' VND' ?></strong></h6> 
					<h3 class="card-title"><?php echo $datefilter ?></h3>
				</div>
				<div class="col-md-6" >
						
						<strong><h6 class="card-title">Tổng máy : <?php echo $tongmay ?> || <?php echo number_format($tm) .' VND' ?></strong> </h6>
						<h6 class="card-title">Bảo hành vàng   : <?php echo $coundabhv ?> || <?php echo number_format($mbhv) .' VND' ?></h6>
						<h6 class="card-title">Combo   : <?php echo $coundpk ?> || <?php echo number_format($lnpk) .' VND' ?></h6>
						<h6 class="card-title">Tổng Ship Nội Thành   : <?php echo $coundshipnt ?></h6>
						<h6 class="card-title">Tổng Ship COD   : <?php echo $coundshipcod ?></h6>
						<h6 class="card-title">Tổng Ship Xa   : <?php echo $coundshipxa ?></h6>
						
					</div>
					<div class="col-md-6" >
					<strong><h6 class="card-title">Cơ sở nhận máy</strong> </h6>
						@foreach($coundcoso as $v)
								<h6 class="card-title">{{ $v->co_so}} : {{ $v->socoso}}</h6>
						@endforeach
					</div>
					
			</div>
			
		</div>
	</div>
	<div class="row">
		<div class="col-md-6 card" >
			<table class="table">

				<thead class="text-warning">
				<th>Loại Ship</th>
				<th>Tên máy</th>
				<th>Bảo hành</th>
				<th>Màu sắc</th>
				<th>Số lượng</th>
				</thead>
				<tbody>
				@foreach($thongke as $data)
						<tr>
							<td>{{ $data->loaiship->loai_ship}}</td>
							<td>{{ $data->ten_may}} - {{ $data->sp_dungluong}} ROM - {{ $data->ram}} RAM</td>
							<td>{{ $data->baohanh->loai_bh}}</td>
							<td>{{ $data->sp_color}}</td>
							<td>{{ $data->soluong}}</td>
						</tr>
				</tbody>
				@endforeach
			</table>
		</div>
	</div>
</div>	
@endsection