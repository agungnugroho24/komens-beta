@extends('back-office.layouts.master')

@section('title')
 {{ $title }}
@overwrite

@section('panel-header')
  <x-panel-header-dashboard-back-office/>
@endsection

@section('content')

@php

@endphp
				<div class="page-inner mt--5">
					<div class="row mt--2">
						<div class="col-md-12">
							<div class="card full-height">
								<div class="card-body">
									<div class="card-title">Statistik keseluruhan</div>
									<div class="card-category">Informasi harian tentang statistik dalam sistem</div>
									<div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
										<div class="px-2 pb-2 pb-md-0 text-center">
											<div id="circles-1">{{ $data['totalAdmin'] }}</div>
											<div style="width:100px;">
												<h6 class="fw-bold mt-3 mb-0">Total Administrator</h6>
											</div>
										</div>
										<div class="px-2 pb-2 pb-md-0 text-center">
											<div id="circles-2">{{ $data['totalPostBerita'] }}</div>
											<div style="width:100px;">
												<h6 class="fw-bold mt-3 mb-0">Total Post Berita</h6>
											</div>
										</div>
										<div class="px-2 pb-2 pb-md-0 text-center">
											<div id="circles-3">{{ $data['totalPostPanduanTeknis'] }}</div>
											<div style="width:100px;">
												<h6 class="fw-bold mt-3 mb-0">Total Post Panduan Teknis</h6>
											</div>
										</div>
										<div class="px-2 pb-2 pb-md-0 text-center">
											<div id="circles-4">{{ $data['totalPostTipsKeamanan'] }}</div>
											<div style="width:100px;">
												<h6 class="fw-bold mt-3 mb-0">Total Post Tips Keamanan Siber</h6>
											</div>
										</div>	
										<div class="px-2 pb-2 pb-md-0 text-center">
											<div id="circles-5">0</div>
											<div style="width:100px;">
												<h6 class="fw-bold mt-3 mb-0">Total Aduan Siber</h6>
											</div>
										</div>																				
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="card full-height">
								<div class="card-body">
									<div class="card-title">Total post artikel berita tahun @php echo date('Y'); @endphp</div>
									<div class="row py-3">
										<div class="col-md-1 d-flex flex-column justify-content-around">
										</div>
										<div class="col-md-11">
											<div id="chart-container">
												<canvas id="totalIncomeChart"></canvas>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
@endsection

@push('app-script')
	<script>
		Circles.create({
			id:'circles-1',
			radius:45,
			value:60,
			maxValue:100,
			width:7,
			text: $('#circles-1').text(),
			colors:['#f1f1f1', '#0099FF'],
			duration:400,
			wrpClass:'circles-wrp',
			textClass:'circles-text',
			styleWrapper:true,
			styleText:true
		})

		Circles.create({
			id:'circles-2',
			radius:45,
			value:70,
			maxValue:100,
			width:7,
			text: $('#circles-2').text(),
			colors:['#f1f1f1', '#2BB930'],
			duration:400,
			wrpClass:'circles-wrp',
			textClass:'circles-text',
			styleWrapper:true,
			styleText:true
		})

		Circles.create({
			id:'circles-3',
			radius:45,
			value:40,
			maxValue:100,
			width:7,
			text: $('#circles-3').text(),
			colors:['#f1f1f1', '#F25961'],
			duration:400,
			wrpClass:'circles-wrp',
			textClass:'circles-text',
			styleWrapper:true,
			styleText:true
		})

		Circles.create({
			id:'circles-4',
			radius:45,
			value:40,
			maxValue:100,
			width:7,
			text: $('#circles-4').text(),
			colors:['#f1f1f1', '#FF9E27'],
			duration:400,
			wrpClass:'circles-wrp',
			textClass:'circles-text',
			styleWrapper:true,
			styleText:true
		})	

		Circles.create({
			id:'circles-5',
			radius:45,
			value:40,
			maxValue:100,
			width:7,
			text: $('#circles-5').text(),
			colors:['#f1f1f1', '#CC33FF'],
			duration:400,
			wrpClass:'circles-wrp',
			textClass:'circles-text',
			styleWrapper:true,
			styleText:true
		})			

		var totalIncomeChart = document.getElementById('totalIncomeChart').getContext('2d');

		var mytotalIncomeChart = new Chart(totalIncomeChart, {
			type: 'bar',
			data: {
				labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
				datasets : [{
					label: "Total Posting",
					backgroundColor: 'rgb(26, 209, 255)',
					borderColor: 'rgb(255, 153, 0)',
					data:@php $dataBeritaArray= $data['dataArrayStatistikBerita']; echo json_encode($dataBeritaArray); @endphp,
					// data: [6, 4, 9, 5, 4, 6, 4, 3, 8, 10],
				}],
			},
			options: {
				responsive: true,
				maintainAspectRatio: false,
				legend: {
					display: false,
				},
				scales: {
					yAxes: [{
						ticks: {
							display: false //this will remove only the label
						},
						gridLines : {
							drawBorder: false,
							display : false
						}
					}],
					xAxes : [ {
						gridLines : {
							drawBorder: false,
							display : false
						}
					}]
				},
			}
		});

		$('#lineChart').sparkline([105,103,123,100,95,105,115], {
			type: 'line',
			height: '70',
			width: '100%',
			lineWidth: '2',
			lineColor: '#ffa534',
			fillColor: 'rgba(255, 165, 52, .14)'
		});
	</script>
@endpush

