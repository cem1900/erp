@extends('layouts')

@section('title')
货品调拨 ::
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
            货品调拨
        </h1>

        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i> <a href="{{ URL::to('/') }}">首页</a></li>
            <li><a href="{{ URL::to('goods') }}">货品管理</a></li>
            <li class="active">货品调拨</li>
        </ol>

        @include('notifications')

    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
    <div class="col-lg-12">

        @if ($warehouse->count() >= 1)

        <form class="col-sm-6" role="form" method="post">

            <!-- CSRF Token -->
            <input type="hidden" name="_token" id="_token" value="{{{ Session::getToken() }}}" />

            <div class="form-group clearfix {{{ $errors->has('name') ? 'has-error' : '' }}}">
                <label for="name" class="col-sm-3 control-label">货品</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="货品名称" name="name" id="name" value="{{{ Input::old('name', $good->name) }}}" readonly />

                    <span class="help-block">{{{ $errors->first('name') }}}</span>
                </div>
            </div>

            <div class="form-group clearfix {{{ $errors->has('from_product') ? 'has-error' : '' }}}">
                <label for="from_product" class="col-sm-3 control-label">批次货品</label>

                <div class="col-sm-9">

                    <input type="text" class="form-control" placeholder="货品名称" name="from_product" id="from_product" value="{{{ Input::old('from_product', date("Y-m-d", strtotime($product->production_date))) }}}" readonly />

                    <span class="help-block">{{{ $errors->first('from_product') }}}</span>
                </div>
            </div>

            <div class="form-group clearfix {{{ $errors->has('from_warehouse') ? 'has-error' : '' }}}">
                <label for="from_product_id" class="col-sm-3 control-label">原始仓库</label>

                <div class="col-sm-9">

                    <input type="text" class="form-control" placeholder="货品名称" name="from_warehouse" id="from_warehouse" value="{{{ Input::old('from_warehouse', $product->warehouse->name) }}}" readonly />

                    <span class="help-block">{{{ $errors->first('from_warehouse') }}}</span>
                </div>
            </div>

            <div class="form-group clearfix {{{ $errors->has('from_product_store') ? 'has-error' : '' }}}">
                <label for="from_product_stock" class="col-sm-3 control-label">原始库存</label>

                <div class="col-sm-9">

                    <input type="text" class="form-control" placeholder="原始库存" name="from_product_store" id="from_product_store" value="{{{ Input::old('from_product_store',  h_unit($product->store, $good->unit)) }}}" readonly />

                    <span class="help-block">{{{ $errors->first('from_product_store') }}}</span>
                </div>
            </div>

            <div class="form-group clearfix {{{ $errors->has('warehouse_id') ? 'has-error' : '' }}}">
                <label for="warehouse_id" class="col-sm-3 control-label">调往仓库</label>

                <div class="col-sm-9">

                    <select name="warehouse_id" id="warehouse_id" class="form-control">
                        @foreach ($warehouse as $w)
                        <option value="{{ $w->id }}">{{ $w->name }}</option>
                        @endforeach
                    </select>

                    <span class="help-block">{{{ $errors->first('warehouse_id') }}}</span>
                </div>

            </div>

            <div class="form-group clearfix {{{ $errors->has('num') ? 'has-error' : '' }}}">
                <label for="num" class="col-sm-3 control-label">调拨数量</label>

                <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="调拨数量，不能大于现有库存数量，单位：箱！" name="num" id="num"
                           value="{{{ Input::old('num') }}}"/>

                    <span class="help-block">{{{ $errors->first('num') }}}</span>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" class="btn btn-primary">调拨</button>
                    <a href="{{ URL::to('goods') }}">
                        <button type="button" class="btn btn-default">取消</button>
                    </a>
                </div>
            </div>

        </form>
        @else
        <div class="alert alert-warning">
            <strong>提示!</strong> 请先联系管理员添加新仓库！
        </div>
        @endif
    </div>

</div>
@stop