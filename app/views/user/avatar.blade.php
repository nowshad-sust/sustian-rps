@extends('layouts.default')
@section('content')
    @include('includes.alert')

    <div class="form-group last">
        <label class="control-label col-md-3">Image Upload</label>
        {{ Form::open(array('role'=>'form','route' => 'storeAvatar', 'class' => 'form-horizontal','files' => true)) }}
        <div class="col-md-9">
            <div class="fileupload fileupload-new" data-provides="fileupload">
                <div class="fileupload-new thumbnail" style="width: 300px; height: 250px;">
                    <img src="uploads/image/defaultAvatar.png" alt="">
                </div>
                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 300px; max-height: 250px; line-height: 20px;"></div>
                <div>
                                                   <span class="btn btn-white btn-file">
                                                   <span class="fileupload-new">{{ Form::file('image', array('class' => 'form-control')) }}</span>

                                                   <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                                   <input type="file" class="default">
                                                   </span>
                    <a href="" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                </div>
            </div>

            {{ Form::submit('Upload Avatar', array('class' => 'btn btn-primary')) }}
        </div>
        {{ Form::close() }}

    </div>


@stop

@section('style')
    {{ HTML::style('css/bootstrap-fileupload.css') }}

@stop


@section('script')
    {{ HTML::script('js/bootstrap-fileupload.js') }}
@stop