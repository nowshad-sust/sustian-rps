@extends('layouts.default')
@section('content')
    @include('includes.alert')
    <canvas id="myChart" width="400" height="400"></canvas>

@stop

@section('style')

@stop


@section('script')
    {{HTML::script('js/Chart.min.js')}}

    <script>
        (function() {
            var data = {
                labels: ["January", "February", "March", "April", "May", "June", "July"],
                datasets: [
                    {
                        label: "My First dataset",
                        fillColor: "rgba(220,220,220,0.2)",
                        strokeColor: "rgba(220,220,220,1)",
                        pointColor: "rgba(220,220,220,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(220,220,220,1)",
                        data: [65, 59, 80, 81, 56, 55, 40]
                    },
                    {
                        label: "My Second dataset",
                        fillColor: "rgba(151,187,205,0.2)",
                        strokeColor: "rgba(151,187,205,1)",
                        pointColor: "rgba(151,187,205,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(151,187,205,1)",
                        data: [28, 48, 40, 19, 86, 27, 90]
                    }
                ]
            };
            var ctx = document.getElementById('myChart').getContext('2d');
            var chart = {
                labels: 'chart',
                datasets: [{
                    data: [65, 59, 80, 81, 56, 55, 40],
                    fillColor : "#f8b1aa",
                    strokeColor : "#bb574e",
                    pointColor : "#bb574e"
                }]
            };
            new Chart(ctx).Bar(data, { bezierCurve: false });
        })();
    </script>

@stop