@extends('layouts.default')
@section('content')
    @include('includes.alert')
    {{ Form::model($deptInfo,array('route' => 'updateDept', 'method' => 'post', 'role' => 'form')) }}
    <h2 class="form-signin-heading">Add Department</h2>
    <div class="panel-body">

        {{ Form::label('deptCode', 'Dept code', array('' => '')) }}
        {{ Form::text('deptCode', null, array('class' => 'form-control', 'autofocus')) }}

        {{ Form::label('dept', 'Dept short name', array('' => '')) }}
        {{ Form::text('dept', null, array('class' => 'form-control', 'autofocus')) }}

        {{ Form::label('deptName', 'Dept name', array('' => '')) }}
        {{ Form::text('deptName', null, array('class' => 'form-control', 'autofocus')) }}

        {{ Form::hidden('id',$deptInfo->id) }}
        {{ Form::submit('Update', array('class' => 'btn btn-lg btn-login btn-block')) }}
    </div>

    {{ Form::close() }}


@stop
