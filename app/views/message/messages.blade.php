@extends('layouts.default')
@section('content')
    @include('includes.alert')

<div class="chat-room">
                  <aside class="left-side">
                      <div class="user-head">
                          <i class="fa fa-comments-o"></i>
                          <h3>Messages</h3>
                      </div>
                      <ul class="chat-list">
                          <li class="">
                              <a class="lobby">
                                  <h4>
                                      <i class="fa fa-list"></i>
                                      History
                                  </h4>
                              </a>
                          </li>

                      </ul>
                      
                      <ul class="chat-list chat-user" style="height: 35vh; overflow: auto">
                        @foreach($threads as $thread)
                          @if(Route::getCurrentRoute()->getParameter('thread_id') == $thread->id)
                          <li class="active">
                          @else
                          <li>
                          @endif
                              <a href="{{ route('messages.view',$thread->id) }}">
                                  @if($thread->owner1_id != Auth::user()->id)
                                  {{ HTML::image($thread->owner1->userInfo->icon_url, '', array( 'width' => 35, 'height' => 35,'class'=>'img-circle' )) }}
                                  <span>{{ $thread->owner1->userInfo->fullName }}</span>
                                  @elseif($thread->owner2_id != Auth::user()->id)
                                  {{ HTML::image($thread->owner2->userInfo->icon_url, '', array( 'width' => 35, 'height' => 35,'class'=>'img-circle' )) }}
                                  <span>{{ $thread->owner2->userInfo->fullName }}</span>
                                  @endif
                                  <!--
                                  <span class="btn-success pull-right">{{count($thread->message)}} total messages</span>
                                  -->
                              </a>
                          </li>
                          @endforeach

                      </ul>

                      <footer>
                              <a class="chat-avatar" href="javascript:;">
                                  {{ HTML::image(Auth::user()->userInfo->icon_url, '', array( 'width' => 35, 'height' => 35 )) }}
                              </a>
                              <div class="user-status">
                              <p>
                                  <i class="fa fa-circle text-success"></i>
                                  Me
                              </p>
                              </div>
                      </footer>

                  </aside>
                  <aside class="mid-side">
                      <div class="chat-room-head">
                          <h3>{{ $otherUserInfo->userInfo->fullName }}</h3>
                          <!--
                          <form action="#" class="pull-right position">
                              <input type="text" placeholder="Search" id="searchbox" class="form-control search-btn ">
                          </form>
                          -->
                      </div>
                      <table class="dataTable" id="example" width="100%">
                          <thead>
                          <tr class='text-center'>
                              <th></th>
                          </tr>
                          </thead>
                          <tbody>

                      @Foreach($messages as $message)
                      <tr><td>
                          @if($message->sender_id == $userInfo->id)
                          <div class="group-rom bg-info">
                              <div class="first-part">
                                {{ HTML::image($userInfo->userInfo->icon_url, 'alt', array( 'width' => 35, 'height' => 35,'class'=>'img-circle' )) }}
                              </div>
                              <div class="second-part">{{ $message->message }}</div>
                              <div class="third-part">{{ $message->created_at->diffForHumans() }}</div>
                          </div>
                          @elseif($message->sender_id == $otherUserInfo->id)
                          <div class="group-rom  bg-success">
                              <div class="first-part">{{ HTML::image($otherUserInfo->userInfo->icon_url, 'alt', array( 'width' => 35, 'height' => 35,'class'=>'img-circle')) }}</div>
                              <div class="second-part">{{ $message->message }}</div>
                              <div class="third-part">{{ $message->created_at->diffForHumans() }}</div>
                          </div>
                          @endif

                      @endforeach
                      </td></tr>
                      
                      </tbody>
                      <tfoot>
                        <tr>
                        <td>
                          <br>
                          <br>
                        </td>
                      </tr>

                      </tfoot>
                      </table>
                      
                      
                      <div class="footer">
                      
                      {{ Form::open(array('route' => ['messages.send',$currentThread->id], 'method' => 'post', 'role' => 'form')) }}
                          <div class="chat-txt">
                              {{ Form::text('message', null, array('class' => 'form-control','placeholder'=>'type a new message')) }}
                          </div>
                          {{ Form::submit('Send', array('class' => 'btn btn-danger pull-right')) }}
                        {{ Form::close() }}
                      
                      </div>
                      
                  </aside>
                  <aside class="right-side">
                      <div class="user-head">
                          <h4>Open New Message Thread</h4>
                      </div>
                      <div class="invite-row">
                          <h4 class="pull-left">Classmates</h4>
                      </div>
                      <ul class="chat-available-user" style="float:left; height: 55vh; overflow: auto">
                        @foreach($otherClassmates as $classmate)
                          <li>
                              <a href="{{ route('thread.new',$classmate->user_id) }}">
                                  {{ HTML::image($classmate->icon_url, 'alt', array( 'width' => 30, 'height' => 30,'class'=>'img-circle' )) }}
                                  {{$classmate->fullName}}
                              </a>
                          </li>
                        @endforeach
                      </ul>
                      <footer>
                          <a href="{{route('writeMessage')}}" class="guest-on">
                              <i class="fa fa-check"></i>
                              report bug
                          </a>
                      </footer>
                  </aside>
              </div>

@stop

@section('script')
    {{ HTML::script('assets/data-tables/jquery.dataTables.js') }}
    {{ HTML::script('assets/data-tables/DT_bootstrap.js') }}

    <script type="text/javascript" charset="utf-8">
        $(document).ready(function() {

            var table = $('#example').dataTable({
                "order": [],
                "bSort": false,
                "bFilter": false,
                "scrollY":  '60vh',
                "scrollCollapse": true,
                "paging":         false

            });
            table.parent().scrollTop(9999);

          $('#searchbox').on( 'keyup click', function () {
                 $('#example').DataTable().search(
                     $('.outsideBorderSearch').val()
                 ).draw();
              } );
        });
    </script>
@stop