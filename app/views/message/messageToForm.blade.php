@extends('layouts.default')
@section('content')
    @include('includes.alert')
    <h2 class="form-signin-heading">Write a message</h2>

    <div class="inbox-body">
        <div class="sender-info">
            <div class="row">
                <div class="col-md-12">

                    To:
                    <strong>{{ $receiver->userInfo->fullName }}</strong>
                    {{ HTML::image($receiver->userInfo->icon_url, 'alt', array( 'width' => 35, 'height' => 35 )) }}
                </div>
            </div>
        </div>
    </div>

    {{ Form::open( array('route' => 'postMessageTo', 'method' => 'post', 'role' => 'form')) }}
    <div class="panel-body">

        {{ Form::label('subject', 'Subject', array('' => '')) }}
        {{ Form::text('subject', null, array('class' => 'form-control', 'autofocus')) }}

        {{ Form::label('message', 'Message', array('' => '')) }}
        {{ Form::textarea('message', null, array('class' => 'form-control', 'autofocus')) }}
        {{ Form::hidden('receiver_id',$receiver->id) }}
        {{ Form::submit('Send', array('class' => 'btn btn-lg btn-login btn-block')) }}
    </div>


    {{ Form::close() }}


@stop
