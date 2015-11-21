@extends('layouts.default')
@section('content')
    @include('includes.alert')


    <div class="panel-body">
        <table class="display table table-bordered table-stripe" id="example">
            <thead>
            <tr>
                <th>User Id</th>
                <th>User Avatar</th>
                <th>User Name</th>
                <th>Email</th>
                <th>Dept</th>
                <th>Batch</th>
                <th>Reg. no</th>
                <th>Joined</th>

                <th class="text-center">Action</th>

            </tr>
            </thead>
            <tbody>
            @foreach($Users as $Info)

                <tr class="">
                    <td>{{$Info->id}}</td>
                    <td>{{ HTML::image($Info->userInfo->icon_url, 'alt', array('height'=>'35px')) }}</td>
                    <td>{{$Info->userInfo->fullName}}</td>
                    <td>{{$Info->email}}</td>
                    <td>{{$Info->userInfo->dept->dept}}</td>
                    <td>{{$Info->userInfo->batch->batch}}</td>
                    <td>{{$Info->userInfo->reg_no}}</td>
                    <td>{{$Info->created_at->diffForHumans()}}</td>

                    <td class="text-center">
                        <a class="btn btn-xs btn-success btn-edit" href="{{ URL::route('showProfile',$Info->userInfo->user_id) }}">details</a>
                        <a class="btn btn-xs btn-info btn-edit" href="{{ URL::route('writeMessageTo',$Info->userInfo->user_id) }}">message</a>
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
