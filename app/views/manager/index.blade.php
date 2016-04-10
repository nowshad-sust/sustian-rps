@extends('layouts.default')
    @section('content')
        <!--@include('manager.managerMenu')-->
        @include('includes.alert')
        <div class="panel-body">
        <h3 class="text-center">Results</h3>
        <a style="float:right;" href="{{route('course.add.form')}}"><button class="btn btn-info">Add new course</button></a>
        <p class="text-center">CAUTION: Deleting a course's results will affect all user data.
         So, be careful and ensure that you know what you are deleting</p>
        <table class="display table table-bordered table-stripe" id="example">
            <thead>
            <tr>
                <th>ID</th>
                <th>Course Number</th>
                <th>Course Title</th>
                <th>Semester</th>
                <th>Credit</th>

                <th class="text-center">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($courseDetails as $Info)

                <tr class="">
                    <td>{{$Info->id}}</td>
                    <td>{{$Info->course_number}}</td>
                    <td>{{$Info->course_title}}</td>
                    <td>{{$Info->course_semester}}</td>
                    <td>{{$Info->course_credit}}</td>

                    <td class="text-center">
                        <a class="btn btn-xs btn-warning btn-edit" href="{{ route('data.add',$Info->id) }}">Edit</a>
                        <a id="delete" class="btn btn-xs btn-danger btn-edit" href="{{ route('course.delete',$Info->id) }}">Delete</a>
                    </td>
                </tr>

            @endforeach
            </tbody>
        </table>
    </div>

    <div id="confirm" class="modal hide fade">
      <div class="modal-body">
        Are you sure?
      </div>
      <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-primary" id="delete">Delete</button>
        <button type="button" data-dismiss="modal" class="btn">Cancel</button>
      </div>
    </div>



@stop

@section('style')
    {{ HTML::style('assets/data-tables/DT_bootstrap.css') }}

@stop


@section('script')
    {{ HTML::script('assets/data-tables/jquery.dataTables.js') }}
    {{ HTML::script('assets/data-tables/DT_bootstrap.js') }}

    <script type="text/javascript" charset="utf-8">
        $(document).ready(function() {

            $('#example').dataTable({
                stateSave: true,
                "order": [[ 3, "asc" ]]
            });

            $('#delete').click(function(){
                return confirm("Are you sure you want to delete?");
            });
        });
    </script>
@stop