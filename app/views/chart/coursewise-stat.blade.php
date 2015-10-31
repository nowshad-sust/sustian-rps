@extends('layouts.default')
@section('content')
    @include('includes.alert')

    <section class="panel">
        <header class="panel-heading tab-bg-dark-navy-blue">
            <ul class="nav nav-tabs nav-justified ">
                <li>
                    <a href="{{route('chart.course-grade')}}" aria-expanded="true">
                        Course vs Grade
                    </a>
                </li>
                <li>
                    <a href="{{route('chart.course-cgpa')}}" aria-expanded="false">
                        Course vs CGPA
                    </a>
                </li>
                <li  class="active">
                    <a href="#" aria-expanded="false">
                        Class Stat
                    </a>
                </li>
                <li class="">
                    <a href="{{route('chart.semester-cgpa')}}" aria-expanded="false">
                        Semester CGPA
                    </a>
                </li>
            </ul>
        </header>
        @if($data!=null)
            <div class="panel-body">
                <div class="tab-content tasi-tab">
                    <div class="tab-pane active" id="popular">
                        <article class="media">
                            <h4 class="text-center">Class CGPA Population</h4>
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

@stop

@section('style')
    <style type="text/css">
        canvas {
            display: block;
            padding: 0;
            margin: 0 auto;

            background-color:whitesmoke;
            width: 80%;
            height: auto;
        }
    </style>

@stop


@section('script')
    {{HTML::script('js/Chart.min.js')}}

    <script>
        (function() {
            var data = {{ json_encode($data) }}
            var ctx = document.getElementById('myChart').getContext('2d');
            var myPieChart = new Chart(ctx).Pie(data, { bezierCurve: false,
                animateScale: true,
                multiTooltipTemplate: "<%= datasetLabel %> - <%= value %>"});
            //var myBarChart = new Chart(ctx).Bar(data, { bezierCurve: false});

        })();
    </script>

@stop