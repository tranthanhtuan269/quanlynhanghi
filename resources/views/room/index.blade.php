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
  					Chưa có phòng nào được tạo!
  				@else
  					<div class="row" id="room-list">
						@foreach ($rooms as $room)
							@if(count($rooms) > 12)
							<div class="col-md-2">
							@else
							<div class="col-md-3">
							@endif
								<div id="room-{{$room->id}}" class="thumbnail product-item <?php if($room->state == 0) echo 'state-ok'; else echo 'state-process'; ?>" data-rel="order" data-toggle="modal" data-target="#order" data-id="{{$room->id}}" data-name="{{$room->name}}">
									{{$room->name}}
					    		</div>
							</div>
						@endforeach
  					</div>
  				@endif
			</div>
		</div>
	</div>
	@if(sizeof($room_types) > 0)
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
			    <label for="roomname_txt" class="col-sm-2 control-label">Tên phòng</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="roomname_txt" placeholder="Tên phòng">
			    </div>
			  </div>
			  <hr />
			  <div class="form-group">
			    <label for="priceinroom" class="col-sm-2 control-label">Kiểu phòng</label>
			    <div class="col-sm-4">
			    	{!! Form::select('room_type', $room_types, null, ['class' => 'form-control', 'id' => 'select-room-type']) !!}
			    </div>
			  </div>
			  <hr />
			  <div class="form-group">
			  	<label for="form" class="col-sm-12">Bảng giá ( Đơn vị VNĐ )</label>
			  </div>
			  <div class="form-group">
			    <label for="priceinroom" class="col-sm-2 control-label">Vào phòng</label>
			    <div class="col-sm-4">
			      <input type="text" class="form-control" id="priceinroom" value="{{$room_type_first->priceinroom}}" placeholder="Giá vào phòng" disabled>
			    </div>
			    <label for="priceinhour" class="col-sm-2 control-label">Quá giờ</label>
			    <div class="col-sm-4">
			      <input type="text" class="form-control" id="priceinhour" value="{{$room_type_first->priceahour}}" placeholder="Giá 1 giờ" disabled>
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="priceovernight" class="col-sm-2 control-label">1 đêm</label>
			    <div class="col-sm-4">
			      <input type="text" class="form-control" id="priceovernight" value="{{$room_type_first->priceovernight}}" placeholder="Giá 1 đêm" disabled>
			    </div>
			    <label for="priceaday" class="col-sm-2 control-label">1 ngày</label>
			    <div class="col-sm-4">
			      <input type="text" class="form-control" id="priceaday" value="{{$room_type_first->priceaday}}" placeholder="Giá 1 ngày" disabled>
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="priceaweek" class="col-sm-2 control-label">1 tuần</label>
			    <div class="col-sm-4">
			      <input type="text" class="form-control" id="priceaweek" value="{{$room_type_first->priceaweek}}" placeholder="Giá 1 tuần" disabled>
			    </div>
			    <label for="priceamonth" class="col-sm-2 control-label">1 tháng </label>
			    <div class="col-sm-4">
			      <input type="text" class="form-control" id="priceamonth" value="{{$room_type_first->priceamonth}}" placeholder="Giá 1 tháng" disabled>
			    </div>
			  </div>
			  <hr />
			</form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Hủy bỏ</button>
	        <button type="button" class="btn btn-primary" id="add-room">Lưu lại</button>
	      </div>
	    </div>
	  </div>
	</div>
	@endif

	<div class="modal fade" id="order" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Đặt phòng <i id="room-name"></i></h4>
	      </div>
	      <div class="modal-body">
	        <form class="form-horizontal" role="form">
	          <input type="hidden" class="form-control" id="order-room-id" name="id" value="-1">
	          <input type="hidden" class="form-control" id="order-id" name="order-id" value="-1">
	          <input type="hidden" class="form-control" id="room-price" name="room-price" value="0" data-priceinroom="0" data-priceahour="0" data-priceovernight="0" data-priceaday="0" data-priceaweek="0" data-priceamonth="0">
	          <input type="hidden" class="form-control" id="services-list" name="services-list" value="">
	          <div class="form-group">
	          	<div class="col-sm-12">
				  	<div class="radio col-sm-2">
					  <label>
					    <input type="radio" name="typeOrder" id="priceinroom" value="0">
					    Nghỉ Giờ
					  </label>
					</div>
					<div class="radio col-sm-2">
					  <label>
					    <input type="radio" name="typeOrder" id="priceovernight" value="1">
					    Nghỉ Đêm
					  </label>
					</div>
					<div class="radio col-sm-2">
					  <label>
					    <input type="radio" name="typeOrder" id="priceaday" value="2">
					    Nghỉ Ngày
					  </label>
					</div>
					<div class="radio col-sm-2">
					  <label>
					    <input type="radio" name="typeOrder" id="priceaweek" value="3">
					    Nghỉ Tuần
					  </label>
					</div>
					<div class="radio col-sm-4">
					  <label>
					    <input type="radio" name="typeOrder" id="priceamonth" value="4">
					    Nghỉ Tháng
					  </label>
					</div>
				</div>
			  </div>
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
	          @if(count($services) > 0)
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
			      	<input type="number" class="form-control" id="numbers_txt" placeholder="0" min="0" max="6">
			    </div>
			    <div class="col-sm-2">
			      	<button type="button" class="btn btn-primary" id="add-service">Thêm</button>
			    </div>
			  </div>
			  @endif
			</form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Hủy bỏ</button>
	        <button type="button" class="btn btn-primary" id="accept-btn">Đặt phòng</button>
	        <button type="button" class="btn btn-primary" id="update-btn" style="display: none;">Cập nhật</button>
	        <button type="button" class="btn btn-danger" id="pay-btn" style="display: none;">Thanh toán</button>
	      </div>
	    </div>
	  </div>
	</div>

	<div class="modal fade" tabindex="-1" role="dialog" id="ads">
	  	<div class="modal-dialog" role="document">
		    <div class="modal-content">
		    	<div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h4 class="modal-title">Thông báo</h4>
			    </div>
		      	<div class="modal-body">
		        	<p style="font-size: 30px; text-align: center;">Bạn còn</p>
		        	<div style="font-size: 68px; text-align: center; padding: 26px 169px;"><span style="color: #fd6868; padding: 30px; background-color: #eee; border-radius: 8px;">
		        		<?php 
		        			$datetime1 = new DateTime("now");
							$datetime2 = new DateTime(Auth::user()->expiration_date);
							$interval = $datetime1->diff($datetime2);
							echo $interval->format('%a');
		        		?>
		        	</span></div>
		        	<p style="font-size: 30px; text-align: center;">Ngày sử dụng.</p>

		        	<p style="font-size: 15px; margin-top: 19px;">Hãy nạp tiền để quá trình sử dụng không bị gián đoạn. Xin chân thành cám ơn!</p>
		      	</div>
		    </div><!-- /.modal-content -->
	  	</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	
	<script type="text/javascript">
		// page room_type
		$(document).ready(function(){
			@if((int)$interval->format('%a') <= 10)
				if(!checkCookie("viewed")){
					setCookie("viewed", "true", 1);
					$("#ads").modal("show");
				}
			@endif

			var count = 0;

			$("input[name='typeOrder']").click(function() {
				// set value of room to order
				var _sefl = $(this).attr('id');
				if(_sefl == 'priceinroom'){
					$('#detail-room-price').text(Number($('#room-price').attr('data-priceinroom')).toLocaleString('en'));
					$('#detail-room-price').attr('data-price', $('#room-price').attr('data-priceinroom'));
					getPriceOfRoom();
				}else if(_sefl == 'priceovernight'){
					$('#detail-room-price').text(Number($('#room-price').attr('data-priceovernight')).toLocaleString('en'));
					$('#detail-room-price').attr('data-price', $('#room-price').attr('data-priceovernight'));
					getPriceOfRoom();
				}else if(_sefl == 'priceaday'){
					$('#detail-room-price').text(Number($('#room-price').attr('data-priceaday')).toLocaleString('en'));
					$('#detail-room-price').attr('data-price', $('#room-price').attr('data-priceaday'));
					getPriceOfRoom();
				}else if(_sefl == 'priceaweek'){
					$('#detail-room-price').text(Number($('#room-price').attr('data-priceaweek')).toLocaleString('en'));
					$('#detail-room-price').attr('data-price', $('#room-price').attr('data-priceaweek'));
					getPriceOfRoom();
				}else if(_sefl == 'priceamonth'){
					$('#detail-room-price').text(Number($('#room-price').attr('data-priceamonth')).toLocaleString('en'));
					$('#detail-room-price').attr('data-price', $('#room-price').attr('data-priceamonth'));
					getPriceOfRoom();
				}
			});

			function getPriceOfRoom(){
				var priceOfRoom = 0;

				// count price of service
				$('.service-pick').each(function( index ) {
					priceOfRoom += parseInt($(this).attr('data-number')) * parseInt($(this).attr('data-price'));
				});
				// count price of room
				if(!isNaN(parseInt($('#detail-room-price').attr('data-price')))){
					priceOfRoom += parseInt($('#detail-room-price').attr('data-price'));
				}
				// show price
				$('#total-order-price').text(Number(priceOfRoom).toLocaleString('en'));
				$('#pay-btn').prop('disabled', true);
			}

			$('#order').on('show.bs.modal', function (e) {
				$('#loading').show();
				var $invoker = $(e.relatedTarget);
				var id = $invoker.attr('data-id');
				$('input[name="id-room-type"]').val(id);
				$('.service-pick').remove();
				$('.detail-room-price').remove();
				$('.total-order').remove();

				var request_get_info_room = $.ajax({
			  		headers: {
				        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				    },
					url: "{{ url('/') }}" + "/getroominfo",
					method: "GET",
					data: { id : id },
					dataType: "json"
				});
				 
				request_get_info_room.done(function( msg ) {
					$('#loading').hide();
					$('#accept-btn').prop('disabled', false);
				  	if(msg.code == 200){

				  		var room 				= msg.room;
				  		var room_type			= msg.room_type;
				  		var order 				= msg.order;
				  		var order_details 		= msg.order_details;
				  		var add_data 			= "";
				  		var total_order_price	= 0;
			  			// set price for room
			  			if(room_type){
			  				$('#room-price').attr('data-priceinroom', room_type.priceinroom);
			  				$('#room-price').attr('data-priceahour', room_type.priceahour);
			  				$('#room-price').attr('data-priceovernight', room_type.priceovernight);
			  				$('#room-price').attr('data-priceaday', room_type.priceaday);
			  				$('#room-price').attr('data-priceaweek', room_type.priceaweek);
			  				$('#room-price').attr('data-priceamonth', room_type.priceamonth);
			  			}

				  		if(room.state == 1){
				  			if(order != null){
					  			$('input[name="typeOrder"][value="' + room.order_type + '"]').prop('checked', true);
					  			// show value for room
					  			if(room.order_type == 0){
					  				add_data += "<tr class='detail-room-price' data-id='0' data-number='0'><td>1</td><td>Tiền phòng</td><td>1</td><td><span id='detail-room-price' class='price' data-price='" + room_type.priceinroom + "' data-price='" + room_type.priceinroom + "'>" + Number(room_type.priceinroom).toLocaleString('en') + "</span></td><td></td></tr>";
					  				total_order_price += room_type.priceinroom;
					  			}else if(room.order_type == 1){
					  				add_data += "<tr class='detail-room-price' data-id='0' data-number='0'><td>1</td><td>Tiền phòng</td><td>1</td><td><span id='detail-room-price' class='price' data-price='" + room_type.priceovernight + "'>" + Number(room_type.priceovernight).toLocaleString('en') + "</span></td><td></td></tr>";
					  				total_order_price += room_type.priceovernight;
					  			}else if(room.order_type == 2){
					  				add_data += "<tr class='detail-room-price' data-id='0' data-number='0'><td>1</td><td>Tiền phòng</td><td>1</td><td><span id='detail-room-price' class='price' data-price='" + room_type.priceaday + "' data-price='" + room_type.priceaday + "'>" + Number(room_type.priceaday).toLocaleString('en') + "</span></td><td></td></tr>";
					  				total_order_price += room_type.priceaday;
					  			}else if(room.order_type == 3){
					  				add_data += "<tr class='detail-room-price' data-id='0' data-number='0'><td>1</td><td>Tiền phòng</td><td>1</td><td><span id='detail-room-price' class='price' data-price='" + room_type.priceaweek + "' data-price='" + room_type.priceaweek + "'>" + Number(room_type.priceaweek).toLocaleString('en') + "</span></td><td></td></tr>";
					  				total_order_price += room_type.priceaweek;
					  			}else if(room.order_type == 4){
					  				add_data += "<tr class='detail-room-price' data-id='0' data-number='0'><td>1</td><td>Tiền phòng</td><td>1</td><td><span id='detail-room-price' class='price' data-price='" + room_type.priceamonth + "' data-price='" + room_type.priceamonth + "'>" + Number(room_type.priceamonth).toLocaleString('en') + "</span></td><td></td></tr>";
					  				total_order_price += room_type.priceamonth;
					  			}

					  			// show service in room
					  			if(order.state == 1){
					  				if(order_details.length > 0 ){
					  					for (var i = 0; i < order_details.length; i++) {
					  						add_data += "<tr class='service-pick' data-id='" + order_details[i].id + "' data-number='" + order_details[i].number_count + "' data-price='" + order_details[i].price + "'><td>" + (i + 2) + "</td><td>" + order_details[i].name + "</td><td>" + order_details[i].number_count +"</td><td>" + Number((order_details[i].price * order_details[i].number_count)).toLocaleString('en') + "</td><td><i class='glyphicon glyphicon-remove-circle delete-service'></i></td></tr>";
					  						total_order_price += (order_details[i].price * order_details[i].number_count);
					  					}
					  				}
					  			}
					  			$("#order-id").val(order.id);
				  				add_data += "<tr class='total-order'><td></td><td colspan='2'>Tổng cộng:</td><td><span id='total-order-price'>" + Number(total_order_price).toLocaleString('en') + "</span></td><td></td></tr>";

					  			$( "#service-table>tbody" ).append(add_data);
						  		var i = 0;
								$("#services-list").val('');
								$('.service-pick').each(function( index ) {
									if(i == 0){
										$("#services-list").val('{"service_id" : ' + $(this).attr('data-id') + ', "service_number":' + $(this).attr('data-number') + '}');
										i++;
									}else{
										$("#services-list").val($("#services-list").val() + ',{"service_id" : ' + $(this).attr('data-id') + ', "service_number":' + $(this).attr('data-number') + '}');
										i++;
									}
								});
						  		addEventDeleteService();
					  			$('#update-btn').show();
					  			$('#pay-btn').show();
					  			$('#accept-btn').hide();
					  			$('#pay-btn').prop('disabled', false);
				  			}else{
				  				$('input[name="typeOrder"][value="0"]').prop('checked', true);
					  			$('#update-btn').hide();
					  			$('#pay-btn').hide();
					  			$('#accept-btn').show();
				  			}
				  		}else{
				  			$("#services-list").val("");
				  			$('input[name="typeOrder"][value="0"]').prop('checked', true);
				  			$('#update-btn').hide();
				  			$('#pay-btn').hide();
				  			$('#accept-btn').show();
				  		}
				  		// change data price service room
				  		$('#priceinroom').attr('data-priceinroom', room_type.priceinroom);
				  		$('#priceovernight').attr('data-priceovernight', room_type.priceovernight);
				  		$('#priceaday').attr('data-priceaday', room_type.priceaday);
				  		$('#priceaweek').attr('data-priceaweek', room_type.priceaweek);
				  		$('#priceamonth').attr('data-priceamonth', room_type.priceamonth);
					}
				});
				 
				request_get_info_room.fail(function( jqXHR, textStatus ) {
					$('#loading').hide();
				  	alert( "Request failed: " + textStatus );
				});
			});

			// save room status
			$("#accept-btn").click(function(){
				$(this).prop('disabled', true);
				// change status room
				$('#loading').show();
				var room_id = $('#order-room-id').val();
				var services_list = $('#services-list').val();
				var type_order = $( 'input[name=typeOrder]:checked' ).val();
				var room_name = $('#room-name').html();

				var request_add_order = $.ajax({
			  		headers: {
				        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				    },
					url: "{{ url('/') }}/addorder",
					method: "POST",
					data: 
					{ 
						'room_id' : room_id,
						'room_name' : room_name,
						'room_services' : services_list,
						'type_order' : type_order
					},
					dataType: "json"
				});
				 
				request_add_order.done(function( msg ) {
					$('#loading').hide();
					$(this).prop('disabled', false);
				  	if(msg.code == 200){
				  		swal("Thông báo", "Phiếu đặt phòng đã được tạo thành công!", "success");
				  		$('#order').modal('toggle');
				  	
				  		if($('#room-' + $('#order-room-id').val()).hasClass( "state-ok" )){
				  			$('#room-' + $('#order-room-id').val()).removeClass( "state-ok" ).addClass( "state-process" );
				  		}
				  	}else{
				  		swal("Cảnh báo", "Đã có lỗi khi tạo một phiếu đặt phòng mới!", "error");
				  	}
				});
				 
				request_add_order.fail(function( jqXHR, textStatus ) {
					$('#loading').hide();
					$(this).prop('disabled', false);
				  	alert( "Request failed: " + textStatus );
				});
			});

			$("#update-btn").click(function(){
				$('#loading').show();
				$(this).prop('disabled', true);
				// change status room
				var room_id = $('#order-room-id').val();
				var order_id = $('#order-id').val();
				var services_list = $('#services-list').val();
				var type_order = $( 'input[name=typeOrder]:checked' ).val();
				var request_edit_order = $.ajax({
			  		headers: {
				        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				    },
					url: "{{ url('/') }}/editorder",
					method: "POST",
					data: 
					{ 
						'room_id' : room_id,
						'order_id' : order_id,
						'room_services' : services_list,
						'type_order' : type_order
					},
					dataType: "json"
				});
				 
				request_edit_order.done(function( msg ) {
					$('#loading').hide();
					$(this).prop('disabled', false);
				  	if(msg.code == 200){
				  		swal("Thông báo", "Phiếu đặt phòng đã được sửa thành công!", "success");
				  		$('#order').modal('toggle');

				  		if($('#room-' + $('#order-room-id').val()).hasClass( "state-process" )){
				  			$(this).removeClass( "state-process" ).addClass( "state-ok" );
				  		}
				  	}else{
				  		swal("Cảnh báo", "Đã có lỗi khi sửa một phiếu đặt phòng!", "error");
				  	}
				});
				 
				request_edit_order.fail(function( jqXHR, textStatus ) {
					$('#loading').hide();
					$(this).prop('disabled', false);
				  	alert( "Request failed: " + textStatus );
				});
			});

			$("#pay-btn").click(function(){
				$('#loading').show();
				$(this).prop('disabled', true);
				// change status room
				var room_id = $('#order-room-id').val();
				var order_id = $('#order-id').val();
				var services_list = $('#services-list').val();
				var request_edit_order = $.ajax({
			  		headers: {
				        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				    },
					url: "{{ url('/') }}/payorder",
					method: "POST",
					data: 
					{ 
						'room_id' : room_id,
						'order_id' : order_id,
						'room_services' : services_list,
					},
					dataType: "json"
				});
				 
				request_edit_order.done(function( msg ) {
					$('#loading').hide();
					$(this).prop('disabled', false);
				  	if(msg.code == 200){
				  		swal("Thông báo", "Phiếu đặt phòng đã được sửa thành công!", "success");
				  		$('#order').modal('toggle');

				  		if($('#room-' + $('#order-room-id').val()).hasClass( "state-process" )){
				  			$('#room-' + $('#order-room-id').val()).removeClass( "state-process" ).addClass( "state-ok" );
				  		}
				  	}else{
				  		swal("Cảnh báo", "Đã có lỗi khi sửa một phiếu đặt phòng!", "error");
				  	}
				});
				 
				request_edit_order.fail(function( jqXHR, textStatus ) {
					$('#loading').hide();
					$(this).prop('disabled', false);
				  	alert( "Request failed: " + textStatus );
				});
			});

			// get info room type
			$('#select-room-type').change(function() {
				$('#loading').show();
			  	var id = $(this).val();
			  	var request = $.ajax({
			  		headers: {
				        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				    },
					url: "{{ url('/') }}" + "/getroomtypeinfo",
					method: "GET",
					data: { id : id },
					dataType: "json"
				});
				 
				request.done(function( msg ) {
					$('#loading').hide();
				  if(msg.code == 200){
				  	var roomtype = msg.room_type;
				  	$('#priceinroom').val(roomtype.priceinroom);
				  	$('#priceinhour').val(roomtype.priceahour);
				  	$('#priceovernight').val(roomtype.priceovernight);
				  	$('#priceaday').val(roomtype.priceaday);
				  	$('#priceaweek').val(roomtype.priceaweek);
				  	$('#priceamonth').val(roomtype.priceamonth);
				  }
				});
				 
				request.fail(function( jqXHR, textStatus ) {
					$('#loading').hide();
				  alert( "Request failed: " + textStatus );
				});
			});

			function addClickForProduct(){
				$(".product-item").click(function(){
					$("#order-room-id").val($(this).data('id'));
					$("#room-name").text($(this).data('name'));
				});
			}

			addClickForProduct();

			// add room
			$('#add-room').click(function(){
				if($.trim($('#roomname_txt').val()) == ''){
					swal("Cảnh báo", "Xin đừng để trống tên phòng!", "error");
				}else{
					var room_name = $.trim($('#roomname_txt').val());
					var room_type = $('#select-room-type').val();
					$('#loading').show();
					var request_add_room = $.ajax({
				  		headers: {
					        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					    },
						url: "{{ url('/') }}/room",
						method: "POST",
						data: 
						{ 
							'room_name' : room_name,
							'room_type' : room_type,
						},
						dataType: "json"
					});
					 
					request_add_room.done(function( msg ) {
						$('#loading').hide();
					  if(msg.code == 200){
						swal({	
					  		title: 	"Thông báo", 
					  		text: 	"Phòng đã được tạo thành công!", 
					  		type: 	"success"
					  	},
					  	function(){
						    location.reload();
						});
						$('#add-new').modal('toggle');
					  }else{
					  	swal("Cảnh báo", "Đã có lỗi khi tạo một phòng mới!", "error");
					  }
					});
					 
					request_add_room.fail(function( jqXHR, textStatus ) {
						$('#loading').hide();
					  alert( "Request failed: " + textStatus );
					});

					$(".product-item").click(function(){
						$("#room-id").val($(this).data('id'));
						$("#room-name").text($(this).data('name'));
					});
				}
			});
			
			// add service
			$("#add-service").click(function(){

       			var service_number = $("#numbers_txt").val();
   				if(service_number <= 0){
   				 	return;
   				}
   				else{
					// remove total price
					$('.total-order').remove();

					// add service
					var selected = $("#id_service").find('option:selected');
					var count_service = $("#service-table>tbody>tr").length + 1;
					var service_id = $("#id_service").find('option:selected').val();
					var service_name = $("#id_service").find('option:selected').text();
       				var service_price = selected.data('price'); 
       				var add_data = "<tr class='service-pick' data-id='" + service_id + "' data-number='" + service_number + "' data-price='" + service_price + "'><td>" + count_service + "</td><td>" + service_name + "</td><td>" + service_number +"</td><td>" + Number((service_price * service_number)).toLocaleString('en') + "</td><td><i id='" + count + "' class='glyphicon glyphicon-remove-circle delete-service'></i></td></tr>";
   					if($( "#service-table>tbody>tr" ).length <= 1){
   						$("#services-list").val('{"service_id" : ' + service_id + ', "service_number":' + service_number + '}');
   					}else{
   						$("#services-list").val($("#services-list").val() + ',{"service_id" : ' + service_id + ', "service_number":' + service_number + '}');
   					}
   					$( "#service-table>tbody" ).append(add_data);
   					count++;
       				addEventDeleteService();
       				// add total price
       				add_total = "<tr class='total-order'><td></td><td colspan='2'>Tổng cộng:</td><td><span id='total-order-price'>0</span></td><td></td></tr>";
       				$( "#service-table>tbody" ).append(add_total);
       				getPriceOfRoom();
   				}
			});

			function addEventDeleteService(){
				$(".delete-service").click(function(){
					$(this).parent().parent().remove();
					var i = 0;
					$("#services-list").val('');
					$('.service-pick').each(function( index ) {
						if(i == 0){
							$("#services-list").val('{"service_id" : ' + $(this).attr('data-id') + ', "service_number":' + $(this).attr('data-number') + '}');
							i++;
						}else{
							$("#services-list").val($("#services-list").val() + ',{"service_id" : ' + $(this).attr('data-id') + ', "service_number":' + $(this).attr('data-number') + '}');
							i++;
						}
					});

					getPriceOfRoom();
				});
			}
		});

		function setCookie(cname, cvalue, exdays) {
		    var d = new Date();
		    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
		    var expires = "expires="+d.toUTCString();
		    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
		}

		function getCookie(cname) {
		    var name = cname + "=";
		    var ca = document.cookie.split(';');
		    for(var i = 0; i < ca.length; i++) {
		        var c = ca[i];
		        while (c.charAt(0) == ' ') {
		            c = c.substring(1);
		        }
		        if (c.indexOf(name) == 0) {
		            return c.substring(name.length, c.length);
		        }
		    }
		    return "";
		}

		function checkCookie($name) {
		    var user = getCookie($name);
		    if (user != "") {
		        return true;
		    } else {
		        return false;
		    }
		}
	</script>
@endsection