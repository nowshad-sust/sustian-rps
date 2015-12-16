
<style>
    .dropdown-menu {
height: auto;
max-height: 400px;
overflow-x: hidden;
}
</style>
<header class="panel-heading tab-bg-dark-navy-blue">

    <ul class="nav nav-tabs nav-justified ">
        @if(Route::currentRouteName() == 'data.entry')
        <li class="active">
            <a href="#" aria-expanded="true">
                Courses
            </a>
            @else
            <li>
                <a href="{{route('data.entry')}}" aria-expanded="true">
                    Courses
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