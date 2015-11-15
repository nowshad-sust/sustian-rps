<!DOCTYPE html>
<html lang="en">
@include('home.add.header')

<body >
<section id="container" class="">
    @include('home.add.menubar')
    <section id="main-content">
        <section class="wrapper site-min-height">
            @yield('content')
        </section>
    </section>


@include('home.add.footer')


</body>
</html>
