@extends('home.add.homelayout')
@section('content')
    @include('includes.alert')

    <!-- revolution slider start -->
    <div class="fullwidthbanner-container main-slider">
        <div class="fullwidthabnner">
            <ul id="revolutionul" style="display:none;">
                <!-- 1st slide -->
                <li data-transition="fade" data-slotamount="8" data-masterspeed="700" data-delay="9400" data-thumb="">
                    <div class="caption lfl slide_item_left"
                         data-x="10"
                         data-y="70"
                         data-speed="400"
                         data-start="1500"
                         data-easing="easeOutBack">
                        <img src="frontend/img/banner/ban2.png" alt="Image 1">
                    </div>
                    <div class="caption lfr slide_title"
                         data-x="670"
                         data-y="120"
                         data-speed="400"
                         data-start="1000"
                         data-easing="easeOutExpo">
                        SUSTian Result Processing Service
                    </div>

                    <div class="caption lfr slide_subtitle dark-text"
                         data-x="670"
                         data-y="190"
                         data-speed="400"
                         data-start="2000"
                         data-easing="easeOutExpo">
                        শুধুমাত্র ছাত্রছাত্রীদের জন্য নির্মিত একটি সেবা
                    </div>
                    <div class="caption lfr slide_desc"
                         data-x="670"
                         data-y="260"
                         data-speed="400"
                         data-start="2500"
                         data-easing="easeOutExpo">
                        আপনার ফলাফল সংগঠিত রাখা এবং আপনার অবস্থা সম্পর্কে আপনাকে  সচেতন রাখতেই
                        <br> রয়েছে SUSTian RPS আপনার সেবায় ।
                        
                    </div>
                    <a class="caption lfr btn yellow slide_btn"
                    href="{{ route('features') }}"
                       data-x="670"
                       data-y="400"
                       data-speed="400"
                       data-start="3500"
                       data-easing="easeOutExpo">
                        ফিচারসমুহ দেখুন
                    </a>

                </li>

                <!-- 2nd slide  -->
                <li data-transition="fade" data-slotamount="8" data-masterspeed="700" data-delay="9400" data-thumb="">
                    <!-- THE MAIN IMAGE IN THE FIRST SLIDE -->
                    <img src="img/banner/banner_bg.jpg" alt="">
                    <div class="caption lft slide_title"
                         data-x="10"
                         data-y="125"
                         data-speed="400"
                         data-start="1500"
                         data-easing="easeOutExpo">
                        ইয়াহু... পেয়েছি!
                    </div>
                    <div class="caption lft slide_desc dark-text"
                         data-x="10"
                         data-y="240"
                         data-speed="400"
                         data-start="2500"
                         data-easing="easeOutExpo">
                        হ্যাঁ, আপনাকে আর আপনার ফলাফল সংরক্ষণ এর জন্য ফাইল এ সেভ করে রাখতে হবে না,
                        ফাইল ডিলিট হয়ে যাবার ভয় করতে হবে না ।
                        <br>
                        প্রয়োজন হবে না ক্যালকুলেটরের বাটন চাপতে
                        চাপতে ক্লান্ত হবার অথবা নিজের অবথস্থান জানতে বাকিদের ফলাফল নিয়ে মাথা ঘামানোর।
                        <br>
                        আপনার জন্য সব'ই করে দিবে SUSTian RPS ।
                    </div>
                    <a class="caption lft slide_btn btn red slide_item_left" 
                       href="{{ route('register') }}"
                       data-x="10"
                       data-y="360"
                       data-speed="400"
                       data-start="3000"
                       data-easing="easeOutExpo">
                        রেজিস্টার করুন
                    </a>
                    <div class="caption lft start"
                         data-x="640"
                         data-y="55"
                         data-speed="400"
                         data-start="2000"
                         data-easing="easeOutBack"  >
                        <img src="frontend/img/banner/man.png" alt="man">
                    </div>
                    <div class="caption lft slide_item_right"
                         data-x="330"
                         data-y="20"
                         data-speed="500"
                         data-start="5000"
                         data-easing="easeOutBack">
                        <img src="frontend/img/banner/test_man.png" id="rev-hint2" alt="txt img">
                    </div>

                </li>

                <!-- 3rd slide  -->
                <li data-transition="fade" data-slotamount="7" data-masterspeed="300" data-delay="9400" data-thumb="">
                    <img src="frontend/img/banner/red-bg.jpg" alt="">
                    <div class="caption lfl slide_item_right"
                         data-x="10"
                         data-y="105"
                         data-speed="1200"
                         data-start="1500"
                         data-easing="easeOutBack">
                        <img src="frontend/img/banner/imac.png" alt="Image 1">
                    </div>
                    <div class="caption lfl slide_item_right"
                         data-x="25"
                         data-y="345"
                         data-speed="1200"
                         data-start="2000"
                         data-easing="easeOutBack">
                        <img src="frontend/img/banner/tab.png" alt="Image 1">
                    </div>
                    <div class="caption lfl slide_item_right"
                         data-x="200"
                         data-y="330"
                         data-speed="1200"
                         data-start="2500"
                         data-easing="easeOutBack">
                        <img src="frontend/img/banner/mobile.png" alt="Image 1">
                    </div>
                    <div class="caption lfl slide_item_right"
                         data-x="250"
                         data-y="230"
                         data-speed="1200"
                         data-start="3000"
                         data-easing="easeOutBack">
                        <img src="frontend/img/banner/laptop.png" alt="Image 1">
                    </div>
                    <div class="caption lfl slide_item_right"
                         data-x="165"
                         data-y="30"
                         data-speed="500"
                         data-start="5000"
                         data-easing="easeOutBack">
                        <img src="frontend/img/banner/text_imac.png" id="rev-hint1" alt="Image 1">
                    </div>

                    <div class="caption lfr slide_title slide_item_left yellow-txt"
                         data-x="670"
                         data-y="145"
                         data-speed="400"
                         data-start="3500"
                         data-easing="easeOutExpo">
                        উন্নত পরিসংখ্যান
                    </div>
                    <div class="caption lfr slide_subtitle slide_item_left"
                         data-x="670"
                         data-y="200"
                         data-speed="400"
                         data-start="4000"
                         data-easing="easeOutExpo">
                        এবং চাক্ষুষ তথ্য
                    </div>
                    <div class="caption lfr slide_desc slide_item_left"
                         data-x="670"
                         data-y="280"
                         data-speed="400"
                         data-start="4500"
                         data-easing="easeOutExpo">
                        আপনার বর্তমান অবস্থা সম্পর্কে আপনি জানতে পারবেন
                        <br>
                        সেইসাথে আপনার ব্যাচ এ আপনার অবস্থান দেখতে পারবেন
                        <br>
                        বিভিন্ন চার্ট / গ্রাফ থেকে বিশদ ধারনা পেতে পারেন ।
                    </div>


                </li>

            </ul>
            <div class="tp-bannertimer tp-top"></div>
        </div>
    </div>
    <!-- revolution slider end -->

<!--container start-->
<div class="container">
    <div class="row">
        <!--feature start-->
        <div class="text-center feature-head">
            <h1>স্বাগতম সাস্টিয়ান রেজাল্ট প্রোসেসিং সিস্টেম এ</h1>
            <p>সাস্টিয়ানদের জন্য নির্মিত একটি সেবা</p>
        </div>
        <!--feature end-->
    </div>
    <div class="row">
        <!--quote start-->
        <div class="quote">
            <div class="col-lg-9 col-sm-9">
                <div class="quote-info">
                    <h1>এটি আপনারই জন্য</h1>
                    <p>
                        খুবই সহজ এবং সাধারণ ব্যাবহার, গুরুত্বপূর্ণ পরিসংখ্যান এবং উপাত্ত আপনার ছাত্রজীবনকে করবে উন্নত।
                         ফলাফল সামলানো নিয়ে কষ্টের দিন শেষ :)
                    </p>
                        
                </div>
            </div>
            <div class="col-lg-3 col-sm-3">
                <a href="{{ route('register') }}" class="btn btn-danger purchase-btn">এখনই নিবন্ধন করুন</a>
            </div>
        </div>
        <!--quote end-->
    </div>
</div>


<!--parallax start-->
<section class="parallax1">
    <div class="container">
        <div class="row">
            <h2 class="text-center">আজকের উক্তি</h2>
            <h1>“Remember that people will always question the good things they hear about you,
                and believe the bad ones without a second thought.”</h1>
        </div>
    </div>
</section>
<!--parallax end-->

@stop