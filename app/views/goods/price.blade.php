@extends('layouts')

@section('title')
货品价格 ::
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
            货品价格
        </h1>

        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i> <a href="{{ URL::to('/') }}">首页</a></li>
            <li><a href="{{ URL::to('goods') }}">货品管理</a></li>
            <li class="active">货品价格</li>
        </ol>

        @include('notifications')

    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
    <div class="col-lg-12">

        <div class="alert alert-info">
            <strong>货品：</strong>{{ $product->good->name }} <br/>
            <strong>每箱：</strong>{{ $product->good->unit }}瓶
        </div>

        <form class="col-sm-6" role="form" method="post">

            <!-- CSRF Token -->
            <input type="hidden" name="_token" id="_token" value="{{{ Session::getToken() }}}" />

            <div class="form-group clearfix {{{ $errors->has('cost') ? 'has-error' : '' }}}">
                <label for="cost" class="col-sm-3 control-label">进货价格</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="进货价格，每箱单价" name="cost" id="cost" value="{{{ Input::old('cost', $product->cost) }}}" />

                    <span class="help-block">{{{ $errors->first('cost') }}}</span>
                </div>
            </div>

            <div class="form-group clearfix {{{ $errors->has('price') ? 'has-error' : '' }}}">
                <label for="price" class="col-sm-3 control-label">销售价格</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="销售价格，每箱单价" name="price" id="price" value="{{{ Input::old('price', $product->price) }}}" />

                    <span class="help-block">{{{ $errors->first('price') }}}</span>
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