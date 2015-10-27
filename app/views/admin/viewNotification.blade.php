@extends('layouts.default')
@section('content')
    @include('includes.alert')

    <div class="panel-body">
        <a href="{{route('addNotification')}}"><button class="btn btn-default">Add new</button></a>
        <table class="display table table-bordered table-stripe" id="example">
            <thead>
            <tr>
                <th>ID</th>
                <th>Notification Text</th>
                <th>Status</th>

                <th class="text-center">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($notificationsInfo as $Info)

                <tr class="">
                    <td>{{$Info->id}}</td>
                    <td>{{$Info->notification_text}}</td>
                    <td>{{$Info->status}}</td>

                    <td class="text-center">
                        @if($Info->status==false)
                            <a class="btn btn-xs btn-success btn-edit" href="{{ URL::route('activateNotification',$Info->id) }}">Activate</a>
                        @else
                            <a class="btn btn-xs btn-warning btn-edit" href="{{ URL::route('deactivateNotification',$Info->id) }}">Deactivate</a>
                        @endif
                            <a class="btn btn-xs btn-danger btn-edit" href="{{ URL::route('deleteNotification',$Info->id) }}">Delete</a>
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