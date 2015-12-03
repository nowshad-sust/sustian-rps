@extends('layouts.default')
@section('content')
    @include('includes.alert')
    @include('includes.statMenu')

    <div class="panel-body">

        <h2>your position: <strong>{{$standing}}</strong> among {{$comparison}} of your classmates !</h2>

    </div>
    <div class="row">
                  <div class="col-md-12">

                      <div class="row product-list">

                      	@foreach($RankingDetails as $key=>$value)
                          <div class="col-md-2">
                              <section class="panel">
                                  <div class="pro-img-box">
                                      {{ HTML::image($value['info']->avatar_url, 'alt',array()) }}
                                      <h2 class="adtocart text-center" style="left:35%;">
                                          {{$value['rank']}}
                                      </h2>
                                  </div>

                                  @if($key == Auth::user()->id)
                                  <div style="height:70px;" class="panel-body text-center bg-info">
                                  @else
                                  <div style="height:70px;" class="panel-body text-center bg-success">
                                  @endif
                                      <p>
                                          {{$value['info']->fullName}}
                                      </p>
                                  </div>
                              </section>
                          </div>
                      @endforeach
                      </div>
                  </div>
              </div>


@stop