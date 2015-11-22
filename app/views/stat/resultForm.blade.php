@extends('layouts.default')
@section('content')
    @include('includes.statMenu')
    <h2 class="form-signin-heading">Add Result</h2>
    <div class="panel-body">
      <h4 class="">
        Please avoid providing false data. You are liable of your data<br>
        thanks in advance . . .
      </h4>
      @include('includes.alert')
    {{ Form::open(array('route' => 'postResult', 'method' => 'post', 'role' => 'form')) }}

        {{ Form::label('course_id', 'Course Number', array('' => '')) }}
        {{ Form::select('course_id',$courseList, null, array('class' => 'form-control')) }}

        {{ Form::label('grade_point', 'Obtained Grade', array('' => '')) }}
        {{ Form::select('grade_point',$gradeList, null, array('class' => 'form-control')) }}


        {{ Form::submit('Add', array('class' => 'btn btn-lg btn-login btn-block')) }}
    </div>

    {{ Form::close() }}


@stop
