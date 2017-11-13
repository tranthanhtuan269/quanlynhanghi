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
	  							<thead>
		  							<tr>
										<td class="text-center" width="10%">Ngày</td>
										<td class="text-right" width="90%">Tổng thu: <span class="coin" style="color:blue; font-size: 18px;">{{ $total }}</span> vnđ</td>
										<td class="text-center"></td>
									</tr>
								</thead>
								<tbody>
								@for($y = count($XList) - 1; $y > 0 ; $y-- )
									<tr data-date="{{ $XList[$y] }}">
										<td class="text-center">{{ $XList[$y] }}</td>
										<td class="text-right"><span class="coin" style="color:blue; font-size: 18px;">{{ $YList[$y] }}</span> vnđ</td>
										<td class="text-center"></td>
									</tr>
								@endfor
								</tbody>
								<tfoot>
								  	<tr>
								     	<td class="text-center" width="10%">Tổng thu: </td>
								     	<td class="text-right" width="90%"><span class="coin" style="color:blue; font-size: 18px;">{{ $total }}</span> vnđ</td>
								     	<td class="text-center"></td>
								  	</tr>
								</tfoot>
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

						var resY = $tempY.split("[");
						var resY1 = resY[1].split("]");
						var resY2 = resY1[0].split(",").map(function(item) {
						    return parseInt(item, 10) / 1000;
						});

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

	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Chi tiết giao dịch ngày <span class="date-detail">01/01/2018</span></h4>
	      </div>
	      <div class="modal-body" id="order-detail">
	        <div class="row">
	        	<div class="col-md-1">1</div>
	        	<div class="col-md-5">2017-10-16 00:27:43</div>
	        	<div class="col-md-3">Phòng 101</div>
	        	<div class="col-md-3">80000</div>
	        </div>
	        <div class="row">
	        	<div class="col-md-1">1</div>
	        	<div class="col-md-5">2017-10-16 00:27:43</div>
	        	<div class="col-md-3">Phòng 101</div>
	        	<div class="col-md-3">80000</div>
	        </div>
	        <div class="row">
	        	<div class="col-md-1">1</div>
	        	<div class="col-md-5">2017-10-16 00:27:43</div>
	        	<div class="col-md-3">Phòng 101</div>
	        	<div class="col-md-3">80000</div>
	        </div>
	        <div class="row">
	        	<div class="col-md-1">1</div>
	        	<div class="col-md-5">2017-10-16 00:27:43</div>
	        	<div class="col-md-3">Phòng 101</div>
	        	<div class="col-md-3">80000</div>
	        </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng lại</button>
	      </div>
	    </div>
	  </div>
	</div>

	<script type="text/javascript">
		$(document).ready(function(){
			$('.coin').each(function( index ) {
			  	$( this ).text(Number($( this ).text()).toLocaleString('en'));
			});

			$('tbody>tr').click(function(){
				var date_selected = $(this).attr('data-date');
				$('.date-detail').html(date_selected);

				$('#loading').show();

				var get_detail_order_by_date = $.ajax({
			  		headers: {
				        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				    },
					url: "{{ url('/') }}/getdetailbydate",
					method: "GET",
					data: 
					{ 
						'date_selected' : date_selected
					},
					dataType: "json"
				});
				 
				get_detail_order_by_date.done(function( msg ) {
					$('#loading').hide();
				  	if(msg.code == 200){
					  	var $html = "";
					  	var $i = 0;
				  		$(msg.order_list).each(function( index ) {
				  			$i++;
							$html += '<div class="row">';
					        	$html += '<div class="col-md-1">'+$i+'</div>';
					        	$html += '<div class="col-md-5"><span class="order-time">'+changeStyleTimer($(this)[0].created_at)+'</div>';
					        	$html += '<div class="col-md-3"><span class="room-name">'+$(this)[0].room_name+'</span></div>';
					        	$html += '<div class="col-md-3"><span class="price_order">'+Number($(this)[0].price_order).toLocaleString('en')+' VNĐ</span></div>';
					        $html += '</div>';
						});
						$('#order-detail').html($html);
				  	}else{
				  		swal("Cảnh báo", "Đã có lỗi khi lấy dữ liệu cũ!", "error");
				  	}
				});
				 
				get_detail_order_by_date.fail(function( jqXHR, textStatus ) {
					$('#loading').hide();
				  	swal("Cảnh báo", "Request failed: " + textStatus, "error");
				});

				$('#myModal').modal('show');
			});
		});

		function changeStyleTimer($string){			
			return $string.replace( /(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})/, "$4 giờ  $5 phút");
		}
	</script>
@endsection