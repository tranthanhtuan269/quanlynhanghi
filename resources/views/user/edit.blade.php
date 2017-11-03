@extends('layouts.app')

@section('content')
    <?php 
        $user_id = Auth::user()->id;
        $city = Auth::user()->city;
        $district = Auth::user()->district;
        $town = Auth::user()->town;
        $cities = \App\City::where('active', '=', 1)->pluck('name', 'id');
        $districts = \App\District::where('city', '=', $city)->where('active', '=', 1)->pluck('name', 'id');
        $towns = \App\Town::where('district', '=', $district)->where('active', '=', 1)->pluck('name', 'id');
    ?>
    <link rel="stylesheet" href="{{ url('/') }}/public/css/croppie.css">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Sửa thông tin nhà nghỉ</div>
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
                        'url' => ['/user', $user_id],
                        'class' => 'form-horizontal',
                        'files' => true
                    ]) !!}
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                        {!! Form::label('name', 'Name', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                        {!! Form::label('email', 'Email', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('email', null, ['class' => 'form-control', 'required' => 'required']) !!}
                            {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('phone') ? 'has-error' : ''}}">
                        {!! Form::label('phone', 'Phone', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('phone', null, ['class' => 'form-control', 'required' => 'required']) !!}
                            {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('city') ? 'has-error' : ''}}">
                        {!! Form::label('city', 'City', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::select('city', $cities, $city, array('class' => 'form-control', 'id' => 'city')) !!}
                            {!! $errors->first('city', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('district') ? 'has-error' : ''}}">
                        {!! Form::label('district', 'District', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::select('district', $districts, $district, array('class' => 'form-control', 'id' => 'district')) !!}
                            {!! $errors->first('district', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('town') ? 'has-error' : ''}}">
                        {!! Form::label('town', 'Town', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::select('town', $towns, $town, array('class' => 'form-control', 'id' => 'town')) !!}
                            {!! $errors->first('town', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                        {!! Form::label('address', 'Address', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('address', null, ['class' => 'form-control', 'required' => 'required']) !!}
                            {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('map', 'Map', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-sm-6">
                            <input id="searchBox" class="controls" type="text" placeholder="Search Box">
                            {!! Form::text('lat', Auth::user()->lat, ['class' => 'form-control hide', 'id' => 'lat']) !!}
                            {!! Form::text('lng', Auth::user()->lng, ['class' => 'form-control hide', 'id' => 'lng']) !!}
                            <div id="map"></div>
                            <script>
                              function initMap() {
                                point = {lat: {{ Auth::user()->lat }}, lng: {{ Auth::user()->lng }}};

                                var map = new google.maps.Map(document.getElementById('map'),{
                                  center:point,
                                  zoom:15
                                });

                                var marker = new google.maps.Marker({
                                  position:point,
                                  map:map,
                                  draggable:true
                                });

                                var searchBox = new google.maps.places.SearchBox(document.getElementById('searchBox'));

                                google.maps.event.addListener(searchBox,'places_changed', function(){
                                  var places = searchBox.getPlaces();
                                  var bounds = new google.maps.LatLngBounds();
                                  var i, place;
                                  for (var i = 0; place = places[i]; i++) {
                                    bounds.extend(place.geometry.location);
                                    marker.setPosition(place.geometry.location);
                                  }

                                  map.fitBounds(bounds);
                                  map.setZoom(15);
                                });

                                google.maps.event.addListener(marker,'position_changed', function(){
                                  var lat = marker.getPosition().lat();
                                  var lng= marker.getPosition().lng();

                                  $("#lat").val(lat);
                                  $("#lng").val(lng);
                                });
                              }

                            </script>
                            <script async defer
                                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAhlfeeJco9hP4jLWY1ObD08l9J44v7IIE&libraries=places&callback=initMap">
                            </script>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-offset-4 col-md-4">
                            {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
                        </div>
                    </div>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="{{ url('/') }}/public/js/croppie.js"></script>

    <script type="text/javascript">
        var _sefl;
        $(document).ready(function(){
            var src_banner = '';
            $("#city").change(function () {
                var citId = $("#city").val();
                $('#loading').show();
                var request = $.ajax({
                    url: "{{ URL::to('/') }}/getDistrict/" + citId,
                    method: "GET",
                    dataType: "html"
                });

                request.done(function (msg) {
                  $('#loading').hide();
                  $("#district").html(msg);
                  $("#town").html('<option value="0">Chọn Phường / Xã</option>');
                });

                request.fail(function (jqXHR, textStatus) {
                  $('#loading').hide();
                  swal("Cảnh báo", "Đã có lỗi khi lấy Quận / Huyện!", "error");
                });
            });

            $("#district").change(function () {
                var districtId = $("#district").val();
                $('#loading').show();
                var request = $.ajax({
                    url: "{{ URL::to('/') }}/getTown/" + districtId,
                    method: "GET",
                    dataType: "html"
                });

                request.done(function (msg) {
                    $('#loading').hide();
                    $("#town").html(msg);
                });

                request.fail(function (jqXHR, textStatus) {
                  $('#loading').hide();
                  swal("Cảnh báo", "Đã có lỗi khi lấy Phường / Xã!", "error");
                });
            });
        });
    </script>
@endsection
