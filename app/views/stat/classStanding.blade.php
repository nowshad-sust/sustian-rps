@extends('layouts.default')
@section('content')
    @include('includes.alert')
    @include('includes.statMenu')

    <div class="panel-body">

        <h2>your position: <strong>{{$standing}}</strong> among {{$comparison}} of your classmates !</h2>

    </div>



@stop

@section('style')
    {{ HTML::style('assets/data-tables/DT_bootstrap.css') }}

@stop