@extends('home.add.homelayout')
@section('content')
    @include('includes.alert')

    <div class="container">
        {{ Form::open(array('route' => 'login', 'method' => 'post', 'class' => 'form-signin')) }}
        <h2 class="form-signin-heading">log in now</h2>
        <div class="login-wrap">

            {{ Form::text('email', '', array('class' => 'form-control', 'placeholder' => 'Email Address', 'autofocus')) }}
            {{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password')) }}

            <label class="checkbox">
                        <span class="pull-left">
		                    <a href="{{route('register')}}">Register</a>
		                </span>
		                <span class="pull-right">
		                    <a data-toggle="modal" href="#myModal"> Forgot Password?</a>
		                </span>
            </label>
            <div class="form-group">
                {{ Form::submit('Log in', array('class' => 'btn btn-lg btn-login btn-success')) }}
            </div>
        </div>




        {{ Form::close() }}

                <!-- Modal -->
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">

                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Forgot Password ?</h4>
                    </div>

                    <div class="modal-body">
                        <p>Enter your e-mail address below to reset your password.</p>


                        {{ Form::open(array('action' => 'RemindersController@postRemind', 'method' => 'post')) }}

                        {{ Form::email('email', '', array('class' => 'form-control placeholder-no-fix', 'placeholder' => 'Email Address', 'autocomplete'=>'off')) }}




                    </div>

                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>

                        {{ Form::submit('Submit', array('class' => 'btn btn-success')) }}
                        {{ Form::close() }}
                    </div>
                </div>
            </div>

        </div>
        <!-- modal -->

    </div>


@stop