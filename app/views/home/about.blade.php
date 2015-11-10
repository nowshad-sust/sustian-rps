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
                            <img src="frontend/img/about_1.jpg" alt="">
                            <div class="carousel-caption">
                                <p>SUST Result Processing Service</p>
                            </div>
                        </div>
                        <div class="item">
                            <img src="frontend/img/about_2.jpg" alt="">
                            <div class="carousel-caption">
                                <p>Blanditiis praesentium voluptatum</p>
                            </div>
                        </div>
                        <div class="item">
                            <img src="frontend/img/about_1.jpg" alt="">
                            <div class="carousel-caption">
                                <p>Honest and amazing things that bring positive results</p>
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
                This is a place where you can store your course wise results and manage them properly.
                By watching different relevent stats you certainly can understand details of your current progress.
                Also, we provide you with some visul data which can be a good use for students who want to see
                long term stats.
            </p>
            <p>
                Aenean nibh ante, lacinia non tincidunt nec, lobortis ut tellus. Sed in porta diam. Suspendisse potenti. Donec luctus ullamcorper nulla. Duis nec velit odio.
            </p>
        </div>
    </div>

@stop