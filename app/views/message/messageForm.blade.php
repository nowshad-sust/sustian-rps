@extends('layouts.default')
@section('content')
    @include('includes.alert')
    <h2 class="form-signin-heading">Write a message</h2>
    {{ Form::open( array('route' => 'postMessage', 'method' => 'post', 'role' => 'form')) }}
    <div class="panel-body">

        {{ Form::label('subject', 'Subject', array('' => '')) }}
        {{ Form::text('subject', null, array('class' => 'form-control', 'autofocus')) }}

        {{ Form::label('message', 'Message', array('' => '')) }}
        {{ Form::textarea('message', null, array('class' => 'form-control', 'autofocus')) }}

        {{ Form::submit('Send', array('class' => 'btn btn-lg btn-login btn-block')) }}
    </div>


    {{ Form::close() }}


@stop
