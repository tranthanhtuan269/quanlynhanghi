@extends('layouts.app')

@section('content')
	
		<div class="row">
			<div class="col-md-12">
				<div class="content-box-header">
					<div class="panel-title">Quản lý giao dịch</div>
					<div class="panel-options">
						<a href="#" data-rel="add" data-toggle="modal" data-target="#add-new"><i class="glyphicon glyphicon-plus"></i></a>
						<a href="#" data-rel="reload"><i class="glyphicon glyphicon-refresh"></i></a>
					</div>
	  			</div>
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
		</div>

		<script type="text/javascript">
			$(document).ready(function(){
				$('.coin').each(function( index ) {
				  	$( this ).text(Number($( this ).text()).toLocaleString('en'));
				});
			});
		</script>
@endsection