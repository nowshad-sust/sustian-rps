
<style>
    .dropdown-menu {
height: auto;
max-height: 400px;
overflow-x: hidden;
}
</style>
<header class="panel-heading tab-bg-dark-navy-blue">

    <ul class="nav nav-tabs nav-justified ">
        @if(Route::currentRouteName() == 'chart.course-grade')
        <li class="active">
            <a href="#" aria-expanded="true">
                Course vs Grade
            </a>
            @else
            <li>
                <a href="{{route('chart.course-grade')}}" aria-expanded="true">
                    Course vs Grade
                </a>
            @endif
        </li>

        @if(Route::currentRouteName() == 'chart.course-cgpa')
        <li class="active">
            <a href="#" aria-expanded="false">
                Course vs CGPA
            </a>
            @else
                <li>
                    <a href="{{route('chart.course-cgpa')}}" aria-expanded="true">
                            Course vs CGPA
                    </a>
            @endif
        </li>

        @if(Route::currentRouteName() == 'chart.semester-cgpa')
        <li class="active">
            <a href="#" aria-expanded="false">
                Semester CGPA
            </a>
        @else
            <li>
            <a href="{{route('chart.semester-cgpa')}}" aria-expanded="false">
                Semester CGPA
            </a>
        @endif
        </li>
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#" aria-expanded="false">
                            <i class="fa fa-tasks"> Course Wise Stat</i>
                        </a>
                        <ul class="dropdown-menu extended tasks-bar">
                            <div class="notify-arrow notify-arrow-green"></div>
                            <li>
                                <p class="green">You have {{count($lists)}} available courses</p>
                            </li>
                            @if($lists!=null)
                                @foreach($lists as $list)
                                    <li class="text-center">
                                        <a href="{{route('chart.coursewise-stat',array_search ($list, $lists))}}">
                                            <div class="task-info">
                                                <div class="desc">{{ $list }}</div>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </li>

                    @if(Route::currentRouteName() == 'chart.class-cgpa')
                        <li class="active">
                            <a href="#" aria-expanded="false">
                                Class Stat
                            </a>
                    @else
                        <li>
                            <a href="{{route('chart.class-cgpa')}}" aria-expanded="true">
                                Class Stat
                            </a>
                            @endif
                        </li>


    </ul>

</header>