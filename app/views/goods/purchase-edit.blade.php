@extends('layouts')

@section('title')
修改进货数量 ::
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
            修改进货数量
        </h1>

        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i> <a href="{{ URL::to('/') }}">首页</a></li>
            <li><a href="{{ URL::to('goods') }}">货品管理</a></li>
            <li class="active">修改进货数量</li>
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

            <div class="form-group clearfix {{{ $errors->has('purchase-old') ? 'has-error' : '' }}}">
                <label for="cost" class="col-sm-3 control-label">当前数量</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="进货数量，单位：箱！" name="purchase-old" id="purchase-old" value="{{{ Input::old('purchase-old',  h_unit($product->purchase, $product->good->unit)) }}}" readonly />

                    <span class="help-block">{{{ $errors->first('purchase-old') }}}</span>
                </div>
            </div>

            <div class="form-group clearfix {{{ $errors->has('purchase-new') ? 'has-error' : '' }}}">
                <label for="purchase-new" class="col-sm-3 control-label">修改数量</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="修改后进货数量，单位：箱！" name="purchase-new" id="purchase-new" value="{{{ Input::old('purchase-new') }}}" />

                    <span class="help-block">{{{ $errors->first('purchase-new') }}}</span>
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