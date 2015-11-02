@extends('layouts.default')
@section('content')
    @include('includes.alert')

    @include('includes.statMenu')

    <div class="panel-body">
        <h4>CGPA</h4>
        <table class="display table table-bordered table-stripe" id="example">
            <thead>
            <tr>
                <th>Semester</th>
                <th>GPA</th>

                <th class="text-center">CGPA</th>
            </tr>
            </thead>
            <tbody>

            <?php
            $i = 0;
            $rowCount = floor(count($semestersGPA)/2);
            ?>

            @foreach($semestersGPA as $Info)

                <tr class="">
                    <td>{{$semesters[$i]}}</td>
                    <td>{{$Info}}</td>
                    @if($rowCount-- == 0)
                        <td class="text-center" >
                            <b>{{$cgpa}}</b>
                        </td>
                    @endif
                    <?php $i++; ?>
                    @endforeach
                </tr>

            </tbody>
        </table>
    </div>



@stop

@section('style')
    {{ HTML::style('assets/data-tables/DT_bootstrap.css') }}

@stop