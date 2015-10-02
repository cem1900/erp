@extends('layouts')

@section('title')
创建员工 ::
@parent
@stop

@section('script_src')
<!-- <script src="{{{ asset('assets/js/plugins/dataTables/jquery.dataTables.js') }}}"></script>
<script src="{{{ asset('assets/js/plugins/dataTables/dataTables.bootstrap.js') }}}"></script> -->
@stop

@section('script')
@parent
<script>
    // $(document).ready(function() {
    //     $('#dataTables-example').dataTable();
    // });
</script>
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">创建员工</h1>

        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i> <a href="{{ URL::to('/') }}">首页</a></li>
            <li><a href="{{ URL::to('users') }}">员工列表</a></li>
            <li class="active">创建员工</li>
        </ol>

        @include('notifications')

    </div>
    <!-- /.col-lg-12 -->
</div>


<div class="row">
    <div class="col-lg-12">
        <form class="col-sm-6" role="form" method="post" action="{{ URL::to('users/create') }}">

            <!-- CSRF Token -->
            <input type="hidden" name="_token" id="_token" value="{{{ Session::getToken() }}}" />

            <div class="form-group clearfix {{{ $errors->has('grade') ? 'has-error' : '' }}}">
                <label for="grade" class="col-sm-2 control-label">权限</label>
                <div class="col-sm-10">
                    <select name="grade" id="grade" class="form-control">
                        <option value="10" >业务员</option>
                        <option value="7" >审核管理员</option>
                        <option value="6" >仓库管理员</option>
                        <option value="5" >财务管理员</option>
                        <option value="1" >管理员</option>
                    </select>

                    <span class="help-block">{{{ $errors->first('grade') }}}</span>
                </div>
            </div>

            <div class="form-group clearfix {{{ $errors->has('username') ? 'has-error' : '' }}}">
                <label for="username" class="col-sm-2 control-label">用户名</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="用户名" name="username" id="username" value="{{{ Input::old('username') }}}" />

                    <span class="help-block">{{{ $errors->first('username') }}}</span>
                </div>
            </div>

            <div class="form-group clearfix {{{ $errors->has('mobile') ? 'has-error' : '' }}}">
                <label for="mobile" class="col-sm-2 control-label">电话</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="电话" name="mobile" id="mobile" value="{{{ Input::old('mobile') }}}" />

                    <span class="help-block">{{{ $errors->first('mobile') }}}</span>
                </div>
            </div>

            <div class="form-group clearfix {{{ $errors->has('password') ? 'has-error' : '' }}}">

                <label for="password" class="col-sm-2 control-label">密码</label>

                <div class="col-sm-10">
                    <input type="password" class="form-control"  placeholder="密码" name="password" id="password" value="" />

                    <span class="help-block">{{{ $errors->first('password') }}}</span>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">创建</button>
                    <a href="{{ URL::to('users') }}">
                        <button type="button" class="btn btn-default">取消</button>
                    </a>
                </div>
            </div>

        </form>
    </div>
    <!-- /.col-lg-12 -->
</div>

@stop
