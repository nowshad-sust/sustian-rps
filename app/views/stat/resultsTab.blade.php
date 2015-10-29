@extends('layouts.default')
@section('content')
    @include('includes.alert')

<section class="panel">
    <header class="panel-heading tab-bg-dark-navy-blue">
        <ul class="nav nav-tabs nav-justified ">
            <li class="active">
                <a href="#popular" data-toggle="tab" aria-expanded="true">
                    Popular
                </a>
            </li>
            <li class="">
                <a href="#comments" data-toggle="tab" aria-expanded="false">
                    Comments
                </a>
            </li>
            <li class="">
                <a href="#recent" data-toggle="tab" aria-expanded="false">
                    Recents
                </a>
            </li>
        </ul>
    </header>
    <div class="panel-body">
        <div class="tab-content tasi-tab">
            <div class="tab-pane active" id="popular">
                <article class="media">



                </article>
            </div>
            <div class="tab-pane" id="comments">
                <article class="media">
                    <a class="pull-left thumb p-thumb">
                        <img src="img/avatar-mini.jpg">
                    </a>
                    <div class="media-body">
                        <a class="cmt-head" href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a>
                        <p> <i class="fa fa-clock-o"></i> 1 hours ago</p>
                    </div>
                </article>
                <article class="media">
                    <a class="pull-left thumb p-thumb">
                        <img src="img/avatar-mini2.jpg">
                    </a>
                    <div class="media-body">
                        <a class="cmt-head" href="#">Nulla vel metus scelerisque ante sollicitudin commodo</a>
                        <p> <i class="fa fa-clock-o"></i> 23 mins ago</p>
                    </div>
                </article>
                <article class="media">
                    <a class="pull-left thumb p-thumb">
                        <img src="img/avatar-mini3.jpg">
                    </a>
                    <div class="media-body">
                        <a class="cmt-head" href="#">Donec lacinia congue felis in faucibus. </a>
                        <p> <i class="fa fa-clock-o"></i> 15 mins ago</p>
                    </div>
                </article>
            </div>
            <div class="tab-pane" id="recent">
                Recent Item goes here
            </div>
        </div>
    </div>
</section>

    @stop