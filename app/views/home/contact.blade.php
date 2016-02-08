@extends('home.add.homelayout')
@section('content')
    

     <!--google map start-->
     <div class="contact-map">
         <div id="map-canvas" style="width: 100%; height: 400px"></div>
     </div>
     <!--google map end-->
     <!--container start-->
    <div class="container">


        <div class="row">
            <div class="col-lg-5 col-sm-5 address">
                <h4>Sylhet</h4>
                <p>
                    SUSTRPS headquarter <br>
                    Surma R/A, Akhalia <br>
                </p>
                <br>
                <br>
                <br>
                <p>
                    <span class="muted">sustrps@gmail.com</span>
                </p>
            </div>
            <div class="col-lg-7 col-sm-7 address">
                <h4>Send a Message</h4>
                @include('includes.alert')
                <div class="contact-form">
                {{ Form:: open(array('role' => 'form',
                					'action' => 'HomeController@postContactUs')) }}
                        <div class="form-group">
                            <label for="name">Name</label>
                            {{ Form::text('username','',array('class'=>'form-control'))}}
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            {{ Form::text('email','',array('class'=>'form-control'))}}
                        </div>
                        <div class="form-group">
                            <label for="phone">Message</label>
                            {{ Form::textarea('message','',array('class'=>'form-control'))}}
                        </div>
                        {{ Form::submit('Submit', array('class' => 'btn btn-lg btn-login btn-block')) }}
                    
                    {{ Form::close() }}

                </div>
            </div>
        </div>

    </div>
    <!--container end-->

@stop



    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&AMP;sensor=false"></script>


  <script>

      //google map
      function initialize() {
          var myLatlng = new google.maps.LatLng(24.9090290, 91.8382000);
          var mapOptions = {
              zoom: 15,
              center: myLatlng,
              mapTypeId: google.maps.MapTypeId.ROADMAP
          }
          var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
          var marker = new google.maps.Marker({
              position: myLatlng,
              map: map,
              title: 'SUSTian RPS headquarter'
          });
      }
      google.maps.event.addDomListener(window, 'load', initialize);



  </script>

      
