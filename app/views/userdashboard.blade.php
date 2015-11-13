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
                    <h3>Earning Graph</h3>
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
                            <h4 class="text-center">you don't have enough data to populate the graph</h4>
                        </article>
                    </div>
                </div>
            </div>
            @endif
                </section>
                <!--custom chart end-->

            </div>
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
        @endif
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

@stop