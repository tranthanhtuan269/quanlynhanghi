@extends('layouts.app')

@section('content')
    <?php 
        $user_id = Auth::user()->id;
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Cấu hình nhà nghỉ</div>
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
                        'url' => ['/user/'.$user_id.'/settings'],
                        'class' => 'form-horizontal',
                        'files' => true
                    ]) !!}
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                            {!! Form::label('timeinroommin', 'Số giờ đầu tính chung', ['class' => 'col-md-6 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('timeinroommin', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                {!! $errors->first('timeinroommin', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <hr>
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('overnightin') ? 'has-error' : ''}}">
                            {!! Form::label('overnightin', 'Giờ vào phòng qua đêm', ['class' => 'col-md-6 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('overnightin', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                {!! $errors->first('overnightin', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('overnightout') ? 'has-error' : ''}}">
                            {!! Form::label('overnightout', 'Giờ trả phòng qua đêm', ['class' => 'col-md-6 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('overnightout', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                {!! $errors->first('overnightout', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12 text-center">
                            {!! Form::submit('Cập nhập', ['class' => 'btn btn-primary']) !!}
                        </div>
                    </div>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
@endsection
