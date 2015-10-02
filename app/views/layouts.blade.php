<!-- header -->
@include('header')
<!-- ./ header -->

<div id="wrapper">

    <!-- sidebar -->
    @include('sidebar')
    <!-- ./ sidebar -->

    <div id="page-wrapper">
    @yield('content')
    </div><!-- /#page-wrapper -->

</div><!-- /#wrapper -->

<!-- footer -->
@include('footer')
<!-- ./ footer -->
