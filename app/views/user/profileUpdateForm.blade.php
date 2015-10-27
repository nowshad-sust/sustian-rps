@extends('layouts.default')
@section('content')
    @include('includes.alert')
    {{ Form::model($profileInfo, array('route' => 'updateProfile', 'method' => 'post', 'role' => 'form')) }}
    <h2 class="form-signin-heading">Update Profile</h2>
    <div class="panel-body">
        {{ Form::label('fullName', 'Full Name', array('' => '')) }}
        {{ Form::text('fullName', null, array('class' => 'form-control', 'autofocus')) }}

        {{ Form::label('reg_no', 'Reg no', array('' => '')) }}
        {{ Form::text('reg_no', null, array('class' => 'form-control', 'autofocus')) }}

        {{ Form::label('batch', 'Batch', array('' => '')) }}
        {{ Form::text('batch', null, array('class' => 'form-control', 'autofocus')) }}

        {{ Form::label('dept', 'Department', array('' => '')) }}
        {{ Form::text('dept', null, array('class' => 'form-control', 'autofocus')) }}

        {{ Form::hidden('id',$profileInfo->id) }}
        {{ Form::submit('Update', array('class' => 'btn btn-lg btn-login btn-block')) }}
    </div>



    {{ Form::close() }}


@stop
