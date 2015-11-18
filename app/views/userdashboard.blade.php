@extends('layouts.default')
    @section('content')
        @include('includes.alert')

        <!--admin view of dashboard-->
        @if(Entrust::hasRole(Config::get('customConfig.roles.user')))
        <div class="row state-overview">
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <div class="symbol terques">
                        <i class="fa fa-user"></i>
                    </div>
                    <div class="value">
                        <h1 class="count">{{ $passed_credits }}</h1>
                        <p>Credits Passed</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <div class="symbol yellow">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                    <div class="value">
                        <h1 class=" count3">{{ $left_credits }}</h1>
                        <p>Credits Left</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <div class="symbol red">
                        <i class="fa fa-tags"></i>
                    </div>
                    <div class="value">
                        <h1 class=" count2">{{ $drop_credits }}</h1>
                        <p>Drop Credits</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <div class="symbol blue">
                        <i class="fa fa-bar-chart-o"></i>
                    </div>
                    <div class="value">
                        <h1 class=" count4">{{ $current_cgpa }}</h1>
                        <p>Current CGPA</p>
                    </div>
                </section>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <!--custom chart start-->
                <div class="border-head">
                    <h3>CGPA Graph</h3>
                </div>
                <section class="panel">
        @if($chartData['courseList']!=null||$chartData['cgpa']!=null)
        <div class="panel-body">
            <div class="tab-content tasi-tab">
                <div class="tab-pane active" id="popular">
                    <article class="media">
                        <canvas id="myChart" ></canvas>
                    </article>
                </div>
            </div>
        </div>
            @else
            <div class="panel-body">
                <div class="tab-content tasi-tab">
                    <div class="tab-pane active" id="popular">
                        <article class="media">
                            <h4 class="text-center">Looks like you haven't given any data yet!</h4>
                        </article>
                    </div>
                </div>
            </div>
            @endif
                </section>
                <!--custom chart end-->

            </div>
            <!--
            <div class="col-lg-4">
                <div class="lock-screen" onload="startTime()">

                    <div class="lock-wrapper">

                        <div id="time"></div>

                        <div class="lock-box text-center">
                        {{ HTML::image(Auth::user()->userInfo->avatar_url, 'lock avatar', array( 'width' => 85, 'height' => 85 )) }}
                            <h1 class="locked">{{Auth::user()->userInfo->fullName}}</h1>
                        </div>
                    </div>


                </div>
            </div>
            </div>
        </div>
        -->

            <div class="col-lg-4">
                @if($latest_post !=null)
                <h4 class="text-center">Latest Post</h4>
                <section class="panel">
                    <div class="panel-body">
                        <div class="fb-user-thumb">
                            {{ HTML::image($latest_post->post_user->user_info->avatar_url, 'lock avatar') }}
                        </div>
                        <div class="fb-user-details">
                            <h3><a href="#" class="#">{{ $latest_post->post_user->user_info->fullName }}</a></h3>
                            <p>{{$latest_post->created_at->diffForHumans()}}</p>
                        </div>
                        <div class="clearfix"></div>
                        <p class="fb-user-status">
                            {{ $latest_post->post_body }}
                        </p>
                        @if(Auth::user()->id == $latest_post->post_user->id)
                            <div class="fb-status-container fb-border">
                                <div class="fb-time-action">
                                    <button
                                            id="edit"
                                            data-toggle="modal"
                                            post-id="{{$latest_post->id}}"
                                            post-body="{{$latest_post->post_body}}"
                                            data-action="edit",
                                            class="btn btn-xs btn-warning">
                                        Edit
                                    </button>

                                    <span>-</span>
                                    <a id="delete"
                                       class="btn btn-xs btn-danger"
                                       href="{{ route('deletePost',$latest_post->id) }}"
                                       title="delete your post">
                                        Delete
                                    </a>
                                </div>

                            </div>
                        @endif
                        <div class="fb-status-container fb-border">
                            <div class="fb-time-action">
                                <a href="{{route('posts')}}">see more posts</a>
                            </div>
                        </div>

                    </div>
                </section>
                @else
                    <h4 class="text-center">No latest posts</h4>
                @endif

                <section class="panel profile-info">
                    {{ Form::open( array('route'=>'submitpost','method' => 'post', 'role' => 'form')) }}
                    {{ Form::textarea('post_body',null,
                    ['class'=>'form-control',
                    'rows' => 2,
                    'class'=>'form-control input-lg p-text-area',
                    'placeholder'=>'Shout to your classmates']) }}

                    <footer class="panel-footer">
                        {{ Form::submit('Post', array('class' => 'btn btn-danger pull-right')) }}
                        <ul class="nav nav-pills">

                        </ul>
                    </footer>
                    {{ Form::close() }}
                </section>
            </div>

        @endif

            <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">?</button>
                            <h4 class="modal-title">Edit Post</h4>
                        </div>
                        <div class="modal-body">

                            {{ Form::open(array('route'=>'updatePost','id'=>'update-form','method' => 'post', 'role' => 'form')) }}
                            {{ Form::textarea('post_body',null,
                            ['id' => 'form-post-body',
                            'class'=>'form-control input-lg p-text-area',
                            'placeholder'=>'Shout to your classmates']) }}
                            {{ Form::hidden('post_id',null, ['id'=>'hidden_post_id']) }}
                            <div class="form-group">
                                {{ Form::submit('Update Post', array('class' => 'btn btn-default')) }}
                            </div>
                            {{ Form::close() }}

                        </div>

                    </div>
                </div>
            </div>
@stop


@section('style')
    <style type="text/css">
        canvas {
            display: block;
            padding: 0;
            margin: 0 auto;

            background-color:whitesmoke;
            width: 100%;
            height: auto;
        }
    </style>

@stop


@section('script')
    {{HTML::script('js/Chart.min.js')}}

    <script>
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!

    var yyyy = today.getFullYear();
    if(dd<10){
        dd='0'+dd
    } 
    if(mm<10){
        mm='0'+mm
    } 
    var today = dd+'.'+mm+'.'+yyyy;
    document.getElementById("time").innerHTML = today;
    </script>

    <script>
        (function() {
            var data = {
                labels: {{ json_encode($chartData['courseList']) }},
                //labels: ["January", "February", "March", "April", "May", "June", "July"],
                datasets: [
                    {
                        label: "CGPA",
                        fillColor: "rgba(151,187,205,0.2)",
                        strokeColor: "rgba(151,187,205,1)",
                        pointColor: "rgba(151,187,205,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(151,187,205,1)",
                        data: {{ json_encode($chartData['cgpa']) }}
                    },
                    {
                        label: "Grade",
                        fillColor: "rgba(220,220,220,0.2)",
                        strokeColor: "rgba(220,220,220,1)",
                        pointColor: "rgba(220,220,220,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(220,220,220,1)",
                        data: {{ json_encode($chartData['grades']) }}
                    }
                ]
            };
            var ctx = document.getElementById('myChart').getContext('2d');
            var myLineChart = new Chart(ctx).Line(data, { bezierCurve: false,
                multiTooltipTemplate: "<%= datasetLabel %> - <%= value %>"});
            //var myBarChart = new Chart(ctx).Bar(data, { bezierCurve: false});
            myLineChart.generateLegend();

        })();
    </script>
                <script>
                    $('button').on('click', function(){
                        var this_id = $(this).attr('post-id');
                        var this_body = $(this).attr('post-body');
                        var this_action = $(this).attr('data-action');
                        if(this_action == 'edit'){
                            $("#hidden_post_id").val(this_id);
                            document.getElementById("form-post-body").defaultValue = this_body;
                            $('#myModal').modal();
                        }
                    });
                </script>

@stop