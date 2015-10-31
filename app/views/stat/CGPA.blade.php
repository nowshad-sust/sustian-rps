@extends('layouts.default')
@section('content')
    @include('includes.alert')

    <ul class="breadcrumb">
        <li><a href="{{route('resultsDataTable')}}"><i class="fa fa-home"></i> Data</a></li>
        <li><a href="{{route('addResult')}}"> Add Result</a></li>
        <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="dropdown-toggle" aria-expanded="true">
                Semester Result
                <b class=" fa fa-angle-down"></b>
            </a>
            <ul role="menu" class="dropdown-menu">
                <li><a tabindex="-1" href="{{route('gpaBySemester',1)}}"> 1/1 </a></li>
                <li><a tabindex="-1" href="{{route('gpaBySemester',2)}}"> 1/2 </a></li>
                <li><a tabindex="-1" href="{{route('gpaBySemester',3)}}"> 2/1 </a></li>
                <li><a tabindex="-1" href="{{route('gpaBySemester',4)}}"> 2/2 </a></li>
                <li><a tabindex="-1" href="{{route('gpaBySemester',5)}}"> 3/1 </a></li>
                <li><a tabindex="-1" href="{{route('gpaBySemester',6)}}"> 3/2 </a></li>
                <li><a tabindex="-1" href="{{route('gpaBySemester',7)}}"> 4/1 </a></li>
                <li><a tabindex="-1" href="{{route('gpaBySemester',8)}}"> 4/2 </a></li>
                <li><a tabindex="-1" href="{{route('gpaBySemester',9)}}"> 5/1 </a></li>
                <li><a tabindex="-1" href="{{route('gpaBySemester',10)}}"> 5/2 </a></li>
                <li class="divider"></li>
                <li><a tabindex="-1" href=""> Separated link </a></li>
            </ul>
        </li>
        <li><a href="{{route('cgpa')}}"> CGPA</a></li>
        <li><a href="{{route('classStanding')}}"> Class Standing</a></li>
    </ul>
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