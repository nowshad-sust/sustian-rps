@extends('layouts.default')
@section('content')
    @include('includes.alert')

    <aside class="lg-side">
        <div class="inbox-head">
            <h3>View Message</h3>
        </div>
        <div class="inbox-body">
            <div class="heading-inbox row">
                <div class="col-md-8">
                    <div class="compose-btn">
                        <a class="btn btn-sm btn-primary" href="{{route('replyMessage',$messageDetails->id)}}"><i class="fa fa-reply"></i> Reply</a>
                    </div>

                </div>
                <div class="col-md-4 text-right">
                    <p class="date"> {{ date('F d, Y h:i:s A', strtotime($messageDetails->created_at)) }}</p>
                </div>
                <div class="col-md-12">
                    <h4> {{ $messageDetails->subject }}</h4>
                </div>
            </div>
            <div class="sender-info">
                <div class="row">
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
    </aside>


@stop