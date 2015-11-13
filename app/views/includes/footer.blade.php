    <!--footer start-->
    <footer class="site-footer">
          <div class="text-center">
              <h6>2015 &copy;
              <a target="_blank" style="color: lightyellow;" href="http://nowshad.iit.space"> Nowshad</a></h6>
              <h5>Powered by <a target="_blank" style="color: snow;" href="http://scdnlab.com"> SCDN Lab</a></h5>
              <h6>[ this site is not related to any official service of SUST.]</h6>
                <a href="#" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>

      </footer>
    <!--footer end-->

</section>

  	{{ HTML::script('js/jquery.js') }}
  	{{ HTML::script('js/bootstrap.min.js') }}
  	{{ HTML::script('js/jquery.dcjqaccordion.2.7.js', array('class' => 'include')) }}
  	{{ HTML::script('js/jquery.scrollTo.min.js') }}
  	{{ HTML::script('js/jquery.nicescroll.js') }}
  	{{ HTML::script('js/respond.min.js') }}
    {{ HTML::script('js/slidebars.min.js') }}
  	{{ HTML::script('js/common-scripts.js') }}
  	@yield('script')
  	{{ HTML::script('js/custom.js') }}

    

