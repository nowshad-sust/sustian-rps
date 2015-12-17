@extends('layouts.default')
@section('content')
    @include('includes.alert')
    {{ Form::model($courseInfo,array('route' => ['course.edit.put', $courseInfo->id], 'method' => 'put', 'role' => 'form')) }}
    <h2 class="form-signin-heading">Add Department</h2>
    <div class="panel-body">

        {{ Form::label('semester', 'Semester', array('' => '')) }}
        {{ Form::select('course_semester',$semesterList, null, array('class' => 'form-control')) }}

        {{ Form::label('course_number', 'Course Number', array('' => '')) }}
        {{ Form::text('course_number', null, array('class' => 'form-control', 'autofocus')) }}

        {{ Form::label('course_title', 'Course Title', array('' => '')) }}
        {{ Form::text('course_title', null, array('class' => 'form-control', 'autofocus')) }}

        {{ Form::label('credit', 'Credit', array('' => '')) }}
        {{ Form::text('course_credit', null, array('class' => 'form-control', 'autofocus')) }}
        <br>
        {{ Form::submit('Update', array('class' => 'btn btn-lg btn-login btn-block')) }}
    </div>

    {{ Form::close() }}


@stop
