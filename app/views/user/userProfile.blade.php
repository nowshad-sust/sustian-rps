@extends('layouts.default')
@section('content')
    @include('includes.alert')
    <section class="panel">
        <div class="twt-feed blue-bg">
            <h1>{{$userInfo->userInfo->fullName}}</h1>
            <a href="#">
                <img src="{{'../'.$userInfo->userInfo->avatar_url}}" alt="">
            </a>
        </div>
        <div class="weather-category twt-category">
            <ul>
                <li>
                    <h4>{{$userInfo->email}}</h4>
                    Email
                </li>
                <li class="active">
                    <h5>{{$userInfo->userInfo->dept->deptName}}</h5>
                    Department
                </li>
                <li>
                    <h5>{{$userInfo->created_at->diffForHumans()}}</h5>
                    Registered since
                </li>
            </ul>
        </div>

    </section>
@stop