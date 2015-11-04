@extends('layouts.default')
@section('content')
    @include('includes.alert')

    <aside class="lg-side">
        <div class="inbox-head">
            <h2>Reply</h2>
        </div>
        <div class="inbox-body">
            <div class="sender-info">
                <div class="row">
                    <div class="text-right">
                        <p class="date"> {{ date('F d, Y h:i:s A', strtotime($messageDetails->created_at)) }}</p>
                    </div>
                    <div class="col-md-12">
                        {{ HTML::image($senderInfo->userInfo->icon_url, 'alt', array( 'width' => 35, 'height' => 35 )) }}
                        <strong>{{ $senderInfo->userInfo->fullName }}</strong>
                        to
                        <strong>me</strong>
                    </div>
                </div>
            </div>

            <div class="view-mail">
                {{ $messageDetails->message }}
            </div>
        </div>
        <div class="col-md-8">
            {{ Form::open( array('route' => 'postReply', 'method' => 'post', 'role' => 'form')) }}

            <h4 class="form-signin-heading">Reply</h4>
            <div class="panel-body">

                {{ Form::label('subject', 'Subject', array('' => '')) }}
                {{ Form::text('subject', null, array('class' => 'form-control', 'autofocus')) }}

                {{ Form::label('message', 'Message', array('' => '')) }}
                {{ Form::textarea('message', null, array('class' => 'form-control', 'autofocus')) }}
                        <!-- posting the sender id as the receiver id of the reply -->
                {{ Form::hidden('to',$senderInfo->id) }}
                {{ Form::submit('Send', array('class' => 'btn btn-lg btn-login btn-block')) }}
            </div>

            {{ Form::close() }}

        </div>
    </aside>


@stop
