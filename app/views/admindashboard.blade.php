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
                <div class="custom-bar-chart">
                    <ul class="y-axis">
                        <li><span>100</span></li>
                        <li><span>80</span></li>
                        <li><span>60</span></li>
                        <li><span>40</span></li>
                        <li><span>20</span></li>
                        <li><span>0</span></li>
                    </ul>
                    <div class="bar">
                        <div class="title">JAN</div>
                        <div class="value tooltips" data-original-title="80%" data-toggle="tooltip" data-placement="top" style="height: 80%;"></div>
                    </div>
                    <div class="bar ">
                        <div class="title">FEB</div>
                        <div class="value tooltips" data-original-title="50%" data-toggle="tooltip" data-placement="top" style="height: 50%;"></div>
                    </div>
                    <div class="bar ">
                        <div class="title">MAR</div>
                        <div class="value tooltips" data-original-title="40%" data-toggle="tooltip" data-placement="top" style="height: 40%;"></div>
                    </div>
                    <div class="bar ">
                        <div class="title">APR</div>
                        <div class="value tooltips" data-original-title="55%" data-toggle="tooltip" data-placement="top" style="height: 55%;"></div>
                    </div>
                    <div class="bar">
                        <div class="title">MAY</div>
                        <div class="value tooltips" data-original-title="20%" data-toggle="tooltip" data-placement="top" style="height: 20%;"></div>
                    </div>
                    <div class="bar ">
                        <div class="title">JUN</div>
                        <div class="value tooltips" data-original-title="39%" data-toggle="tooltip" data-placement="top" style="height: 39%;"></div>
                    </div>
                    <div class="bar">
                        <div class="title">JUL</div>
                        <div class="value tooltips" data-original-title="75%" data-toggle="tooltip" data-placement="top" style="height: 75%;"></div>
                    </div>
                    <div class="bar ">
                        <div class="title">AUG</div>
                        <div class="value tooltips" data-original-title="45%" data-toggle="tooltip" data-placement="top" style="height: 45%;"></div>
                    </div>
                    <div class="bar ">
                        <div class="title">SEP</div>
                        <div class="value tooltips" data-original-title="50%" data-toggle="tooltip" data-placement="top" style="height: 50%;"></div>
                    </div>
                    <div class="bar ">
                        <div class="title">OCT</div>
                        <div class="value tooltips" data-original-title="42%" data-toggle="tooltip" data-placement="top" style="height: 42%;"></div>
                    </div>
                    <div class="bar ">
                        <div class="title">NOV</div>
                        <div class="value tooltips" data-original-title="60%" data-toggle="tooltip" data-placement="top" style="height: 60%;"></div>
                    </div>
                    <div class="bar ">
                        <div class="title">DEC</div>
                        <div class="value tooltips" data-original-title="90%" data-toggle="tooltip" data-placement="top" style="height: 90%;"></div>
                    </div>
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