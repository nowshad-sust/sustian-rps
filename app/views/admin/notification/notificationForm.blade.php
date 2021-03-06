@extends('layouts.default')
@section('content')
    @include('includes.alert')
    {{ Form::open(array('route' => 'addNotification', 'method' => 'post', 'role' => 'form')) }}
    <h2 class="form-signin-heading">Update Profile</h2>
    <div class="panel-body">

        {{ Form::label('notification', 'Notification Text', array('' => '')) }}
        {{ Form::text('notification', null, array('class' => 'form-control', 'autofocus')) }}

        {{ Form::submit('Update', array('class' => 'btn btn-lg btn-login btn-block')) }}
    </div>

    {{ Form::close() }}


@stop
