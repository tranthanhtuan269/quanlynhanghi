@extends('layouts.app')

@section('content')
	
		<div class="row">
			<div class="col-md-12">
				<div class="content-box-header">
					<div class="panel-title">Quản lý kiểu phòng</div>
					<div class="panel-options">
						<a href="#" data-rel="add" data-toggle="modal" data-target="#add-new"><i class="glyphicon glyphicon-plus"></i></a>
						<a href="#" data-rel="reload"><i class="glyphicon glyphicon-refresh"></i></a>
					</div>
	  			</div>
	  			<div class="content-box-large box-with-header">
	  				@if(count($roomtypes) <= 0)
	  					Chưa có kiểu phòng nào được tạo!
	  				@else
	  					<div class="row" id="roomtype-list">
							@foreach ($roomtypes as $room)
								<div class="col-md-3">
									<div class="thumbnail product-item room-type-ok" data-rel="edit" data-toggle="modal" data-target="#edit" data-id="{{$room->id}}" id="room-{{$room->id}}">
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
		        <h4 class="modal-title" id="myModalLabel">Thêm kiểu phòng</h4>
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
				  	<label for="form" class="col-sm-12">Bảng giá ( Đơn vị VNĐ )</label>
				  </div>
				  <div class="form-group">
				    <label for="priceinroom" class="col-sm-2 control-label">Vào phòng</label>
				    <div class="col-sm-4">
				      <input type="text" class="form-control" id="priceinroom" placeholder="Giá vào phòng">
				    </div>
				    <label for="priceinhour" class="col-sm-2 control-label">Quá giờ</label>
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
		        <button type="button" class="btn btn-primary" id="add-room-type">Lưu lại</button>
		      </div>
		    </div>
		  </div>
		</div>

		<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog modal-lg" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">Sửa kiểu phòng</h4>
		        <input type="hidden" name="id-room-type" value="">
		      </div>
		      <div class="modal-body">
		        <form class="form-horizontal" role="form">
				  <div class="form-group">
				    <label for="name_txt" class="col-sm-2 control-label">Tên</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="edit_name_txt" placeholder="Tên kiểu phòng">
				    </div>
				  </div>
				  <hr />
				  <div class="form-group">
				  	<label for="form" class="col-sm-12">Bảng giá ( Đơn vị VNĐ )</label>
				  </div>
				  <div class="form-group">
				    <label for="priceinroom" class="col-sm-2 control-label">Vào phòng</label>
				    <div class="col-sm-4">
				      <input type="text" class="form-control" id="edit_priceinroom" placeholder="Giá vào phòng">
				    </div>
				    <label for="priceinhour" class="col-sm-2 control-label">Quá giờ</label>
				    <div class="col-sm-4">
				      <input type="text" class="form-control" id="edit_priceinhour" placeholder="Giá 1 giờ">
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="priceovernight" class="col-sm-2 control-label">1 đêm</label>
				    <div class="col-sm-4">
				      <input type="text" class="form-control" id="edit_priceovernight" placeholder="Giá 1 đêm">
				    </div>
				    <label for="priceaday" class="col-sm-2 control-label">1 ngày</label>
				    <div class="col-sm-4">
				      <input type="text" class="form-control" id="edit_priceaday" placeholder="Giá 1 ngày">
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="priceaweek" class="col-sm-2 control-label">1 tuần</label>
				    <div class="col-sm-4">
				      <input type="text" class="form-control" id="edit_priceaweek" placeholder="Giá 1 tuần">
				    </div>
				    <label for="priceamonth" class="col-sm-2 control-label">1 tháng </label>
				    <div class="col-sm-4">
				      <input type="text" class="form-control" id="edit_priceamonth" placeholder="Giá 1 tháng">
				    </div>
				  </div>
				</form>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Hủy bỏ</button>
		        <button type="button" class="btn btn-primary" id="edit-room-type">Lưu lại</button>
		      </div>
		    </div>
		  </div>
		</div>
		<script type="text/javascript">
			// page room_type
			$(document).ready(function(){

				$('#edit').on('show.bs.modal', function (e) {
					var $invoker = $(e.relatedTarget);
					var id = $invoker.attr('data-id');
					$('input[name="id-room-type"]').val(id);

					var request_get_info_type = $.ajax({
				  		headers: {
					        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					    },
						url: "{{ url('/') }}" + "/getroomtypeinfo",
						method: "GET",
						data: { id : id },
						dataType: "json"
					});
					 
					request_get_info_type.done(function( msg ) {
					  	if(msg.code == 200){
						  	var roomtype = msg.room_type;
						  	$('#room-' + id).html(roomtype.name);
						  	$('#edit_name_txt').val(roomtype.name);
						  	$('#edit_priceinroom').val(roomtype.priceinroom);
						  	$('#edit_priceinhour').val(roomtype.priceahour);
						  	$('#edit_priceovernight').val(roomtype.priceovernight);
						  	$('#edit_priceaday').val(roomtype.priceaday);
						  	$('#edit_priceaweek').val(roomtype.priceaweek);
						  	$('#edit_priceamonth').val(roomtype.priceamonth);
						}
					});
					 
					request_get_info_type.fail(function( jqXHR, textStatus ) {
					  	alert( "Request failed: " + textStatus );
					});
				});

				$('#edit-room-type').click(function(){
					// get info of room type
					var edit_type_id 		= $('input[name="id-room-type"]').val();
					var edit_name_type 		= $('#edit_name_txt').val();
					var edit_priceinroom 	= $('#edit_priceinroom').val();
					var edit_priceinhour 	= $('#edit_priceinhour').val();
					var edit_priceovernight = $('#edit_priceovernight').val();
					var edit_priceaday 		= $('#edit_priceaday').val();
					var edit_priceaweek 	= $('#edit_priceaweek').val();
					var edit_priceamonth 	= $('#edit_priceamonth').val();

					var request_edit_room_type = $.ajax({
				  		headers: {
					        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					    },
						url: "{{ url('/') }}/roomtype/" + edit_type_id,
						method: "PUT",
						data: 
						{
							'type_id' 			: edit_type_id,
							'name_type' 		: edit_name_type,
							'priceinroom' 		: edit_priceinroom,
							'priceinhour' 		: edit_priceinhour,
							'priceovernight' 	: edit_priceovernight,
							'priceaday' 		: edit_priceaday,
							'priceaweek' 		: edit_priceaweek,
							'priceamonth' 		: edit_priceamonth
						},
						dataType: "json"
					});
					 
					request_edit_room_type.done(function( msg ) {
					  	if(msg.code == 200){
						  	swal({	
						  		title: 	"Thông báo", 
						  		text: 	"Kiểu phòng đã được sửa thành công!", 
						  		type: 	"success"
						  	},
						  	function(){
							    location.reload();
							});
						  	$('#edit').modal('toggle');
						  }else{
						  	swal("Cảnh báo", "Đã có lỗi khi sửa kiểu phòng!", "error");
						  }
					});
					 
					request_edit_room_type.fail(function( jqXHR, textStatus ) {
					  	alert( "Request failed: " + textStatus );
					});
				});

				$('#add-room-type').click(function(){
					// get info of room type
					var name_type = $('#name_txt').val();
					var priceinroom = $('#priceinroom').val();
					var priceinhour = $('#priceinhour').val();
					var priceovernight = $('#priceovernight').val();
					var priceaday = $('#priceaday').val();
					var priceaweek = $('#priceaweek').val();
					var priceamonth = $('#priceamonth').val();

					var request_add_room_type = $.ajax({
				  		headers: {
					        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					    },
						url: "{{ url('/') }}/roomtype",
						method: "POST",
						data: 
						{ 
							'name_type' : name_type,
							'priceinroom' : priceinroom,
							'priceinhour' : priceinhour,
							'priceovernight' : priceovernight,
							'priceaday' : priceaday,
							'priceaweek' : priceaweek,
							'priceamonth' : priceamonth
						},
						dataType: "json"
					});
					 
					request_add_room_type.done(function( msg ) {
					  	if(msg.code == 200){
							swal({	
						  		title: 	"Thông báo", 
						  		text: 	"Kiểu phòng đã được tạo thành công!", 
						  		type: 	"success"
						  	},
						  	function(){
							    location.reload();
							});
							$('#add-new').modal('toggle');
						  }else{
						  	swal("Cảnh báo", "Đã có lỗi khi tạo một kiểu phòng mới!", "error");
						  }
					});
					 
					request_add_room_type.fail(function( jqXHR, textStatus ) {
					  	alert( "Request failed: " + textStatus );
					});
				});
			});
		</script>
@endsection