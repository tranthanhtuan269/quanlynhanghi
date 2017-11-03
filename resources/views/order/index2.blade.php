@extends('layouts.app')

@section('content')
	<script src="{{ url('/') }}/public/highcharts/highcharts.js"></script>
    <script src="{{ url('/') }}/public/highcharts/modules/exporting.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
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
	  					<div class="row" id="order-list">
	  						<table class="table table-striped">
	  							<tr>
									<td class="text-center" width="10%">Ngày</td>
									<td class="text-right" width="90%">Tổng thu</td>
									<td class="text-center"></td>
								</tr>
							@for($y = 0; $y < count($XList); $y++ )
								<tr>
									<td class="text-center">{{ $XList[$y] }}</td>
									<td class="text-right"><span class="coin" style="color:blue; font-size: 18px;">{{ $YList[$y] }}</span> vnđ</td>
									<td class="text-center"></td>
								</tr>
							@endfor
							</table>
	  					</div>
					</div>
			    </div>
			    <div role="tabpanel" class="tab-pane" id="chart">
			    	<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
					<script type="text/javascript">
						var date = new Date();
						var XCat = new Array();
						var YCat = new Array();
						var $tempX = "{{ json_encode($XList) }}"; 
						var $tempY = "{{ json_encode($YList) }}"; 

						var resX = $tempX.split("[&quot;");
						var resX1 = resX[1].split("&quot;]");
						var resX2 = resX1[0].split("&quot;,&quot;");
						console.log(resX2);

						var resY = $tempY.split("[");
						var resY1 = resY[1].split("]");
						var resY2 = resY1[0].split(",").map(function(item) {
						    return parseInt(item, 10) / 1000;
						});
						console.log(resY2);

						Highcharts.chart('container', {
			                chart: {
			                    type: 'column'
			                },
			                title: {
			                    text: 'Thống kê thu nhập 30 ngày'
			                },
			                xAxis: {
			                    categories: resX2
			                },
			                yAxis: {
			                    min: 0,
			                    title: {
			                        text: ''
			                    },
			                    labels: {
							        formatter: function() {
							            return this.value + ' K';
							        }
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
			                    name: 'Tổng thu nhập',
			                    data: resY2
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