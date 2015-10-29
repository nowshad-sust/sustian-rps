@extends('layouts.default')
@section('content')
    @include('includes.alert')

    <div class="panel-body">
        <table class="display table table-bordered table-stripe" id="example">
            <thead>
            <tr>
                <th>Classmates</th>

            </tr>
            </thead>
            <tbody>
            @foreach($classmatesInfo as $Info)

                <tr class="">

                    <td>
                        <div class="media">
                            <a href="{{ URL::route('showProfile',$Info->user_id) }}" class="pull-left media-thumb">
                                <img style="height: 75px;" alt="" src="{{'../'.$Info->avatar_url}}" class="media-object">
                            </a>
                            <div class="media-body">
                                <strong>{{$Info->fullName}}</strong>
                                <small>registered {{$Info->created_at->diffForHumans()}}</small>
                                <br>
                                <a class="btn btn-xs btn-success btn-edit" href="{{ URL::route('showProfile',$Info->user_id) }}">details</a>
                            </div>
                        </div>
                        <!--
                        <aside class="profile-nav alt green-border">
                            <section class="panel">
                                <div class="user-heading alt green-bg">
                                    <a href="">
                                        <img alt="" src="{{'../'.$Info->avatar_url}}">
                                    </a>
                                    <h1>{{$Info->fullName}}</h1>
                                    <p>Joined: {{$Info->created_at->diffForHumans()}}</p>
                                    <div class="text-center">
                                        <a class="btn btn-xs btn-success btn-edit" href="{{ URL::route('showProfile',$Info->user_id) }}">details</a>
                                    </div>
                                </div>

                            </section>
                        </aside>
                        -->
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