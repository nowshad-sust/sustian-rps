@extends('layouts.default')
@section('content')
    @include('includes.alert')

    <section class="panel">
        @include('includes.chartmenu')

        @if($data!=null)
            <div class="panel-body">
                <div class="tab-content tasi-tab">
                    <div class="tab-pane active" id="popular">
                        <article class="media">
                            <h4 class="text-center">Class CGPA Population</h4>
                            <h5 class="text-center">{{$course_title}}</h5>
                            @if($result_self)
                            <h6 class="text-center"> <b>Your Result:</b> {{ $result_self->grade_letter }}</h6>
                            @else
                            <h6 class="text-center"> <b> You have not entered resutlt of this course</b></h6>
                            @endif
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
                            <h4 class="text-center">course data not found!</h4>
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