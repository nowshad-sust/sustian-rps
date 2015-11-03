@extends('layouts.default')
@section('content')
    @include('includes.alert')

    <div class="panel-body">
        <table class="display table table-bordered table-stripe" id="example">
            <thead>
            <tr>
                <th>From</th>
                <th>Subject</th>
                <th>Message</th>
                <th>Time</th>

                <th class="text-center">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($messages as $Info)
                @if($Info->seen_status == false)
                    <tr class="success">
                @else
                    <tr class="">
                @endif
                        <td>{{ $Info->sender->userInfo->fullName }}</td>
                        <td>{{ $Info->subject }}</td>
                        <td>{{ $Info->message }}</td>
                        <td>{{ date('M d, Y h:i:s A', strtotime($Info->created_at)) }}</td>

                        <td class="text-center">
                            <a class="btn btn-xs btn-info btn-edit" href="{{ route('messageDetails',$Info->id) }}">Details</a>
                            <a class="btn btn-xs btn-success btn-edit" href="">Reply</a>
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