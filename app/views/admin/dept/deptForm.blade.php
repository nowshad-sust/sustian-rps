@extends('layouts.default')
@section('content')
    @include('includes.alert')
    {{ Form::open(array('route' => 'addDept', 'method' => 'post', 'role' => 'form')) }}
    <h2 class="form-signin-heading">Add Department</h2>
    <div class="panel-body">

        {{ Form::label('deptCode', 'Dept code', array('' => '')) }}
        {{ Form::text('deptCode', null, array('class' => 'form-control', 'autofocus')) }}

        {{ Form::label('dept', 'Dept short name', array('' => '')) }}
        {{ Form::text('dept', null, array('class' => 'form-control', 'autofocus')) }}

        {{ Form::label('deptName', 'Dept name', array('' => '')) }}
        {{ Form::text('deptName', null, array('class' => 'form-control', 'autofocus')) }}

        {{ Form::submit('Add', array('class' => 'btn btn-lg btn-login btn-block')) }}
    </div>

    {{ Form::close() }}


@stop
