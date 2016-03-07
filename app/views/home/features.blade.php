@extends('home.add.homelayout')
@section('content')
    @include('includes.alert')
    <!--<div class="container">

        <!--<div class="row">
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
                        {{ HTML::image('frontend/img/home/donut_chart_screen.png') }}
                        <div class="mask">
                        <h2 style="color:white;">Overall Class condition</h2>
                            <a data-zl-popup="link2" class="fancybox" rel="group" href="frontend/img/home/donut_chart_screen.png">
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
            </ul>
        </div>
    </div>
    </div>
container end-->

  <section id="container" class="">
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              <section class="panel">
                  <header class="panel-heading">
                      <h3>Features</h3>
                  </header>
                  <div class="panel-body">
                      <ul class="grid cs-style-3">
                          <li>
                              <figure>
                                {{ HTML::image('frontend/img/home/pie_chart_screen.png') }}
                                  <figcaption>
                                      <h3>Subject wise stat</h3>
                                      <span>Shows subject wise results in a pie chart </span>
                                      <a class="fancybox" rel="group" href="frontend/img/home/pie_chart_screen.png">Take a look</a>
                                  </figcaption>
                              </figure>
                          </li>
                          <li>
                              <figure>
                                  {{ HTML::image('frontend/img/home/donut_chart_screen.png') }}
                                  <figcaption>
                                      <h3>Total CGPA stat</h3>
                                      <span>shows the total cgpa map of the class</span>
                                      <a class="fancybox" rel="group" href="frontend/img/home/donut_chart_screen.png">Take a look</a>
                                  </figcaption>
                              </figure>
                          </li>
                          <li>
                              <figure>
                                  {{ HTML::image('frontend/img/home/bar_chart_screen.png') }}
                                  <figcaption>
                                      <h3>subject wise grade</h3>
                                      <span>a bar chart representing grades of subjects</span>
                                      <a class="fancybox" rel="group" href="frontend/img/home/bar_chart_screen.png">Take a look</a>
                                  </figcaption>
                              </figure>
                          </li>
                          <li>
                              <figure>
                                  {{ HTML::image('frontend/img/home/line_chart_screen.png') }}
                                  <figcaption>
                                      <h3>CGPA chart</h3>
                                      <span>shows the flow of cgpa</span>
                                      <a class="fancybox" rel="group" href="frontend/img/home/line_chart_screen.png">Take a look</a>
                                  </figcaption>
                              </figure>
                          </li>
                          <li>
                              <figure>
                                  {{ HTML::image('frontend/img/home/all_results.png') }}
                                  <figcaption>
                                      <h3>Results Presevation</h3>
                                      <span>Keeps your results preserved in a systematic way</span>
                                      <a class="fancybox" rel="group" href="frontend/img/home/all_results.png">Take a look</a>
                                  </figcaption>
                              </figure>
                          </li>
                          <li>
                              <figure>
                                  {{ HTML::image('frontend/img/home/semester_gpa.png') }}
                                  <figcaption>
                                      <h3>GPA & CGPA</h3>
                                      <span>CGPA & GPA in total & semester-wise</span>
                                      <a class="fancybox" rel="group" href="frontend/img/home/semester_gpa.png">Take a look</a>
                                  </figcaption>
                              </figure>
                          </li>
                          <li>
                              <figure>
                                  {{ HTML::image('frontend/img/home/messenger.png') }}
                                  <figcaption>
                                      <h3>Messenger</h3>
                                      <span>A basic messenger with limited use </span>
                                      <a class="fancybox" rel="group" href="frontend/img/home/messenger.png">Take a look</a>
                                  </figcaption>
                              </figure>
                          </li>
                          <li>
                              <figure>
                                  {{ HTML::image('frontend/img/home/posts.png') }}
                                  <figcaption>
                                      <h3>POSTS!</h3>
                                      <span>a group like posting facility</span>
                                      <a class="fancybox" rel="group" href="frontend/img/home/posts.png">Take a look</a>
                                  </figcaption>
                              </figure>
                          </li>
                          <li>
                              <figure>
                                  {{ HTML::image('frontend/img/home/ranking.png') }}
                                  <figcaption>
                                      <h3>Ranking</h3>
                                      <span>a smart way to rank yourself among your classmates </span>
                                      <a class="fancybox" rel="group" href="frontend/img/home/ranking.png">Take a look</a>
                                  </figcaption>
                              </figure>
                          </li>
                      </ul>

                  </div>
              </section>

              <!-- page end-->
          </section>
      </section>
      <!--main content end-->
  </section>
    


@stop


@section('style')

    
    {{ HTML::style('assets/fancybox/source/jquery.fancybox.css') }}
    {{ HTML::style('css/gallery.css') }}


  
@stop

@section('script')
    {{HTML::script('assets/fancybox/source/jquery.fancybox.js')}}
    {{HTML::script('js/modernizr.custom.js')}}

  <script type="text/javascript">
      $(function() {
        //    fancybox
          jQuery(".fancybox").fancybox();
      });

  </script>

@stop