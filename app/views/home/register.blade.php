@extends('home.add.homelayout')
@section('content')
    @include('includes.alert')

    <div class="register-body">
        <div class="container">
            {{ Form::open(array('route' =>  'register', 
                                            'method' => 'post',
                                            'class' => 'form-signin',
                                            'onsubmit'=>'return confirm("Have you checked your Reg no?");'
                                            )) }}
            <h2 class="form-signin-heading">User Registration</h2>
            <div class="login-wrap">
                {{ Form::label('fullName', 'Full Name', array('' => '')) }}
                {{ Form::text('fullName', '', array('class' => 'form-control', 'placeholder' => 'Mario Gomez', 'autofocus')) }}

                {{ Form::label('reg_no', 'Reg no* (fixed once given)', array('' => '')) }}
                {{ Form::text('reg_no', null, array('class' => 'form-control', 'placeholder' => '20********','autofocus')) }}

                {{ Form::label('email', 'Email', array('' => '')) }}
                {{ Form::text('email', '', array('class' => 'form-control', 'placeholder' => 'Email Address', 'autofocus')) }}

                {{ Form::label('password', 'New Password', array('' => '')) }}
                {{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'New Password')) }}

                {{ Form::label('password_confirmation', 'Confirm Password', array('' => '')) }}
                {{ Form::password('password_confirmation', array('class' => 'form-control', 'placeholder' => 'Confirm Password')) }}
                <br>
                {{ Form::submit('Register', array('class' => 'btn btn-lg btn-login btn-info')) }}
            </div>



            {{ Form::close() }}


        </div>
    </div>

@stop