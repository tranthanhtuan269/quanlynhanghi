@extends('layouts.app')

@section('content')
	<script src="{{ url('/') }}/highcharts/highcharts.js"></script>
    <script src="{{ url('/') }}/highcharts/modules/exporting.js"></script>
	<div class="row">
		<div class="col-md-12">
			<div class="content-box-header">
				<div class="panel-title">Quản lý giao dịch</div>
				<div class="panel-options">
					<a href="#list" aria-controls="list" role="tab" data-toggle="tab"><i class="glyphicon glyphicon-signal"></i></a>
					<a href="#chart" aria-controls="chart" role="tab" data-toggle="tab"><i class="glyphicon glyphicon-list"></i></a>
				</div>
  			</div>
  			<!-- Tab panes -->
			<div class="tab-content">
			    <div role="tabpanel" class="tab-pane active" id="list">
			    	<div class="content-box-large box-with-header">
		  				@if(count($order_list) <= 0)
		  					Chưa có giao dịch nào được ghi nhận!
		  				@else
		  					<div class="row" id="order-list">
		  						<table class="table table-striped">
		  							<tr>
										<td>#</td>
										<td class="text-center">Ngày</td>
										<td class="text-right">Tổng thu</td>
										<td class="text-center"></td>
									</tr>
								@foreach ($order_list as $order)
									<tr>
										<td>#</td>
										<td class="text-center">{{date_format(new DateTime($order->order_date), 'd-m-Y')}}</td>
										<td class="text-right"><span class="coin">{{$order->order_price}}</span></td>
										<td class="text-center"></td>
									</tr>
								@endforeach
								</table>
		  					</div>
		  				@endif
					</div>
			    </div>
			    <div role="tabpanel" class="tab-pane" id="chart">
			    	<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
					<script type="text/javascript">
			            Highcharts.chart('container', {
			                chart: {
			                    type: 'column'
			                },
			                title: {
			                    text: 'Thu nhập tháng 9'
			                },
			                xAxis: {
			                    categories: ['Apples', 'Oranges', 'Pears', 'Grapes', 'Bananas']
			                },
			                yAxis: {
			                    min: 0,
			                    title: {
			                        text: ''
			                    },
			                    stackLabels: {
			                        enabled: true,
			                        style: {
			                            fontWeight: 'bold',
			                            color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
			                        }
			                    }
			                },
			                tooltip: {
			                    headerFormat: '<b>{point.x}</b><br/>',
			                    pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
			                },
			                plotOptions: {
			                    column: {
			                        stacking: 'normal',
			                        dataLabels: {
			                            enabled: true,
			                            color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
			                        }
			                    }
			                },
			                series: [{
			                    name: 'Pessi',
			                    data: [5, 3, 4, 35, 2]
			                }, {
			                    name: 'Coca',
			                    data: [2, 2, 3, 2, 1]
			                }, {
			                    name: 'Lavie',
			                    data: [3, 4, 4, 2, 5]
			                }, {
			                    name: 'Sting',
			                    data: [3, 4, 4, 2, 5]
			                }]
			            });
					</script>
			    </div>
			</div>
  			
		</div>
	</div>

	<script type="text/javascript">
		$(document).ready(function(){
			$('.coin').each(function( index ) {
			  	$( this ).text(Number($( this ).text()).toLocaleString('en'));
			});
		});
	</script>
@endsection