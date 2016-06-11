@extends('layouts.default')
@section('content')
    @include('includes.alert')
    {{ Form::model($resultInfo,array('route' => 'updateResult', 'method' => 'post', 'role' => 'form')) }}
    <h2 class="form-signin-heading">Update Result</h2>
    <div class="panel-body">

        {{ Form::label('course_id', 'Course Number', array('' => '')) }}
        {{ Form::label('course_number',$resultInfo->course->course_number, array('class' => 'form-control')) }}

        {{ Form::label('grade_point', 'Obtained Grade', array('' => '')) }}
        {{ Form::select('grade_point',$gradesList, null, array('class' => 'form-control')) }}

        {{ Form::hidden('id',$resultInfo->id) }}
        {{ Form::submit('Update', array('class' => 'btn btn-lg btn-login btn-block')) }}
    </div>

    {{ Form::close() }}


@stop
