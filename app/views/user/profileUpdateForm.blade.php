@extends('layouts.default')
@section('content')
    @include('includes.alert')
    {{ Form::model($profileInfo, array('route' => 'storeProfile', 'method' => 'post', 'role' => 'form')) }}
    <h2 class="form-signin-heading">Update Profile</h2>
    <div class="panel-body">
        {{ Form::label('fullName', 'Full Name', array('' => '')) }}
        {{ Form::text('fullName', null, array('class' => 'form-control', 'autofocus')) }}

        {{ Form::hidden('id',$profileInfo->id) }}
        {{ Form::submit('Update', array('class' => 'btn btn-lg btn-login btn-block')) }}
    </div>



    {{ Form::close() }}


@stop
