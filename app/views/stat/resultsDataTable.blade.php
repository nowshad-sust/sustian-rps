@extends('layouts.default')
@section('content')
    @include('includes.alert')

    <ul class="breadcrumb">
        <li class="active"><i class="fa fa-home"></i> Data</li>
        <li><a href="{{route('addResult')}}"> Add Result</a></li>
        <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="dropdown-toggle" aria-expanded="true">
                Semester Result
                <b class=" fa fa-angle-down"></b>
            </a>
            <ul role="menu" class="dropdown-menu">
                <li><a tabindex="-1" href="{{route('gpaBySemester',1)}}"> 1/1 </a></li>
                <li><a tabindex="-1" href="{{route('gpaBySemester',2)}}"> 1/2 </a></li>
                <li><a tabindex="-1" href="{{route('gpaBySemester',3)}}"> 2/1 </a></li>
                <li><a tabindex="-1" href="{{route('gpaBySemester',4)}}"> 2/2 </a></li>
                <li><a tabindex="-1" href="{{route('gpaBySemester',5)}}"> 3/1 </a></li>
                <li><a tabindex="-1" href="{{route('gpaBySemester',6)}}"> 3/2 </a></li>
                <li><a tabindex="-1" href="{{route('gpaBySemester',7)}}"> 4/1 </a></li>
                <li><a tabindex="-1" href="{{route('gpaBySemester',8)}}"> 4/2 </a></li>
                <li><a tabindex="-1" href="{{route('gpaBySemester',9)}}"> 5/1 </a></li>
                <li><a tabindex="-1" href="{{route('gpaBySemester',10)}}"> 5/2 </a></li>
                <li class="divider"></li>
                <li><a tabindex="-1" href=""> Separated link </a></li>
            </ul>
        </li>
        <li><a href="{{route('cgpa')}}"> CGPA</a></li>
        <li><a href="{{route('classStanding')}}"> Class Standing</a></li>

    </ul>
    <div class="panel-body">
        <table class="display table table-bordered table-stripe" id="example">
            <thead>
            <tr>
                <th>Course ID</th>
                <th>Semester</th>
                <th>Course Credit</th>
                <th>Grade point</th>
                <th>Grade Letter</th>

                <th class="text-center">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($resultsInfo as $Info)

                <tr class="">
                    <td>{{$Info->course->course_number}}</td>
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
            });
        });
    </script>
@stop