@extends('layouts.default')
@section('content')
    @include('includes.alert')

    <div class="panel-body">
        <a style="float:right;" href="{{route('addDept')}}"><button class="btn btn-default">Add new</button></a>
        <table class="display table table-bordered table-stripe" id="example">
            <thead>
            <tr>
                <th>ID</th>
                <th>Dept Code</th>
                <th>Dept Short Name</th>
                <th>Dept Full Name</th>

                <th class="text-center">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($deptInfo as $Info)

                <tr class="">
                    <td>{{$Info->id}}</td>
                    <td>{{$Info->deptCode}}</td>
                    <td>{{$Info->dept}}</td>
                    <td>{{$Info->deptName}}</td>

                    <td class="text-center">
                        <a class="btn btn-xs btn-warning btn-edit" href="{{ URL::route('editDept',$Info->id) }}">Edit</a>
                        <a class="btn btn-xs btn-danger btn-edit" href="{{ URL::route('deleteDept',$Info->id) }}">Delete</a>
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