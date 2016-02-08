@extends('home.add.homelayout')
@section('content')
    @include('includes.alert')

    <div class="register-body">
        <div class="container">
            <div class="col-lg-7 col-sm-7 address">
            {{ Form::open(array('route' =>  'register', 
                                            'method' => 'post',
                                            'class' => 'form-signin',
                                            'onsubmit'=>'return confirm("are you sure you have given the correct registration number?");'
                                            )) }}
            <h2 class="form-signin-heading">User Registration</h2>
            <div class="login-wrap">
                {{ Form::label('fullName', 'Full Name', array('' => '')) }}
                {{ Form::text('fullName', '', array('class' => 'form-control', 'autofocus')) }}
                <br>
                {{ Form::label('reg_no', 'Reg no*', array('' => '')) }}
                <span class="label-info" style="color:white;">fixed once given. your dept
                                                and batch will be extracted from this info. 
                                                so be cautious.</span>
                {{ Form::text('reg_no', null, array('class' => 'form-control', 'autofocus')) }}

                {{ Form::label('email', 'Email', array('' => '')) }}
                {{ Form::text('email', '', array('class' => 'form-control', 'autofocus')) }}

                {{ Form::label('password', 'New Password', array('' => '')) }}
                {{ Form::password('password', array('class' => 'form-control')) }}

                {{ Form::label('password_confirmation', 'Confirm Password', array('' => '')) }}
                {{ Form::password('password_confirmation', array('class' => 'form-control')) }}
                <br>
                {{ Form::submit('Register', array('class' => 'btn btn-lg btn-login btn-info')) }}
            </div>



            {{ Form::close() }}
            </div>

        </div>
    </div>

@stop