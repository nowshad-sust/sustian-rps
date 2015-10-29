@extends('layouts.default')
@section('content')
    @include('includes.alert')
    {{ Form::open(array('route' => 'addCourse', 'method' => 'post', 'role' => 'form')) }}
    <h2 class="form-signin-heading">Add Department</h2>
    <div class="panel-body">

        {{ Form::label('dept', 'Department', array('' => '')) }}
        {{ Form::select('dept_id',$deptInfo, null, array('class' => 'form-control')) }}

        {{ Form::label('batch', 'Batch', array('' => '')) }}
        {{ Form::select('batch_id',$batchInfo, null, array('class' => 'form-control')) }}

        {{ Form::label('semester', 'Semester', array('' => '')) }}
        {{ Form::select('course_semester',$semesterList, null, array('class' => 'form-control')) }}

        {{ Form::label('course_number', 'Course Number', array('' => '')) }}
        {{ Form::text('course_number', null, array('class' => 'form-control', 'autofocus')) }}

        {{ Form::label('course_title', 'Course Title', array('' => '')) }}
        {{ Form::text('course_title', null, array('class' => 'form-control', 'autofocus')) }}

        {{ Form::label('credit', 'Credit', array('' => '')) }}
        {{ Form::text('course_credit', null, array('class' => 'form-control', 'autofocus')) }}

        {{ Form::submit('Add', array('class' => 'btn btn-lg btn-login btn-block')) }}
    </div>

    {{ Form::close() }}


@stop
