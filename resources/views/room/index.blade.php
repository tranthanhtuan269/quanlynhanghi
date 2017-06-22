@extends('layouts.app')

@section('content')
	
		<div class="row">
			<div class="col-md-12">
				<div class="content-box-header">
					<div class="panel-title">Quản lý phòng</div>
					<div class="panel-options">
						<a href="#" data-rel="add" data-toggle="modal" data-target="#add-new"><i class="glyphicon glyphicon-plus"></i></a>
						<a href="#" data-rel="reload"><i class="glyphicon glyphicon-refresh"></i></a>
					</div>
	  			</div>
	  			<div class="content-box-large box-with-header">
	  				@if(count($rooms) <= 0)
	  					Không có phòng nào ở đây
	  				@else
	  					<div class="row">
							@foreach ($rooms as $room)
								<div class="col-md-3">
									<div class="thumbnail product-item" data-rel="order" data-toggle="modal" data-target="#order" data-id="{{$room->id}}" data-name="{{$room->name}}">
										{{$room->name}}
						    		</div>
								</div>
							@endforeach
	  					</div>
	  				@endif
				</div>
			</div>
		</div>
		<!-- Modal -->
		<div class="modal fade" id="add-new" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog modal-lg" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">Thêm phòng</h4>
		      </div>
		      <div class="modal-body">
		        <form class="form-horizontal" role="form">
				  <div class="form-group">
				    <label for="name_txt" class="col-sm-2 control-label">Tên</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="name_txt" placeholder="Tên kiểu phòng">
				    </div>
				  </div>
				  <hr />
				  <div class="form-group">
				  	<label for="form" class="col-sm-12">Bảng giá ( Đơn vị 1.000 vnđ )</label>
				  </div>
				  <div class="form-group">
				    <label for="priceinroom" class="col-sm-2 control-label">Vào phòng</label>
				    <div class="col-sm-4">
				      <input type="text" class="form-control" id="priceinroom" placeholder="Giá vào phòng">
				    </div>
				    <label for="priceinhour" class="col-sm-2 control-label">1 giờ</label>
				    <div class="col-sm-4">
				      <input type="text" class="form-control" id="priceinhour" placeholder="Giá 1 giờ">
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="priceovernight" class="col-sm-2 control-label">1 đêm</label>
				    <div class="col-sm-4">
				      <input type="text" class="form-control" id="priceovernight" placeholder="Giá 1 đêm">
				    </div>
				    <label for="priceaday" class="col-sm-2 control-label">1 ngày</label>
				    <div class="col-sm-4">
				      <input type="text" class="form-control" id="priceaday" placeholder="Giá 1 ngày">
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="priceaweek" class="col-sm-2 control-label">1 tuần</label>
				    <div class="col-sm-4">
				      <input type="text" class="form-control" id="priceaweek" placeholder="Giá 1 tuần">
				    </div>
				    <label for="priceamonth" class="col-sm-2 control-label">1 tháng </label>
				    <div class="col-sm-4">
				      <input type="text" class="form-control" id="priceamonth" placeholder="Giá 1 tháng">
				    </div>
				  </div>
				</form>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Hủy bỏ</button>
		        <button type="button" class="btn btn-primary">Lưu lại</button>
		      </div>
		    </div>
		  </div>
		</div>

		<div class="modal fade" id="order" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog modal-lg" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">Đặt phòng <i id="room-name"></i></h4>
		      </div>
		      <div class="modal-body">
		        <form class="form-horizontal" role="form">
		          <input type="hidden" class="form-control" id="room-id" name="id" value="-1">
		          <input type="hidden" class="form-control" id="services-list" name="services-list" value="">
		          <div class="form-group">
			          <div class="col-sm-12">
			          	<table class="table" id="service-table">
						  <thead>
						    <tr>
						      <th>#</th>
						      <th>Tên dịch vụ</th>
						      <th>Số lượng</th>
						      <th>Thành tiền</th>
						      <th>Xóa</th>
						    </tr>
						  </thead>
						  <tbody>
						  </tbody>
						</table>
			          </div>
		          </div>
				  <div class="form-group">
				  	<label for="form" class="col-sm-12">Thêm dịch vụ</label>
				  </div>
				  <div class="form-group">
				    <div class="col-sm-7">
				      	<select class="form-control" id="id_service">
				      		@foreach ($services as $service)
								<option value="{{$service->id}}" data-price="{{$service->price}}">{{$service->name}}</option>
							@endforeach
						</select>
				    </div>
				    <div class="col-sm-3">
				      	<input type="number" class="form-control" id="numbers_txt" placeholder="0" min="0">
				    </div>
				    <div class="col-sm-2">
				      	<button type="button" class="btn btn-primary" id="add-service">Thêm</button>
				    </div>
				  </div>
				</form>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Hủy bỏ</button>
		        <button type="button" class="btn btn-primary" id="accept-btn">Đồng ý</button>
		      </div>
		    </div>
		  </div>
		</div>
		<script type="text/javascript">
			// page room_type
			$(document).ready(function(){
				var count = 0;
				/*
				get ip
				$.getJSON("http://jsonip.com/?callback=?", function (data) {
			        console.log(data);
			        alert(data.ip);
			    });
			    */
				// get info update room type
				// var menuId = $( "ul.nav" ).first().attr( "id" );
				// var request = $.ajax({
				//   url: "script.php",
				//   method: "POST",
				//   data: { id : menuId },
				//   dataType: "html"
				// });
				 
				// request.done(function( msg ) {
				//   $( "#log" ).html( msg );
				// });
				 
				// request.fail(function( jqXHR, textStatus ) {
				//   alert( "Request failed: " + textStatus );
				// });

				$(".product-item").click(function(){
					$("#room-id").val($(this).data('id'));
					$("#room-name").text($(this).data('name'));
				});

				$("#add-service").click(function(){
					var selected = $("#id_service").find('option:selected');
					var count_service = $("#service-table>tbody>tr").length + 1;
					var service_id = $("#id_service").find('option:selected').val();
					var service_name = $("#id_service").find('option:selected').text();
       				var service_price = selected.data('price'); 
       				var service_number = $("#numbers_txt").val();
       				var add_data = "<tr class='service-pick'><td>" + count_service + "</td><td>" + service_name + "</td><td>" + service_number +"</td><td>" + (service_price * service_number) + "</td><td><i id='" + count + "' class='glyphicon glyphicon-remove-circle delete-service'></i></td></tr>";
       				if(service_number <= 0){
       				 	return;
       				}
       				else{
       					if($( "#service-table>tbody>tr" ).length <= 0){
       						$("#services-list").val('{' + service_id + ':' + service_number + '}');
       					}else{
       						$("#services-list").val($("#services-list").val() + ',{' + service_id + ':' + service_number + '}');
       					}
       					$( "#service-table>tbody" ).append(add_data);
       					count++;
       				}
       				$(".delete-service").click(function(){
       					var temp = $("#services-list").val();
       					list = temp.split(",");
       					list.splice($(this).attr('id'),1);
						$("#services-list").val(list.toString());
						$(this).parent().parent().remove();
					});
				});

				$("#accept-btn").click(function(){
					// change status room

				});
			});
		</script>
@endsection