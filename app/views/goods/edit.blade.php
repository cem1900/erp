@extends('layouts')

@section('title')
修改货品 ::
@parent
@stop

@section('styles_src')

@stop

@section('script_src')

@stop

@section('script')
@parent

@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            修改货品
        </h1>

        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i> <a href="{{ URL::to('/') }}">首页</a></li>
            <li><a href="{{ URL::to('goods') }}">货品管理</a></li>
            <li class="active">修改货品</li>
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
                <label for="name" class="col-sm-3 control-label">货品</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="货品名称" name="name" id="name" value="{{{ Input::old('name', $good->name) }}}" />

                    <span class="help-block">{{{ $errors->first('name') }}}</span>
                </div>
            </div>

            <div class="form-group clearfix {{{ $errors->has('barcode') ? 'has-error' : '' }}}">
                <label for="barcode" class="col-sm-3 control-label">货品条码</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="货品条码" name="barcode" id="barcode" value="{{{ Input::old('barcode', $good->barcode) }}}" />

                    <span class="help-block">{{{ $errors->first('barcode') }}}</span>
                </div>
            </div>

            <div class="form-group clearfix {{{ $errors->has('unit') ? 'has-error' : '' }}}">
                <label for="unit" class="col-sm-3 control-label">每箱容量</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="每箱多少瓶" name="unit" id="unit" value="{{{ Input::old('unit', $good->unit) }}}" />

                    <span class="help-block">{{{ $errors->first('unit') }}}</span>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" class="btn btn-primary">修改</button>
                    <a href="{{ URL::to('goods') }}">
                        <button type="button" class="btn btn-default">取消</button>
                    </a>
                </div>
            </div>

        </form>

    </div>

</div>
@stop