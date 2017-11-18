@extends('layouts.app')

@section('content')
<script src="{{ url('/') }}/public/highcharts/highcharts.js"></script>
<script src="{{ url('/') }}/public/highcharts/modules/exporting.js"></script>
<div class="row">
	<div class="col-md-12">
		<div class="content-box-header">
			<div class="panel-title">Quản lý dịch vụ</div>
			<div class="panel-options">
				<a href="#" data-rel="add" data-toggle="modal" data-target="#add-new"><i class="glyphicon glyphicon-plus"></i></a>
				<a href="#list" aria-controls="list" role="tab" data-toggle="tab"><i class="glyphicon glyphicon-list"></i></a>
				<a href="#chart" aria-controls="chart" role="tab" data-toggle="tab"><i class="glyphicon glyphicon-signal"></i></a>
			</div>
			</div>
			<div class="tab-content">
		    <div role="tabpanel" class="tab-pane active" id="list">
	  			<div class="content-box-large box-with-header">
	  				@if(count($services) <= 0)
	  					Chưa có dịch vụ nào được đăng ký!
	  				@else
	  					<div class="row" id="service-list">
							@foreach ($services as $service)
								<div class="col-md-3">
									<div class="thumbnail product-item state-ok" data-rel="edit" data-toggle="modal" data-target="#edit" data-id="{{$service->id}}">
										<span class="service-name"> {{$service->name}} </span>
										<span class="service-number"> {{$service->number}} </span>
						    		</div>
								</div>
							@endforeach
	  					</div>
	  				@endif
				</div>
			</div>
			<div role="tabpanel" class="tab-pane" id="chart">
		    	<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
				<script type="text/javascript">
					var date = new Date();
					var XCat = new Array();
					var YCat = new Array();
					var $tempX = "{{ json_encode($XList) }}"; 
					var $tempY = "{{ $YList }}"; 

					var dataa = JSON.parse($tempY.replace(/&quot;/g,'"'));
					$.each( dataa, function( key, value ) {
						var datab = new Array();
						$.each( $(this)[0].data, function( key, value ) {
							datab.push(parseInt(value));
						});

						var obj = {};
						obj.name = $(this)[0].name;
						obj.data = datab;
					  	YCat.push(obj);
					});

					var resX = $tempX.split("[&quot;");
					var resX1 = resX[1].split("&quot;]");
					var resX2 = resX1[0].split("&quot;,&quot;");


				    Highcharts.chart('container', {
				        chart: {
				            type: 'column'
				        },
				        title: {
				            text: 'Lịch sử bán dịch vụ 30 ngày mới nhất'
				        },
				        xAxis: {
				            categories: resX2
				        },
				        yAxis: {
				            min: 0,
				            title: {
				                text: 'Số lượng bán được'
				            },
				            stackLabels: {
				                enabled: true,
				                style: {
				                    fontWeight: 'bold',
				                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
				                }
				            }
				        },
				        legend: {
				            align: 'right',
				            x: -15,
				            verticalAlign: 'top',
				            y: 25,
				            floating: true,
				            backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
				            borderColor: '#CCC',
				            borderWidth: 1,
				            shadow: false
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
				        series: YCat
				    });
				</script>
			</div>
	    </div>
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="add-new" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Thêm dịch vụ</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" role="form">
		  <div class="form-group">
		    <label for="name_txt" class="col-sm-3 control-label">Tên</label>
		    <div class="col-sm-9">
		      <input type="text" class="form-control" id="name_txt" placeholder="Tên dịch vụ">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="price_txt" class="col-sm-3 control-label">Giá</label>
		    <div class="col-sm-9">
		      <input type="text" class="form-control" id="price_txt" placeholder="Giá dịch vụ">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="number_txt" class="col-sm-3 control-label">Số lượng còn lại</label>
		    <div class="col-sm-9">
		      <input type="text" class="form-control" id="number_txt" placeholder="Số lượng còn lại">
		    </div>
		  </div>
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Hủy bỏ</button>
        <button type="button" class="btn btn-primary" id="add-service">Lưu lại</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Sửa dịch vụ</h4>
        <input type="hidden" name="id-service" value="">
      </div>
      <div class="modal-body">
        <form class="form-horizontal" role="form">
		  <div class="form-group">
		    <label for="edit_name_txt" class="col-sm-3 control-label">Tên</label>
		    <div class="col-sm-9">
		      <input type="text" class="form-control" id="edit_name_txt" placeholder="Tên dịch vụ">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="edit_price_txt" class="col-sm-3 control-label">Giá</label>
		    <div class="col-sm-9">
		      <input type="text" class="form-control" id="edit_price_txt" placeholder="Giá dịch vụ">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="edit_number_txt" class="col-sm-3 control-label">Số lượng còn lại</label>
		    <div class="col-sm-9">
		      <input type="text" class="form-control" id="edit_number_txt" placeholder="Số lượng còn lại">
		    </div>
		  </div>
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Hủy bỏ</button>
        <button type="button" class="btn btn-primary" id="edit-service">Lưu lại</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
	// page service_type
	$(document).ready(function(){

		$('#edit').on('show.bs.modal', function (e) {
			var $invoker = $(e.relatedTarget);
			var id = $invoker.attr('data-id');
			$('input[name="id-service"]').val(id);
			$('#loading').show();

			var request_get_info_type = $.ajax({
		  		headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
				url: "{{ url('/') }}" + "/getserviceinfo",
				method: "GET",
				data: { id : id },
				dataType: "json"
			});
			 
			request_get_info_type.done(function( msg ) {
				$('#loading').hide();
			  	if(msg.code == 200){
				  	var service = msg.service;
				  	$('#edit_name_txt').val(service.name);
				  	$('#edit_price_txt').val(service.price);
				  	$('#edit_number_txt').val(service.number);
				}
			});
			 
			request_get_info_type.fail(function( jqXHR, textStatus ) {
				$('#loading').hide();
			  	alert( "Request failed: " + textStatus );
			});
		});

		$('#edit-service').click(function(){
			// get info of service
			var edit_service_id 		= $('input[name="id-service"]').val();
			var edit_service_name 		= $('#edit_name_txt').val();
			var edit_service_price	 	= $('#edit_price_txt').val();
			var edit_service_number 	= $('#edit_number_txt').val();

			$('#loading').show();

			var request_edit_service_type = $.ajax({
		  		headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
				url: "{{ url('/') }}/service/" + edit_service_id,
				method: "PUT",
				data: 
				{
					'service_id' 			: edit_service_id,
					'service_name' 			: edit_service_name,
					'service_price' 		: edit_service_price,
					'service_number' 		: edit_service_number
				},
				dataType: "json"
			});
			 
			request_edit_service_type.done(function( msg ) {
				$('#loading').hide();
			  	if(msg.code == 200){
				  	swal({	
				  		title: 	"Thông báo", 
				  		text: 	"Dịch vụ đã được sửa thành công!", 
				  		type: 	"success"
				  	},
				  	function(){
					    location.reload();
					});
				  	$('#edit').modal('toggle');
				  }else{
				  	swal("Cảnh báo", "Đã có lỗi khi sửa dịch vụ!", "error");
				  }
			});
			 
			request_edit_service_type.fail(function( jqXHR, textStatus ) {
				$('#loading').hide();
			  	alert( "Request failed: " + textStatus );
			});
		});

		$('#add-service').click(function(){
			// get info of service
			var service_name 		= $('#name_txt').val();
			var service_price	 	= $('#price_txt').val();
			var service_number 		= $('#number_txt').val();

			$('#loading').show();

			var request_add_service_type = $.ajax({
		  		headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
				url: "{{ url('/') }}/service",
				method: "POST",
				data: 
				{ 
					'service_name' 		: service_name,
					'service_price' 	: service_price,
					'service_number' 	: service_number
				},
				dataType: "json"
			});
			 
			request_add_service_type.done(function( msg ) {
				$('#loading').hide();
			  	if(msg.code == 200){
				  	swal({	
				  		title: 	"Thông báo", 
				  		text: 	"Dịch vụ đã được tạo thành công!", 
				  		type: 	"success"
				  	},
				  	function(){
					    location.reload();
					});
				  	$('#add-new').modal('toggle');
				  }else{
				  	swal("Cảnh báo", "Đã có lỗi khi tạo một dịch vụ mới!", "error");
				  }
			});
			 
			request_add_service_type.fail(function( jqXHR, textStatus ) {
				$('#loading').hide();
			  	alert( "Request failed: " + textStatus );
			});
		});
	});
</script>
@endsection