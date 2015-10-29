@extends('layouts.default')
@section('content')
    @include('includes.alert')

    <section class="panel">
        <header class="panel-heading tab-bg-dark-navy-blue">
            <ul class="nav nav-tabs nav-justified ">
                <li class="active">
                    <a href="#" aria-expanded="true">
                        Course vs Grade
                    </a>
                </li>
                <li class="">
                    <a href="{{route('chart.course-cgpa')}}" aria-expanded="false">
                        Course vs CGPA
                    </a>
                </li>
                <li class="">
                    <a href="#recent" data-toggle="tab" aria-expanded="false">
                        Recents
                    </a>
                </li>
            </ul>
        </header>
        <div class="panel-body">
            <div class="tab-content tasi-tab">
                <div class="tab-pane active" id="popular">
                    <article class="media">
                        <h3 class="text-center">Result Chart</h3>
                        <h5 class="text-center">(course vs grade)</h5>
                        <canvas id="myChart" ></canvas>
                    </article>
                </div>
                <!--<div class="tab-pane" id="comments">
                    <article class="media">
                        <a class="pull-left thumb p-thumb">
                            <img src="img/avatar-mini.jpg">
                        </a>
                        <div class="media-body">
                            <a class="cmt-head" href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a>
                            <p> <i class="fa fa-clock-o"></i> 1 hours ago</p>
                        </div>
                    </article>
                    <article class="media">
                        <a class="pull-left thumb p-thumb">
                            <img src="img/avatar-mini2.jpg">
                        </a>
                        <div class="media-body">
                            <a class="cmt-head" href="#">Nulla vel metus scelerisque ante sollicitudin commodo</a>
                            <p> <i class="fa fa-clock-o"></i> 23 mins ago</p>
                        </div>
                    </article>
                    <article class="media">
                        <a class="pull-left thumb p-thumb">
                            <img src="img/avatar-mini3.jpg">
                        </a>
                        <div class="media-body">
                            <a class="cmt-head" href="#">Donec lacinia congue felis in faucibus. </a>
                            <p> <i class="fa fa-clock-o"></i> 15 mins ago</p>
                        </div>
                    </article>
                </div>
                <div class="tab-pane" id="recent">
                    Recent Item goes here
                </div>
                -->
            </div>
        </div>
    </section>

@stop

@section('style')
    <style type="text/css">
        canvas {
            display: block;
            padding: 0;
            margin: 0 auto;

            background-color:whitesmoke;
            width: 90%;
            height: auto;
        }
    </style>

@stop


@section('script')
    {{HTML::script('js/Chart.min.js')}}

    <script>
        (function() {
            var data = {
                labels: {{ json_encode($courseList) }},
                //labels: ["January", "February", "March", "April", "May", "June", "July"],
                datasets: [
                    {
                        label: "My result dataset",
                        fillColor: "rgba(151,187,205,0.2)",
                        strokeColor: "rgba(151,187,205,1)",
                        pointColor: "rgba(151,187,205,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(151,187,205,1)",
                        data: {{ json_encode($grades) }}
                    }
                ]
            };
            var ctx = document.getElementById('myChart').getContext('2d');
            //var myLineChart = new Chart(ctx).Line(data, { bezierCurve: false});
            var myBarChart = new Chart(ctx).Bar(data, { bezierCurve: false});

        })();
    </script>

@stop