    <!-- Core Scripts - Include with every page -->
    <script src="{{{ asset('assets/js/jquery-1.10.2.js') }}}"></script>
    <script src="{{{ asset('assets/js/bootstrap.min.js') }}}"></script>
    <script src="{{{ asset('assets/js/plugins/metisMenu/jquery.metisMenu.js') }}}"></script>

    <!-- Admin Scripts - Include with every page -->
    <script src="{{{ asset('assets/js/admin.js') }}}"></script>

    @yield('script_src')

    @section('script')
    <script type="text/javascript">

    </script>
    @show

</body>

</html>
