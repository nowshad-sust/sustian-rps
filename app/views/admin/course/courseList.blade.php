@extends('layouts.default')
@section('content')
    @include('includes.alert')

    <div class="panel-body">
        <a style="float:right;" href="{{route('addCourse')}}"><button class="btn btn-default">Add new</button></a>
        <table class="display table table-bordered table-stripe" id="example">
            <thead>
            <tr>
                <th>ID</th>
                <th>Course Number</th>
                <th>Course Title</th>
                <th>Dept</th>
                <th>Batch</th>
                <th>Semester</th>
                <th>Credit</th>

                <th class="text-center">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($courseInfo as $Info)

                <tr class="">
                    <td>{{$Info->id}}</td>
                    <td>{{$Info->course_number}}</td>
                    <td>{{$Info->course_title}}</td>
                    <td>{{$Info->dept->dept}}</td>
                    <td>{{$Info->batch->batch}}</td>
                    <td>{{$Info->course_semester}}</td>
                    <td>{{$Info->course_credit}}</td>

                    <td class="text-center">
                        <a class="btn btn-xs btn-warning btn-edit" href="{{ route('editCourse',$Info->id) }}">Edit</a>
                        <a class="btn btn-xs btn-danger btn-edit" href="{{ route('deleteCourse',$Info->id) }}">Delete</a>
                    </td>
                </tr>

            @endforeach
            </tbody>
        </table>
    </div>


@stop

@section('style')
    {{ HTML::style('assets/data-tables/DT_bootstrap.css') }}

@stop


@section('script')
    {{ HTML::script('assets/data-tables/jquery.dataTables.js') }}
    {{ HTML::script('assets/data-tables/DT_bootstrap.js') }}

    <script type="text/javascript" charset="utf-8">
        $(document).ready(function() {

            $('#example').dataTable({
                stateSave: true
            });
        });
    </script>
@stop