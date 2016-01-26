@extends('layouts.default')
@section('content')
        @include('includes.statMenu')
        @include('includes.alert')
    <div class="panel-body">
    @foreach($resultsInfo as $semesterResults)
        <table class="display table table-bordered table-stripe" id="example">
            <thead>
            @if($semesterResults[0] != null)
            <h3>Semester: {{ $resultsSemester = $semesterResults[0]->course->course_semester;}} </h3>
            @endif
            <tr>
                <th>Course ID</th>
                <th>Course Name</th>
                <th>Semester</th>
                <th>Course Credit</th>
                <th>Grade point</th>
                <th>Grade Letter</th>

                <th class="text-center">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($semesterResults as $Info)
                @if($Info->grade_point == 0)
                    <tr class="danger">
                 @else
                    <tr class="">
                @endif
                    <td>{{$Info->course->course_number}}</td>
                    <td>{{$Info->course->course_title}}</td>
                    <td>{{$Info->course->course_semester}}</td>
                    <td>{{$Info->course->course_credit}}</td>
                    <td>{{$Info->grade_point}}</td>
                    <td>{{$Info->grade_letter}}</td>

                    <td class="text-center">
                        <a class="btn btn-xs btn-warning btn-edit" href="{{ URL::route('editResult',$Info->id) }}">Edit</a>
                        <a class="btn btn-xs btn-danger btn-edit" href="{{ URL::route('deleteResult',$Info->id) }}">Delete</a>
                    </td>
                </tr>

            @endforeach
            </tbody>
        </table>
        @endforeach
    </div>



@stop

@section('style')
    {{ HTML::style('assets/data-tables/DT_bootstrap.css') }}

@stop


@section('script')
    {{ HTML::script('assets/data-tables/jquery.dataTables.js') }}
    {{ HTML::script('assets/data-tables/DT_bootstrap.js') }}
    <!--
    <script type="text/javascript" charset="utf-8">
        $(document).ready(function() {

            $('#example').dataTable({
            });
        });
    </script>
    -->
@stop
