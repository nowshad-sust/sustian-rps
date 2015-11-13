@extends('home.add.homelayout')
@section('content')
    @include('includes.alert')


<!--container start-->
<div class="container">
    <div class="row">
        <div class="col-lg-5">
            <div class="span5 about-carousel">
                <div id="myCarousel" class="carousel slide">
                    <!-- Carousel items -->
                    <div class="carousel-inner">
                        <div class="active item">
                        {{ HTML::image('frontend/img/home/all_results.png') }}
                            <div class="carousel-caption">
                                <p>Result Processing Service</p>
                            </div>
                        </div>
                        <div class="item">
                        {{ HTML::image('frontend/img/home/line_chart_screen.png') }}
                            <div class="carousel-caption">
                                <p>Result based charts</p>
                            </div>
                        </div>
                        <div class="item">
                        {{ HTML::image('frontend/img/home/semester_gpa.png') }}
                            <div class="carousel-caption">
                                <p>CGPA and GPA Calculator</p>
                            </div>
                        </div>
                    </div>
                    <!-- Carousel nav -->
                    <a class="carousel-control left" href="#myCarousel" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a class="carousel-control right" href="#myCarousel" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-7 about">
            <h3>Welcome to SUST RPS</h3>
            <p>
                This is a service for the students of SUST. As course results gets added to our calculations, we find it
                harer to manage course informations, results, drop etc. So, thought to make something that'll make
                the task easier and student friendly. From that thought the SUSTian Rps project begin and here it is
                in it's child version. Hopefully this will help you to get more organised and aware of your
                condition. 
           </p>
            <p>
                This is a place where you can store your course results and manage them properly.
                By watching different relevent stats you certainly can understand details of your current progress.
                Also, we provide you with some visul data which can be a good use for students who want to see
                long term stats.
            </p>
        </div>
    </div>

@stop