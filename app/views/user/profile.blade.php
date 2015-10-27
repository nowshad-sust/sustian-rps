@extends('layouts.default')
@section('content')
    @include('includes.alert')

    <div class="col-md-9">
        <section class="panel">
            <div class="panel-body">
                <div class="col-md-6">
                    <div class="pro-img-details">
                        <img src="{{Auth::user()->userInfo->avatar_url}}" alt="">
                        <a href="{{route('uploadAvatar')}}"><button type="button" class="btn btn-info"><i class="fa fa-image"></i> Change Profile Image</button></a>
                    </div>
                </div>
                <div class="col-md-6">
                    <h4 class="pro-d-title">
                        {{Auth::user()->userInfo->fullName}}
                    </h4>
                    <h5>
                        {{Auth::user()->email}}
                    </h5>
                    <div class="product_meta">
                        <span class="posted_in"> <strong>Reg no: </strong> {{Auth::user()->userInfo->reg_no}}</span>
                        <span class="tagged_as"><strong>Batch: </strong> {{Auth::user()->userInfo->batch}}</span>

                    </div>
                    <div class="m-bot15"> <strong>Department: </strong> <span>{{Auth::user()->userInfo->dept}}</span></div>
                    <p>
                        <a href="{{route('updateProfile')}}"><button class="btn btn-round btn-danger" type="button"><i class="fa fa-pencil"></i> Edit Profile</button></a>
                    </p>
                </div>
            </div>
        </section>
    </div>
@stop