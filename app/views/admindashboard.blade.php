@extends('layouts.default')
    @section('content')
        @include('includes.alert')

        <!--admin view of dashboard-->
        @if(Entrust::hasRole(Config::get('customConfig.roles.admin')))
        <div class="row state-overview">
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <div class="symbol terques">
                        <i class="fa fa-user"></i>
                    </div>
                    <div class="value">
                        <h1 class="count">{{ $totalUserNumber }}</h1>
                        <p>Total Users</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <div class="symbol red">
                        <i class="fa fa-tags"></i>
                    </div>
                    <div class="value">
                        <h1 class=" count2">{{ $totalResultNumber }}</h1>
                        <p>Total added results</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <div class="symbol yellow">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                    <div class="value">
                        <h1 class=" count3">328</h1>
                        <p>New Order</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <div class="symbol blue">
                        <i class="fa fa-bar-chart-o"></i>
                    </div>
                    <div class="value">
                        <h1 class=" count4">10328</h1>
                        <p>Total Profit</p>
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
                <script>
(function(w,d,s,g,js,fs){
  g=w.gapi||(w.gapi={});g.analytics={q:[],ready:function(f){this.q.push(f);}};
  js=d.createElement(s);fs=d.getElementsByTagName(s)[0];
  js.src='https://apis.google.com/js/platform.js';
  fs.parentNode.insertBefore(js,fs);js.onload=function(){g.load('analytics');};
}(window,document,'script'));
</script>
                <div class="custom-bar-chart">
                    <div id="embed-api-auth-container"></div>
<div id="chart-container"></div>
<div id="view-selector-container"></div>
                </div>
                <!--custom chart end-->
            </div>
            <div class="col-lg-4">
                <!--new earning start-->
                <div class="panel terques-chart">
                    <div class="panel-body chart-texture">
                        <div class="chart">
                            <div class="heading">
                                <span>Friday</span>
                                <strong>$ 57,00 | 15%</strong>
                            </div>
                            <div class="sparkline" data-type="line" data-resize="true" data-height="75" data-width="90%" data-line-width="1" data-line-color="#fff" data-spot-color="#fff" data-fill-color="" data-highlight-line-color="#fff" data-spot-radius="4" data-data="[200,135,667,333,526,996,564,123,890,564,455]"><canvas style="display: inline-block; width: 293px; height: 75px; vertical-align: top;" width="293" height="75"></canvas></div>
                        </div>
                    </div>
                    <div class="chart-tittle">
                        <span class="title">New Earning</span>
                              <span class="value">
                                  <a href="#" class="active">Market</a>
                                  |
                                  <a href="#">Referal</a>
                                  |
                                  <a href="#">Online</a>
                              </span>
                    </div>
                </div>
                <!--new earning end-->

                <!--total earning start-->
                <div class="panel green-chart">
                    <div class="panel-body">
                        <div class="chart">
                            <div class="heading">
                                <span>June</span>
                                <strong>23 Days | 65%</strong>
                            </div>
                            <div id="barchart"><canvas width="294" height="65" style="display: inline-block; width: 294px; height: 65px; vertical-align: top;"></canvas></div>
                        </div>
                    </div>
                    <div class="chart-tittle">
                        <span class="title">Total Earning</span>
                        <span class="value">$, 76,54,678</span>
                    </div>
                </div>
                <!--total earning end-->
            </div>
        </div>
        @endif
@stop

@section('script')

<!--
    counting effect animation
    {{HTML::script('js/count.js')}}

    <script type="text/javascript">
        countUp();
    </script>
-->

<script>

gapi.analytics.ready(function() {

  /**
   * Authorize the user immediately if the user has already granted access.
   * If no access has been created, render an authorize button inside the
   * element with the ID "embed-api-auth-container".
   */
  gapi.analytics.auth.authorize({
    container: 'embed-api-auth-container',
    clientid: '1035808706718-o50h8nb0pml54l5e6c9cjtm7csqdbiob.apps.googleusercontent.com'
  });


  /**
   * Create a new ViewSelector instance to be rendered inside of an
   * element with the id "view-selector-container".
   */
  var viewSelector = new gapi.analytics.ViewSelector({
    container: 'view-selector-container'
  });

  // Render the view selector to the page.
  viewSelector.execute();


  /**
   * Create a new DataChart instance with the given query parameters
   * and Google chart options. It will be rendered inside an element
   * with the id "chart-container".
   */
  var dataChart = new gapi.analytics.googleCharts.DataChart({
    query: {
      metrics: 'ga:sessions',
      dimensions: 'ga:date',
      'start-date': '30daysAgo',
      'end-date': 'yesterday'
    },
    chart: {
      container: 'chart-container',
      type: 'LINE',
      options: {
        width: '100%'
      }
    }
  });


  /**
   * Render the dataChart on the page whenever a new view is selected.
   */
  viewSelector.on('change', function(ids) {
    dataChart.set({query: {ids: ids}}).execute();
  });

});
</script>
@stop