@extends('home.add.homelayout')
@section('content')
    @include('includes.alert')
<div class="container">

    <!--recent work start-->
    <div class="row">
        <div class="col-lg-12">
            <h2 class="r-work">Features</h2>
            <ul class="bxslider">
                <li>
                    <div class="element item view view-tenth" data-zlname="reverse-effect">
                        {{ HTML::image('frontend/img/home/all_results.png') }}
                        <div class="mask">
                        	<h2 style="color:white;">Keeping your data organized</h2>
                            <a data-zl-popup="link2" class="fancybox" rel="group" href="frontend/img/home/all_results.png">
                                <i class="fa fa-search"></i>
                            </a>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="element item view view-tenth" data-zlname="reverse-effect">
                        {{ HTML::image('frontend/img/home/semester_gpa.png') }}
                        <div class="mask">
                        <h2 style="color:white;">CGPA and GPA calculator</h2>
                            <a data-zl-popup="link2" class="fancybox" rel="group" href="frontend/img/home/semester_gpa.png">
                                <i class="fa fa-search"></i>
                            </a>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="element item view view-tenth" data-zlname="reverse-effect">
                        {{ HTML::image('frontend/img/home/line_chart_screen.png') }}
                        <div class="mask">
                        <h2 style="color:white;">CGPA & GPA progress chart</h2>
                            <a data-zl-popup="link2" class="fancybox" rel="group" href="frontend/img/home/line_chart_screen.png">
                                <i class="fa fa-search"></i>
                            </a>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="element item view view-tenth" data-zlname="reverse-effect">
                        {{ HTML::image('frontend/img/home/bar_chart_screen.png') }}
                        <div class="mask">
                        <h2 style="color:white;">Course and grade results</h2>
                            <a data-zl-popup="link2" class="fancybox" rel="group" href="frontend/img/home/bar_chart_screen.png">
                                <i class="fa fa-search"></i>
                            </a>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="element item view view-tenth" data-zlname="reverse-effect">
                        {{ HTML::image('frontend/img/home/bar_chart_screen.png') }}
                        <div class="mask">
                        <h2 style="color:white;">Overall Class condition</h2>
                            <a data-zl-popup="link2" class="fancybox" rel="group" href="frontend/img/works/img6.jpg">
                                <i class="fa fa-search"></i>
                            </a>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="element item view view-tenth" data-zlname="reverse-effect">
                        {{ HTML::image('frontend/img/home/pie_chart_screen.png') }}
                        <div class="mask">
                        <h2 style="color:white;">Course-wise class statistics</h2>
                            <a data-zl-popup="link2" class="fancybox" rel="group" href="frontend/img/home/pie_chart_screen.png">
                                <i class="fa fa-search"></i>
                            </a>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="element item view view-tenth" data-zlname="reverse-effect">
                        {{ HTML::image('frontend/img/home/donut_chart_screen.png') }}
                        <div class="mask">
                            <a data-zl-popup="link2" class="fancybox" rel="group" href="frontend/img/home/donut_chart_screen.png">
                                <i class="fa fa-search"></i>
                            </a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <!--recent work end-->

</div>
<!--container end-->

@stop