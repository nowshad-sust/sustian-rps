@extends('layouts.default')
    @section('content')
        @include('includes.alert')

        <!--admin view of dashboard-->
        @if(Entrust::hasRole(Config::get('customConfig.roles.admin')))
        <div class="row state-overview">
        <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <div class="symbol blue">
                        <i class="fa fa-bar-chart-o"></i>
                    </div>
                    <div class="value">
                        <h1 class=" count4">{{$resgisteredUserNumber-1}}</h1>
                        <p>Total registered users</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <div class="symbol terques">
                        <i class="fa fa-user"></i>
                    </div>
                    <div class="value">
                        <h1 class="count">{{ $totalUserNumber }}</h1>
                        <p>Total Activated Users</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <div class="symbol red">
                        <i class="fa fa-tags"></i>
                    </div>
                    <div class="value">
                        <h1 class=" count2">{{$totalInactiveUserNumber}}</h1>
                        <p>Inactive Users</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <div class="symbol yellow">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                    <div class="value">
                        <h1 class=" count3">{{ $totalResultNumber }}</h1>
                        <p>Total added results</p>
                    </div>
                </section>
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
@stop