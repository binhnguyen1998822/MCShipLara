@extends('layouts.header')
@section('dashboard')
	<div class="container-fluid">
		<div class="header-body">
			<!-- Card stats -->
			<div class="row">
				<div class="col-xl-3 col-lg-6">
					<div class="card card-stats mb-4 mb-xl-0">
						<div class="card-body">
							<div class="row">
								<div class="col">
									<h5 class="card-title text-uppercase text-muted mb-0">Hoa Hồng</h5>
									<span class="h2 font-weight-bold mb-0">{{number_format($tln)}}</span>
								</div>
								<div class="col-auto">
									<div class="icon icon-shape bg-warning text-white rounded-circle shadow">
										<i class="fas fa-chart-pie"></i>
									</div>
								</div>
							</div>
							<p class="mt-3 mb-0 text-muted text-sm" style="font-weight: bold;">
								<span class="text-success mr-2"> VND</span>
							</p>
						</div>
					</div>
				</div>

				<div class="col-xl-3 col-lg-6">
					<div class="card card-stats mb-4 mb-xl-0">
						<div class="card-body">
							<div class="row">
								<div class="col">
									<h5 class="card-title text-uppercase text-muted mb-0">Tổng đơn hàng</h5>
									<span class="h2 font-weight-bold mb-0">{{$tongmay}}</span>
								</div>
								<div class="col-auto">
									<div class="icon icon-shape bg-warning text-white rounded-circle shadow">
										<i class="fas fa-chart-pie"></i>
									</div>
								</div>
							</div>
							<p class="mt-3 mb-0 text-muted text-sm" style="font-weight: bold;">
								<span class="text-success mr-2"> Đơn hàng</span>
							</p>
						</div>
					</div>
				</div>

				<div class="col-xl-3 col-lg-6">
					<div class="card card-stats mb-4 mb-xl-0">
						<div class="card-body">
							<div class="row">
								<div class="col">
									<h5 class="card-title text-uppercase text-muted mb-0">Bảo hành vàng</h5>
									<span class="h2 font-weight-bold mb-0">{{$coundabhv}}</span>
								</div>
								<div class="col-auto">
									<div class="icon icon-shape bg-danger text-white rounded-circle shadow">
										<i class="ni ni-money-coins"></i>
									</div>
								</div>
							</div>
							<p class="mt-3 mb-0 text-muted text-sm" style="font-weight: bold;">
								<span class="text-success mr-2">Đơn hàng</span>
							</p>
						</div>
					</div>
				</div>

				<div class="col-xl-3 col-lg-6">
					<div class="card card-stats mb-4 mb-xl-0">
						<div class="card-body">
							<div class="row">
								<div class="col">
									<h5 class="card-title text-uppercase text-muted mb-0">Combo</h5>
									<span class="h2 font-weight-bold mb-0">{{$coundpk}}
                                    </span>
								</div>
								<div class="col-auto">
									<div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
										<i class="fas fa-users"></i>
									</div>
								</div>
							</div>
							<p class="mt-3 mb-0 text-muted text-sm" style="font-weight: bold;">
								<span class="text-success mr-2">đơn hàng</span>
								<span class="text-nowrap"></span>
							</p>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>

@endsection
@section('content')
	<div class="container-fluid mt--7">
		<div class="row" style="padding-bottom: 10px">
			<div class="col-xl-6 col-lg-6">
				<div class="card shadow">
					<div id="loaiship" style="min-width:310px; height:300px;"></div>
				</div>
			</div>
			<div class="col-xl-6 col-lg-6">
				<div class="card shadow">
					<div id="coso" style="min-width:310px; height:300px;"></div>
				</div>
			</div>
		</div>
		<!-- Table -->
		<div class="row">
			<div class="col">
				<div class="card shadow">
					<div class="card-header border-0">
						<h3 class="mb-0">Đơn hàng</h3>
					</div>
					<div class="table-responsive">
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
		</div>


		<script src="{{ asset('js/highcharts.js') }}"></script>
		<script type="text/javascript">
            Highcharts.chart('loaiship', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: 'Loại ship'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                            style: {
                                color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                            }
                        }
                    }
                },
                series: [{
                    name: 'Tỉ lệ',
                    colorByPoint: true,
                    data: [{
                        name: 'Ship COD :',
                        y: {{$chartcountdh['coundshipcod']}}
                    }, {
                        name: 'Ship Xa',
                        y: {{$chartcountdh['coundshipxa']}}
                    }, {
                        name: 'Nội thành',
                        y: {{$chartcountdh['coundshipnt']}}
                    }]
                }]
            });
            Highcharts.chart('coso', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: 'Cơ sở'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                            style: {
                                color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                            }
                        }
                    }
                },
                series: [{
                    name: 'Tỉ lệ',
                    colorByPoint: true,
                    data: [
					@foreach($coundcoso as $v)
                        {name: '{{ $v->co_so}}',
                        y: {{ $v->socoso}}
                    },@endforeach]
                }]
            });
		</script>

@endsection