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
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('houroutroom') ? 'has-error' : ''}}">
                            {!! Form::label('houroutroom', 'Giờ trả phòng sáng', ['class' => 'col-md-6 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('houroutroom', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                {!! $errors->first('houroutroom', '<p class="help-block">:message</p>') !!}
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
