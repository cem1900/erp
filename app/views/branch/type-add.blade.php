@extends('layouts')

@section('title')
添加客户类型 ::
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
        <h1 class="page-header">
            添加客户类型
        </h1>

        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i> <a href="{{ URL::to('/') }}">首页</a></li>
            <li><a href="{{ URL::to('branch') }}">网点管理</a></li>
            <li><a href="{{ URL::to('branch/type') }}">客户类型列表</a></li>
            <li class="active">添加客户类型</li>
        </ol>

        @include('notifications')

    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
    <div class="col-lg-12">
        <form class="col-sm-6" role="form" method="post">

            <!-- CSRF Token -->
            <input type="hidden" name="_token" id="_token" value="{{{ Session::getToken() }}}" />

            <div class="form-group clearfix {{{ $errors->has('name') ? 'has-error' : '' }}}">
                <label for="name" class="col-sm-3 control-label">客户类型</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="客户类型" name="name" id="name" value="{{{ Input::old('name') }}}" />

                    <span class="help-block">{{{ $errors->first('name') }}}</span>
                </div>
            </div>

            <div class="form-group clearfix {{{ $errors->has('code') ? 'has-error' : '' }}}">
                <label for="code" class="col-sm-3 control-label">客户编码</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="编码" name="code" id="code" value="{{{ Input::old('code') }}}" />

                    <span class="help-block">{{{ $errors->first('code') }}}</span>
                </div>
            </div>

            <div class="form-group clearfix {{{ $errors->has('day') ? 'has-error' : '' }}}">
                <label for="day" class="col-sm-3 control-label">提醒周期</label>
                <div class="col-sm-9">
                    <select name="day" id="day" class="form-control">
                        <option value="2" >2天</option>
                        <option value="3" >3天</option>
                        <option value="4" >4天</option>
                        <option value="5" >5天</option>
                        <option value="6" >6天</option>
                        <option value="7" >7天</option>
                        <option value="8" >8天</option>
                        <option value="9" >9天</option>
                        <option value="10" >10天</option>
                        <option value="11" >11天</option>
                        <option value="12" >12天</option>
                        <option value="13" >13天</option>
                        <option value="14" >14天</option>
                        <option value="15" >15天</option>
                        <option value="16" >16天</option>
                        <option value="17" >17天</option>
                        <option value="18" >18天</option>
                        <option value="19" >19天</option>
                        <option value="20" >20天</option>
                        <option value="21" >21天</option>
                        <option value="22" >22天</option>
                        <option value="23" >23天</option>
                        <option value="24" >24天</option>
                        <option value="25" >25天</option>
                        <option value="26" >26天</option>
                        <option value="27" >27天</option>
                        <option value="28" >28天</option>
                        <option value="29" >29天</option>
                        <option value="30" >30天</option>
                    </select>

                    <span class="help-block">{{{ $errors->first('day') }}}</span>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" class="btn btn-primary">创建</button>
                    <a href="{{ URL::to('branch/type') }}">
                        <button type="button" class="btn btn-default">取消</button>
                    </a>
                </div>
            </div>

        </form>
    </div>

</div>
@stop