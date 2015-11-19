@extends('layouts.default')
@section('content')
    @include('includes.alert')

    <div class="row">
        <div class="col-md-9">
            <section class="panel profile-info">
                {{ Form::open( array('route'=>'submitpost','method' => 'post', 'role' => 'form')) }}
                {{ Form::textarea('post_body',null,
                ['class'=>'form-control',
                'rows' => 2,
                'class'=>'form-control input-lg p-text-area',
                'placeholder'=>'Shout to your classmates']) }}

                <footer class="panel-footer">
                    {{ Form::submit('Post', array('class' => 'btn btn-danger pull-right')) }}
                    <ul class="nav nav-pills">

                    </ul>
                </footer>
                {{ Form::close() }}
            </section>
            @if($latest_posts != null && count($latest_posts) >0 )
            <table class="dataTable" id="example" width="100%">
                <thead>
                <tr>
                    <th><h3>Posts</h3></th>
                </tr>
                </thead>
                <tbody>
            @foreach($latest_posts as $post)
                <tr>
                    <td>
                        <section class="panel">
                            <div class="panel-body">
                                <div class="fb-user-thumb">
                                    {{ HTML::image($post->post_user->user_info->avatar_url, 'lock avatar') }}
                                </div>
                                <div class="fb-user-details">
                                    <h3><a href="#" class="#">{{ $post->post_user->user_info->fullName }}</a></h3>
                                    <p>{{ $post->created_at->diffForHumans() }}</p>
                                </div>
                                <div class="clearfix"></div>
                                <p class="fb-user-status">
                                    {{ nl2br($post->post_body) }}
                                </p>
                                @if(Auth::user()->id == $post->post_user->id)
                                <div class="fb-status-container fb-border">
                                    <div class="fb-time-action">

                                        <button
                                           id="edit"
                                           data-toggle="modal"
                                           post-id="{{$post->id}}"
                                           post-body="{{$post->post_body}}"
                                           data-action="edit",
                                           class="btn btn-xs btn-warning">
                                            Edit
                                        </button>

                                        <span>-</span>
                                        <a id="delete"
                                           class="btn btn-xs btn-danger"
                                           href="{{ route('deletePost',$post->id) }}"
                                           title="delete your post">
                                            Delete
                                        </a>
                                    </div>
                                </div>
                                @endif
                            </div>

                        </section>

                    </td>
                </tr>
            @endforeach
                </tbody>
            </table>
                @endif
        </div>
        <div class="col-md-3">

        </div>
    </div>

    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">x</button>
                    <h4 class="modal-title">Edit Post</h4>
                </div>
                <div class="modal-body">

                    {{ Form::open(array('route'=>'updatePost','id'=>'update-form','method' => 'post', 'role' => 'form')) }}
                    {{ Form::textarea('post_body',null,
                    ['id' => 'form-post-body',
                    'class'=>'form-control input-lg p-text-area',
                    'placeholder'=>'Shout to your classmates']) }}
                    {{ Form::hidden('post_id',null, ['id'=>'hidden_post_id']) }}
                    <div class="form-group">
                        {{ Form::submit('Update Post', array('class' => 'btn btn-default')) }}
                    </div>
                    {{ Form::close() }}

                </div>

            </div>
        </div>
    </div>

@stop


@section('style')
    <!--{{ HTML::style('assets/data-tables/DT_posts.css') }}-->

@stop


@section('script')
    {{ HTML::script('assets/data-tables/jquery.dataTables.js') }}
    {{ HTML::script('assets/data-tables/DT_bootstrap.js') }}

    <script type="text/javascript" charset="utf-8">
        $(document).ready(function() {

            $('#example').dataTable({
                "order": [],
                "bSort": false,
            });
        });
    </script>

    <script>
        $('button').on('click', function(){
            var this_id = $(this).attr('post-id');
            var this_body = $(this).attr('post-body');
            var this_action = $(this).attr('data-action');
            if(this_action == 'edit'){
                $("#hidden_post_id").val(this_id);
                document.getElementById("form-post-body").defaultValue = this_body;
                $('#myModal').modal();
            }
        });
    </script>

@stop