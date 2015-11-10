<!--footer start-->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-sm-3">
                <h1>contact info</h1>
                <address>
                    <p>Address: Surma R/A, Akhalia</p>
                    <p>Sylhet city, Bangladesh</p>

                    <p>Email : <a href="javascript:;">sustrps@gmail.com</a></p>
                </address>
            </div>
            <div class="col-lg-5 col-sm-5">
                <h1>A social service site</h1>
                <div class="tweet-box">
                <div class="text-center">
                    <em>2015 &copy; <a target="_blank"href="javascript:;">nowshad</a></em>
                    <br>
                    <em>powered by <a target="_blank"href="javascript:;">SUST CSE Developers Network Lab</a></em>
                    <h6>this site is not related to any official service of SUST. Developed with social responsibility</h6>
                </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-3 col-lg-offset-1">
            
                <h1>stay connected</h1>
                <ul class="social-link-footer list-unstyled">
                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                    <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fa fa-skype"></i></a></li>
                    <li><a href="#"><i class="fa fa-github"></i></a></li>
                    <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<!--footer end-->

<!-- js placed at the end of the document so the pages load faster -->
{{ HTML::script('frontend/js/jquery.js') }}
{{ HTML::script('frontend/js/jquery-migrate-1.2.1.min.js') }}
{{ HTML::script('frontend/js/bootstrap.min.js') }}
{{ HTML::script('frontend/js/hover-dropdown.js') }}
{{ HTML::script('frontend/js/jquery.flexslider.js') }}
{{ HTML::script('frontend/assets/bxslider/jquery.bxslider.js') }}
{{ HTML::script('frontend/js/jquery.parallax-1.1.3.js') }}
{{ HTML::script('frontend/js/jquery.easing.min.js') }}
{{ HTML::script('frontend/js/link-hover.js') }}
{{ HTML::script('frontend/assets/fancybox/source/jquery.fancybox.pack.js') }}
{{ HTML::script('frontend/assets/revolution_slider/rs-plugin/js/jquery.themepunch.plugins.min.js') }}
{{ HTML::script('frontend/assets/revolution_slider/rs-plugin/js/jquery.themepunch.revolution.min.js') }}
{{ HTML::script('frontend/js/common-scripts.js') }}
{{ HTML::script('frontend/js/revulation-slide.js') }}
{{ HTML::script('') }}


<script>

    RevSlide.initRevolutionSlider();

    $(window).load(function() {
        $('[data-zlname = reverse-effect]').mateHover({
            position: 'y-reverse',
            overlayStyle: 'rolling',
            overlayBg: '#fff',
            overlayOpacity: 0.7,
            overlayEasing: 'easeOutCirc',
            rollingPosition: 'top',
            popupEasing: 'easeOutBack',
            popup2Easing: 'easeOutBack'
        });
    });

    $(window).load(function() {
        $('.flexslider').flexslider({
            animation: "slide",
            start: function(slider) {
                $('body').removeClass('loading');
            }
        });
    });

    //    fancybox
    jQuery(".fancybox").fancybox();



</script>