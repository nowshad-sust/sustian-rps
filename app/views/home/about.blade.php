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
            <h3>Welcome to SUSTian Result Processing Service</h3>
            <p>
                এটি শাবিপ্রবির ছাত্র-ছাত্রিদের  জন্য একটি সেবা । আমাদের বিশ্ববিদ্যালয় জীবনে যত দিন যেতে থাকে
                রেসাল্টের সংখ্যাও তত বাড়তে থাকে । ফলে হিসেব রাখা কষ্টকর হয়ে যায় অনেক ক্ষেত্রেই এবং এই কারণে
                অনেকেই ফলাফল সংক্রান্ত হিসেব-নিকেশ না করায় নিজেদের পরিস্থিতি সম্পর্কে জানে না । কিন্তু নিজেদের
                অবস্থা স্মপর্কে সচেতন থাকা সবার জন্যই প্রয়োজনীয় । তাই ছাত্র-ছাত্রিদের সুবিধার কথা চিন্তা করেই
                সম্পূর্ণ আনঅফিসিয়াল একটি সার্ভিসের অভাব থেকেই SUSTian RPS এর জন্ম ।

            </p>
            <p>
                এই প্রজেক্টটি কোনরূপ অফিশিয়াল সার্ভিসের সাথে সরাসরি যুক্ত নয় । সাইটটি তৈরি, রক্ষণাবেক্ষণ, ডাটা প্রাদানসহ
                সকল কাজই ছাত্রদের দ্বারা পরিচালিত হয় । এখানে আপনার সকল তথ্য নিরাপদ কারণ - অন্য কোন ব্যবহারকারী আপনার
                কোন তথ্য দেখতে বা ব্যবহার করতে পারবে না । সুতরাং আপনার তথ্য-উপাত্তের উৎসও আপনি নিজেই , ব্যবহারকারিও
                আপনি । আপনার তথ্যের জন্য অন্য কেউ দায়বদ্ধ নয় । 
            </p>
        </div>
    </div>

@stop