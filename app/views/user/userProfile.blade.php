@extends('layouts.default')
@section('content')
    @include('includes.alert')
    <section class="panel">
        <div class="twt-feed blue-bg">
            <h1>{{$userInfo->userInfo->fullName}}</h1>
            <a href="#">
                {{ HTML::image($userInfo->userInfo->avatar_url, 'alt') }}
            </a>
        </div>
        <div class="weather-category twt-category">
            <ul>
                <li>
                    <h4>{{$userInfo->updated_at->diffForHumans()}}</h4>
                    Last activity
                </li>
                <li class="active">
                        @if($userInfo->userInfo->dept_id != null)
                        <h5>{{$userInfo->userInfo->dept->deptName}}</h5>
                        @else
                            <h6>Dept Info not set yet</h6>
                        @endif
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