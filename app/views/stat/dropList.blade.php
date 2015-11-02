@extends('layouts.default')
@section('content')
    @include('includes.alert')
    @include('includes.statMenu')

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
            @foreach($dropInfo as $Info)
                @if($Info->grade_point == 0)
                    <tr class="danger">
                @else
                    <tr class="">
                        @endif
                        <td>{{$Info->course->course_number}}</td>
                        <td>{{$Info->course->course_semester}}</td>
                        <td>{{$Info->course->course_credit}}</td>
                        <td>{{$Info->grade_point}}</td>
                        <td>{{$Info->grade_letter}}</td>

                        <td class="text-center">
                            <a class="btn btn-xs btn-info btn-edit" href="{{ URL::route('editResult',$Info->id) }}">update</a>
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