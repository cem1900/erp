@extends('layouts')

@section('title')
编辑区域 ::
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
            编辑区域
        </h1>

        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i> <a href="{{ URL::to('/') }}">首页</a></li>
            <li><a href="{{ URL::to('branch') }}">网点管理</a></li>
            <li><a href="{{ URL::to('branch/area') }}">区域列表</a></li>
            <li class="active">编辑区域</li>
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
                <label for="name" class="col-sm-2 control-label">区域</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="区域" name="name" id="name" value="{{{ Input::old('name', $area->name) }}}" />

                    <span class="help-block">{{{ $errors->first('name') }}}</span>
                </div>
            </div>

            <div class="form-group clearfix {{{ $errors->has('code') ? 'has-error' : '' }}}">
                <label for="code" class="col-sm-2 control-label">编码</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="编码" name="code" id="code" value="{{{ Input::old('code', $area->code) }}}" />

                    <span class="help-block">{{{ $errors->first('code') }}}</span>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">更新</button>
                    <a href="{{ URL::to('branch/area') }}">
                        <button type="button" class="btn btn-default">取消</button>
                    </a>
                </div>
            </div>

        </form>
    </div>

</div>
@stop