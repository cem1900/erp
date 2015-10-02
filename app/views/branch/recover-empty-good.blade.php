@extends('layouts')

@section('title')
选择兑换批次 ::
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
            选择兑换批次
        </h1>

        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i> <a href="{{ URL::to('/') }}">首页</a></li>
            <li><a href="{{ URL::to('branch') }}">网点管理</a></li>
            <li class="active">选择兑换批次</li>
        </ol>

        @include('notifications')

    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
    @if ($products->count() >= 1)

    <div class="col-lg-12">

        <div class="alert alert-info">
            <strong>网点：</strong>{{ $branch->name }} <br/>
            <strong>地址：</strong>{{ $branch->address }} <br/>
            <strong>手机：</strong>{{ $branch->mobile }} <br/>
            <strong>仓库：</strong>{{ $warehouse->name }}

        </div>

        <div class="panel panel-default ">

            <div class="panel-body">

                <form  role="form" method="post" >

                    <!-- CSRF Token -->
                    <input type="hidden" name="_token" id="_token" value="{{{ Session::getToken() }}}"/>

                    <div class="form-group clearfix {{{ $errors->has('item_id') ? 'has-error' : '' }}}">
                        <label for="item_id" class="col-sm-2 control-label">货品选择</label>

                        <div class="col-sm-10">

                            <select name="item_id" id="item_id" class="form-control">
                                @foreach ($products as $p)
                                <option value="{{ $p->id }}">{{ $p->good->name }} 生产日期:{{ date("Y-m-d", strtotime($p->production_date)) }}, 存库:{{ h_unit($p->store, $p->good->unit) }}</option>
                                @endforeach
                            </select>

                            <span class="help-block">{{{ $errors->first('item_id') }}}</span>
                        </div>
                    </div>

                    <input type="hidden" name="branch_id" value="{{{ $branch->id }}}"/>

                    <input type="hidden" name="warehouse_id" value="{{{ $warehouse->id }}}"/>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary btn-lg btn-block">生成出货单</button>

                        </div>
                    </div>

                </form>


            </div>
        </div>
    </div>

    @else
    <div class="col-lg-12">
    <div class="alert alert-warning">
        <strong>提示!</strong> 没有可以用的货品，请联系仓库管理员 <a href="{{ URL::to('goods') }}" class="alert-link">添加货品</a> ，或者补充货品库存！
    </div>
    </div>
    @endif

</div>
@stop