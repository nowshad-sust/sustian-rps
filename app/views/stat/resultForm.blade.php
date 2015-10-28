@extends('layouts.default')
@section('content')
    @include('includes.alert')
    {{ Form::open(array('route' => 'addResult', 'method' => 'post', 'role' => 'form')) }}
    <h2 class="form-signin-heading">Add Result</h2>
    <div class="panel-body">

        {{ Form::label('course', 'Course Number', array('' => '')) }}
        {{ Form::select('course_number',$courseList, null, array('class' => 'form-control')) }}

        {{ Form::label('grade_point', 'Grade Point', array('' => '')) }}
        {{ Form::select('grade_point',$gradeList, null, array('class' => 'form-control')) }}


        {{ Form::submit('Add', array('class' => 'btn btn-lg btn-login btn-block')) }}
    </div>

    {{ Form::close() }}


@stop
