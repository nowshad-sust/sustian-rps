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
                                <p>Donec luctus ullamcorper nulla</p>
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
            <h3>Welcome to FlatLab</h3>
            <p>
                Welcome To Avada
                Lid est laborum dolo rumes fugats untras. Etharums ser quidem rerum facilis dolores nemis omnis fugats vitaes nemo minima rerums unsers sadips amets.. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore dolore magnm aliquam quaerat voluptatem.
            </p>
            <p>
                Aenean nibh ante, lacinia non tincidunt nec, lobortis ut tellus. Sed in porta diam. Suspendisse potenti. Donec luctus ullamcorper nulla. Duis nec velit odio.
            </p>
        </div>
    </div>
    <div class="row">
        <div class="hiring">
            <div class="col-lg-6 col-sm-6">
                <div class="icon-wrap ico-bg round">
                    <i class="fa fa-desktop"></i>
                </div>
                <div class="content">
                    <h3 class="title">iOS / Mac OS Developer</h3>
                    <p>Suspendisse dignissim in sem eget pulvinar. Mauris aliquam nulla at libero pretium, eu tincidunt nulla molestie pulvinar posuere.</p>
                </div>
            </div>
            <div class="col-lg-6 col-sm-6">
                <div class="icon-wrap ico-bg round">
                    <i class="fa fa-user"></i>
                </div>
                <div class="content">
                    <h3 class="title">Frontend Developer</h3>
                    <p>Suspendisse dignissim in sem eget pulvinar. Mauris aliquam nulla at libero pretium, eu tincidunt nulla molestie pulvinar posuere.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="gray-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <!--testimonial start-->
                <div class="about-testimonial boxed-style about-flexslider ">
                    <section class="slider">
                        <div class="flexslider">
                            <ul class="slides about-flex-slides">
                                <li>
                                    <div class="about-testimonial-image ">
                                        <img alt="" src="frontend/img/testimonial-img-1.jpg">
                                    </div>
                                    <a class="about-testimonial-author" href="#">Ericson Reagan</a>
                                    <span class="about-testimonial-company">ABC Realestate LLC</span>
                                    <div class="about-testimonial-content">
                                        <p class="about-testimonial-quote">
                                            Pellentesque et pulvinar enim. Quisque at tempor ligula. Maecenas augue ante, euismod vitae egestas sit amet, accumsan eu nulla. Nullam tempor lectus a ligula lobortis pretium. Donec ut purus sed tortor malesuada venenatis eget eget lorem.
                                        </p>
                                    </div>
                                </li>
                                <li>
                                    <div class="about-testimonial-image ">
                                        <img alt="" src="frontend/img/avatar2.jpg">
                                    </div>
                                    <a class="about-testimonial-author" href="#">Jonathan Smith</a>
                                    <span class="about-testimonial-company">DEF LLC</span>
                                    <div class="about-testimonial-content">
                                        <p class="about-testimonial-quote">
                                            Pellentesque et pulvinar enim. Quisque at tempor ligula. Maecenas augue ante, euismod vitae egestas sit amet, accumsan eu nulla. Nullam tempor lectus a ligula lobortis pretium. Donec ut purus sed tortor malesuada venenatis eget eget lorem.
                                        </p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </section>
                </div>
                <!--testimonial end-->
            </div>
            <div class="col-lg-7">
                <h3 class="skills">Our Crazy Skills</h3>
                <div class="about-skill-meter">
                    <div class="progress progress-xs">
                        <div style="width: 60%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="60" role="progressbar" class="progress-bar progress-bar-danger">
                            <span class="sr-only">Web Design : 60% Complete</span>
                        </div>
                    </div>
                </div>
                <div class="about-skill-meter">
                    <div class="progress progress-xs">
                        <div style="width: 90%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="60" role="progressbar" class="progress-bar progress-bar-danger">
                            <span class="sr-only">Html/CSS : 90% Complete</span>
                        </div>
                    </div>
                </div>
                <div class="about-skill-meter">
                    <div class="progress progress-xs">
                        <div style="width: 70%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="60" role="progressbar" class="progress-bar progress-bar-danger">
                            <span class="sr-only">Wordpress : 70% Complete</span>
                        </div>
                    </div>
                </div>
                <div class="about-skill-meter">
                    <div class="progress progress-xs">
                        <div style="width: 55%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="60" role="progressbar" class="progress-bar progress-bar-danger">
                            <span class="sr-only">Graphic Design : 55% Complete</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="text-center feature-head">
            <h1> Meet Our Team </h1>
            <p>We work with forward thinking clients to create beautiful, honest and amazing things that bring positive results.</p>
        </div>
        <div class="col-lg-4">
            <div class="person text-center">
                <img src="frontend/img/team/team_img1.jpg" alt="">
            </div>
            <div class="person-info text-center">
                <h4>
                    <a href="javascript:;">Ericson Reagan</a>
                </h4>
                <p class="text-muted"> Managing Director </p>
                <div class="team-social-link">
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-pinterest"></i></a>
                    <a href="#"><i class="fa fa-linkedin"></i></a>
                    <a href="#"><i class="fa fa-google-plus"></i></a>
                </div>
                <p>Redantium, totam rem aperiam, eaque ipsa qu ab illo inventore veritatis et quasi architectos beatae vitae dicta sunt explicabo. Nemo enims sadips ipsums un.</p>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="person text-center">
                <img src="frontend/img/team/team_img2.jpg" alt="">
            </div>
            <div class="person-info text-center">
                <h4>
                    <a href="javascript:;">Alicja Colon</a>
                </h4>
                <p class="text-muted"> Web Designer </p>
                <div class="team-social-link">
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-pinterest"></i></a>
                    <a href="#"><i class="fa fa-linkedin"></i></a>
                    <a href="#"><i class="fa fa-google-plus"></i></a>
                </div>
                <p>Redantium, totam rem aperiam, eaque ipsa qu ab illo inventore veritatis et quasi architectos beatae vitae dicta sunt explicabo. Nemo enims sadips ipsums un.</p>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="person text-center">
                <img src="frontend/img/team/team_img3.jpg" alt="">
            </div>
            <div class="person-info text-center">
                <h4>
                    <a href="javascript:;">Jonathan Smith</a>
                </h4>
                <p class="text-muted"> Web Developer </p>
                <div class="team-social-link">
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-pinterest"></i></a>
                    <a href="#"><i class="fa fa-linkedin"></i></a>
                    <a href="#"><i class="fa fa-google-plus"></i></a>
                </div>
                <p>Redantium, totam rem aperiam, eaque ipsa qu ab illo inventore veritatis et quasi architectos beatae vitae dicta sunt explicabo. Nemo enims sadips ipsums un.</p>
            </div>
        </div>
    </div>
</div>
<!--container end-->



@stop