@extends('layouts.default')
@section('content')
    @include('includes.alert')
    {{ Form::open(array('route' => 'addBatch', 'method' => 'post', 'role' => 'form')) }}
    <h2 class="form-signin-heading">Add Department</h2>
    <div class="panel-body">

        {{ Form::label('batch', 'Batch', array('' => '')) }}
        {{ Form::text('batch', null, array('class' => 'form-control', 'autofocus')) }}

        {{ Form::submit('Add', array('class' => 'btn btn-lg btn-login btn-block')) }}
    </div>

    {{ Form::close() }}


@stop
