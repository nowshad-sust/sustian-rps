@extends('layouts.default')
    @section('content')
        <!--@include('manager.managerMenu')-->
        @include('includes.alert')

        <div class="panel-body">
        <p class="text-center"><h3>{{$courseInfo->course_number}}: {{$courseInfo->course_title}}</h3></p>
        <a style="float:right;" href="{{route('addCourse')}}"><button class="btn btn-info">Add new</button></a>
        <table class="table table-striped table-hover table-bordered dataTable" id="example">
            <thead>
            <tr>
                <th>Reg no</th>
                <th>Name</th>
                <th>Grade point</th>
                <th>Grade Letter</th>

                <th class="text-center">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($existingResults as $Info)

                <tr class="">
                    <td>{{$Info['user']['user_info']['reg_no']}}</td>
                    <td>{{$Info['user']['user_info']['fullName']}}</td>
                    @if($Info['id']!=null)
                    {{ Form::model($Info,array('route' => ['data.add.result',$Info['id']], 'method' => 'put')) }}
                    @else
                    {{ Form::open(array('route' => 'data.add.new.result', 'method' => 'post')) }}
                    {{Form::hidden('user_id', $Info['user']['id'])}}
                    {{Form::hidden('course_id', $Info['course_id'])}}
                    @endif
                    <td>{{Form::text('grade_point',null,array())}}</td>
                    <td>{{ $Info['grade_letter'] }}</td>

                    <td class="text-center">
                    {{ Form::submit('Update', array('class' => 'btn btn-xs btn-info btn-edit')) }}
                    @if($Info['grade_point']!=null)
                    <a class="btn btn-xs btn-danger btn-edit" href="{{ route('delete.course.result',$Info['id']) }}">Delete</a>
                    </td>
                    @endif
                    {{ Form::close() }}
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
                "order": [[ 0, "asc" ]],
                "pageLength": 20
            });
        });
    </script>
@stop