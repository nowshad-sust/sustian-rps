@extends('layouts.default')
@section('content')
    @include('includes.alert')

    @include('includes.statMenu')

    <div class="panel-body">
        <h4>Semester-<b>{{$semester}}</b> GPA</h4>
        <table class="display table table-bordered table-stripe" id="example">
            <thead>
            <tr>
                <th>Course ID</th>
                <th>Course Credit</th>
                <th>Grade point</th>
                <th>Grade Letter</th>

                <th class="text-center">GPA</th>
            </tr>
            </thead>
            <tbody>

            <?php $rowCount = floor(count($resultsInfo)/2); ?>

            @foreach($resultsInfo as $Info)
                @if($Info->grade_point == 0)
                    <tr class="danger">
                @else
                    <tr class="">
                @endif
                    <td>{{$Info->course->course_number}}</td>
                    <td>{{$Info->course->course_credit}}</td>
                    <td>{{$Info->grade_point}}</td>
                    <td>{{$Info->grade_letter}}</td>
                    @if($rowCount-- == 0)
                        <td class="text-center" >
                            <b>{{$semesterGPA}}</b>
                        </td>
                    @endif
                    @endforeach
                </tr>

            </tbody>
        </table>
    </div>



@stop

@section('style')
    {{ HTML::style('assets/data-tables/DT_bootstrap.css') }}

@stop