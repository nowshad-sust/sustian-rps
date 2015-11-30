@extends('home.add.homelayout')
@section('content')
    

    <!--google map start-->
     <div class="contact-map">
     	<iframe height="350" width="100%" frameborder="1" style="border:0" 
     	src="https://www.google.com/maps/embed/v1/place?q=place_id:ChIJDXicvltVUDcRIFX8P64N47I&key=AIzaSyCmBIZwvl92mFo_jZMTpz3YDp8MXEouPWg"
     	 allowfullscreen></iframe>
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
      
