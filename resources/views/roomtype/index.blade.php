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
	  					Không có kiểu phòng nào ở đây
	  				@else
	  					<div class="row">
							@foreach ($roomtypes as $room)
								<div class="col-md-3">
									<div class="thumbnail product-item" data-rel="edit" data-toggle="modal" data-target="#edit">
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
				  <hr />
				  <div class="form-group">
				    <label for="priceaweek" class="col-sm-3 control-label">Thuộc khách sạn</label>
				    <div class="col-sm-9">
				      	<select class="form-control" id="id_hotel">
				      		@foreach ($hotels as $hotel)
								<option value="{{$hotel->id}}">{{$hotel->name}}</option>
							@endforeach
						</select>
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

		<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
				  <hr />
				  <div class="form-group">
				    <label for="priceaweek" class="col-sm-3 control-label">Thuộc khách sạn</label>
				    <div class="col-sm-9">
				      	<select class="form-control" id="id_hotel">
				      		@foreach ($hotels as $hotel)
								<option value="{{$hotel->id}}">{{$hotel->name}}</option>
							@endforeach
						</select>
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
		<script type="text/javascript">
			// page room_type
			$(document).ready(function(){
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


			});
		</script>
@endsection