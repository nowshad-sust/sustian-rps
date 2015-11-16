<div style="background-color: lightgreen;">
<ul class="nav nav-tabs nav-justified ">
    @if(Route::currentRouteName() == 'resultsDataTable')
        <li class="active"><a href="{{route('resultsDataTable')}}"><i class="fa fa-home"></i> Data</a></li>
    @else
        <li><a href="{{route('resultsDataTable')}}"><i class="fa fa-home"></i> Data</a></li>
    @endif

    @if(Route::currentRouteName() == 'dropList')
        <li class="active"><a href="{{route('dropList')}}"> Drop List</a></li>
    @else
        <li><a href="{{route('dropList')}}"> Drop List</a></li>
    @endif

    @if(Route::currentRouteName() == 'addResult')
        <li class="active"><a href="{{route('addResult')}}"> Add Result</a></li>
    @else
        <li><a href="{{route('addResult')}}"> Add Result</a></li>
    @endif


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

    @if(Route::currentRouteName() == 'cgpa')
        <li class="active"><a href="{{route('cgpa')}}"> CGPA</a></li>
    @else
        <li><a href="{{route('cgpa')}}"> CGPA</a></li>
    @endif

    @if(Route::currentRouteName() == 'classStanding')
    <li class="active"><a href="{{route('classStanding')}}"> Class Standing</a></li>
    @else
        <li><a href="{{route('classStanding')}}"> Class Standing</a></li>
    @endif

</ul>
</div>