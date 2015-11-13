@extends('layouts.default')
@section('content')
    @include('includes.alert')

    <h3 class="text-center">Classmates</h3>
    <h5 class="text-center">{{$classmatesInfo[0]->dept->dept}} - {{$classmatesInfo[0]->batch->batch}}</h5>
    <div class="directory-info-row">
            <div class="row">
              @foreach($classmatesInfo as $Info)
              <div class="col-md-6 col-sm-6">
                  <div class="panel">
                      <div class="panel-body">
                          <div class="media">
                              <a class="pull-left" href="{{ URL::route('showProfile',$Info->user_id) }}">
                                  <img class="thumb media-object" src="{{'../'.$Info->avatar_url}}" alt="">
                              </a>

                              <div class="media-body">
                                  <h4>{{$Info->fullName}} <span class="text-muted small">
                                  </span></h4>
                                  <!--
                                  <ul class="social-links">
                                      <li><a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Facebook"><i class="fa fa-facebook"></i></a></li>
                                      <li><a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Twitter"><i class="fa fa-twitter"></i></a></li>
                                      <li><a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="LinkedIn"><i class="fa fa-linkedin"></i></a></li>
                                      <li><a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Skype"><i class="fa fa-skype"></i></a></li>
                                  </ul>
                                  -->
                                  <address>
                                      registered {{$Info->created_at->diffForHumans()}}
                                  </address>
                                <a class="btn btn-primary" href="{{ URL::route('showProfile',$Info->user_id) }}">details</a>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              @endforeach

          </div>
    </div>

@stop