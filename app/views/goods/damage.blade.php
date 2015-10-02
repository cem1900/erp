@extends('layouts')

@section('title')
货品报损 ::
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
            货品报损
        </h1>

        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i> <a href="{{ URL::to('/') }}">首页</a></li>
            <li><a href="{{ URL::to('goods') }}">货品管理</a></li>
            <li class="active">货品报损</li>
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
                    <input type="text" class="form-control" placeholder="货品名称" name="name" id="name" value="{{{ Input::old('name', $good->name) }}}" readonly />

                    <span class="help-block">{{{ $errors->first('name') }}}</span>
                </div>
            </div>

            <div class="form-group clearfix {{{ $errors->has('product_id') ? 'has-error' : '' }}}">
                <label for="product_id" class="col-sm-3 control-label">批次货品</label>

                <div class="col-sm-9">

                    <select name="product_id" id="product_id" class="form-control">
                        @foreach ($products as $p)
                        <option value="{{ $p->id }}">生产日期:{{ date("Y-m-d", strtotime($p->production_date)) }}, 存库:{{ $p->store }} 瓶</option>
                        @endforeach
                    </select>

                    <span class="help-block">{{{ $errors->first('product_id') }}}</span>
                </div>
            </div>

            <div class="form-group clearfix {{{ $errors->has('damage_num') ? 'has-error' : '' }}}">
                <label for="damage_num" class="col-sm-3 control-label">报损数量</label>

                <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="不填默认为1瓶,不能大于现有库存数量！单位：瓶" name="damage_num" id="damage_num"
                           value="{{{ Input::old('damage_num') }}}"/>

                    <span class="help-block">{{{ $errors->first('damage_num') }}}</span>
                </div>
            </div>

            <div class="form-group clearfix {{{ $errors->has('damage_bn') ? 'has-error' : '' }}}">
                <label for="damage_bn" class="col-sm-3 control-label">报损单号</label>

                <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="报损单号" name="damage_bn" id="damage_bn"
                           value="{{{ Input::old('damage_bn') }}}"/>

                    <span class="help-block">{{{ $errors->first('damage_bn') }}}</span>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" class="btn btn-primary">报损</button>
                    <a href="{{ URL::to('goods') }}">
                        <button type="button" class="btn btn-default">取消</button>
                    </a>
                </div>
            </div>

        </form>

    </div>

</div>
@stop