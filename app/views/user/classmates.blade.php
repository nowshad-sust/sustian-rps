@extends('layouts.default')
@section('content')
    @include('includes.alert')

    <div class="panel-body">
        <table class="display table table-bordered table-stripe" id="example">
            <thead>
            <tr>
                <th>Freelancer Profile</th>

            </tr>
            </thead>
            <tbody>
            @foreach($classmatesInfo as $Info)

                <tr class="">
                    <td>
                        <aside class="profile-nav alt green-border">
                            <section class="panel">
                                <div class="user-heading alt green-bg">
                                    <a href="">
                                        <img alt="" src="{{'../'.$Info->userInfo->avatar_url}}">
                                    </a>
                                    <h1>{{$Info->userInfo->fullName}}</h1>
                                    <p>Joined: {{$Info->created_at->diffForHumans()}}</p>
                                    <div class="text-center">
                                        <a class="btn btn-xs btn-success btn-edit" href="{{ URL::route('showProfile',$Info->userInfo->user_id) }}">details</a>
                                    </div>
                                </div>

                            </section>
                        </aside>
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