<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>商品管理系统</title>

    <!-- Core CSS - Include with every page -->
    <link href="{{{ asset('assets/css/bootstrap.min.css') }}}" rel="stylesheet">
    <link href="{{{ asset('assets/font-awesome/css/font-awesome.css') }}}" rel="stylesheet">

    <!-- Admin CSS - Include with every page -->
    <link href="{{{ asset('assets/css/admin.css') }}}" rel="stylesheet">

    <style>
        body{
            background: url('{{{ asset('assets/img/stardust.png') }}}');
        }
        .login-panel {
            opacity: 0.9;
        }
    </style>

    <link rel="shortcut icon" href="{{{ asset('favicon.ico') }}}">

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">请登录 - 商品管理系统</h3>
                    </div>
                    <div class="panel-body">

                    <!-- Notifications -->
                    @include('notifications')
                    <!-- ./ notifications -->

                        {{ Form::open(array('url' => 'users/signin')) }}
                            <fieldset>

                                <div class="form-group">
                                    <input class="form-control" placeholder="用户名" name="username" type="username" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="密码" name="password" type="password" value="">
                                </div>

                                {{ Form::button('登录', array('type' => 'submit', 'class' => 'btn btn-lg btn-success btn-block')) }}

                            </fieldset>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Core Scripts - Include with every page -->
    <script src="{{{ asset('assets/js/jquery-1.10.2.js') }}}"></script>
    <script src="{{{ asset('assets/js/bootstrap.min.js') }}}"></script>
<!--    <script src="{{{ asset('assets/js/plugins/metisMenu/jquery.metisMenu.js') }}}"></script>-->
<!---->
<!--    <script src="{{{ asset('assets/js/admin.js') }}}"></script>-->
</body>
</html>
