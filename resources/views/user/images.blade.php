@extends('layouts.app')

@section('content')
    <?php 
        $user_id = Auth::user()->id;
    ?>
    <style type="text/css">
    	#images-holder div{
    		margin-bottom: 10px;
    	}
    	#images-holder img{
    		position: relative;
    	}
    	#images-holder .delete-btn{
		    width: 32px;
		    height: 32px;
		    display: block;
		    position: absolute;
		    top: 1px;
		    left: 282px;
		    background: url('../../../public/images/delete.png');
    	}
    </style>
    <script type="text/javascript" src="{{ url('/') }}/public/js/croppie.js"></script>
    <link rel="stylesheet" href="{{ url('/') }}/public/css/croppie.css">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Thêm ảnh nhà nghỉ</div>
                <div class="panel-body">
                    @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    {!! Form::model(Auth::user(), [
                        'method' => 'POST',
                        'url' => ['/user/postImages', $user_id],
                        'class' => 'form-horizontal',
                        'id' => 'upload-image',
                        'files' => true
                    ]) !!}

                    <div class="form-group {{ $errors->has('images') ? 'has-error' : ''}}" id="images-holder">
                    	<input type="hidden" id="images" name="images" value="">
                    	<?php 
                    		$imageString = rtrim(Auth::user()->images, ';');
                    		$imageArr = explode(";",$imageString);
                    		foreach($imageArr as $image){
                    	?>
                    			<div class="col-md-4 image-obj" data-source="{{ $image }}"><img src="{{ url('/') }}/public/images/{{ $image }}" width="300" height="200"><span class="delete-btn"></span></div>
                    	<?php
                    		}
                    	?>
                    </div>

                    <div class="form-group">
                        <div class="col-md-offset-4 col-md-4">
                        	<img src="{{ url('/') }}/public/images/image_add.png" width="60" height="40" class="image-plus">
                            <div class="btn btn-primary" id="save-btn">Save</div>
                        </div>
                    </div>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-show-banner" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="panel panel-default">
                      <div class="panel-heading">Upload Banner</div>
                      <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <div id="upload-banner-demo" style="width:100%"></div>
                                <input type="file" id="upload-banner" style="display: none;">
                            </div>
                        </div>
                      </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default select-banner" style="margin: 10px 0;">Chọn Banner</button>
                    <button type="button" class="btn btn-primary upload-banner-result">Lựa chọn</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy bỏ</button>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function(){
            var src_banner = '';

            $('.image-plus').click(function(){
                $('.modal-show-banner').modal('show');
            });
            
            $uploadBannerCrop = $('#upload-banner-demo').croppie({
                enableExif: true,
                viewport: {
                    width: 600,
                    height: 400,
                    type: 'square'
                },
                boundary: {
                    width: 836,
                    height: 460
                },
                showZoomer: true
            });

            $('.select-banner').click(function(){
                $("#upload-banner").click();
            });

            $('#upload-banner').on('change', function () { 
                var reader = new FileReader();
                reader.onload = function (e) {
                    $uploadBannerCrop.croppie('bind', {
                        url: e.target.result
                    }).then(function(){
                        console.log('jQuery bind complete');
                    });
                }
                reader.readAsDataURL(this.files[0]);
            });

            $('.upload-banner-result').on('click', function (ev) {
                $uploadBannerCrop.croppie('result', {
                    type: 'canvas',
                    size: 'viewport',
                  	format: 'jpeg'
                }).then(function (resp) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ url('/') }}/ajaxpro",
                        type: "POST",
                        data: {"image":resp},
                        success: function (data) {
                            if(data.code == 200){
                                var $html = '<div class="col-md-4 image-obj" data-source="' + data.image_url + '"><img src="' + resp + '" width="300" height="200"><span class="delete-btn"></span></div>';
                                $('#images-holder').append($html);
                                actions();
                                $('.modal-show-banner').modal('toggle');
                            }
                        }
                    });
                });
            });

            $('#save-btn').click(function(){
            	var $list_images = '';
            	$( ".image-obj" ).each(function( index ) {
				  	if(!$(this).hasClass('removed')){
				  		$list_images += $(this).attr('data-source') + ';';
				  	}
				});
				$('#images').val($list_images);
				$("#upload-image").submit();
            });
        });

        function actions(){
        	$('.delete-btn').off('click');
        	$('.delete-btn').click(function(){
        		$(this).parent().addClass('removed');
        		$(this).parent().hide();
        	});
        }

        actions();
    </script>
@endsection
