@extends('layouts')

@section('title')
修改个人资料 ::
@parent
@stop

@section('script_src')

@stop

@section('script')
@parent
<script>

</script>
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">修改个人资料</h1>

        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i> <a href="{{ URL::to('/') }}">首页</a></li>
            <li><a href="{{ URL::to('users') }}">员工列表</a></li>
            <li class="active">修改个人资料</li>
        </ol>

        @include('notifications')

    </div>
    <!-- /.col-lg-12 -->
</div>


<div class="row">
    <div class="col-lg-12">
        <form class="col-sm-6" role="form" method="post" action="{{ URL::to('users/change') }}">

            <!-- CSRF Token -->
            <input type="hidden" name="_token" id="_token" value="{{{ Session::getToken() }}}" />



            <div class="form-group clearfix {{{ $errors->has('username') ? 'has-error' : '' }}}">
                <label for="username" class="col-sm-2 control-label">用户名</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="用户名" name="username" id="username" value="{{{ Input::old('username', $user->username) }}}" readonly />

                    <span class="help-block">{{{ $errors->first('username') }}}</span>
                </div>
            </div>

            <div class="form-group clearfix {{{ $errors->has('mobile') ? 'has-error' : '' }}}">
                <label for="mobile" class="col-sm-2 control-label">电话</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="电话" name="mobile" id="mobile" value="{{{ Input::old('mobile', $user->mobile) }}}" />

                    <span class="help-block">{{{ $errors->first('mobile') }}}</span>
                </div>
            </div>

            <div class="form-group clearfix {{{ $errors->has('password') ? 'has-error' : '' }}}">

                <label for="password" class="col-sm-2 control-label">密码</label>

                <div class="col-sm-10">
                    <input type="password" class="form-control"  placeholder="不修改密码请留空" name="password" id="password" value="" />

                    <span class="help-block">{{{ $errors->first('password') }}}</span>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">修改</button>
                    <a href="{{ URL::to('/') }}">
                        <button type="button" class="btn btn-default">取消</button>
                    </a>
                </div>
            </div>

        </form>
    </div>
    <!-- /.col-lg-12 -->
</div>

@stop
