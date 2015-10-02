@extends('layouts')

@section('title')
出货单完成确认 ::
@parent
@stop


@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            <span class="pull-right">

                <a href="{{ URL::to('branch/picking/'.$delivery->branch_id) }}">
                    <button type="button" class="btn btn-primary">出货单列表</button>
                </a>

            </span>
            出货单完成确认
        </h1>

        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i> <a href="{{ URL::to('/') }}">首页</a></li>
            <li><a href="{{ URL::to('branch') }}">网点管理</a></li>
            <li class="active">出货单完成确认</li>
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

            <div class="form-group clearfix {{{ $errors->has('bn') ? 'has-error' : '' }}}">
                <label for="name" class="col-sm-3 control-label">出货单号</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="出货单号" name="bn" id="bn" value="{{{ Input::old('bn',$delivery->bn ) }}}" readonly />

                    <span class="help-block">{{{ $errors->first('bn') }}}</span>
                </div>
            </div>

            <div class="form-group clearfix {{{ $errors->has('real_bn') ? 'has-error' : '' }}}">
                <label for="real_bn" class="col-sm-3 control-label">纸质单号</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="纸质单号" name="real_bn" id="real_bn" value="{{{ Input::old('real_bn') }}}" />

                    <span class="help-block">{{{ $errors->first('real_bn') }}}</span>
                </div>
            </div>

            <div class="form-group clearfix {{{ $errors->has('pay_status') ? 'has-error' : '' }}}">
                <label for="pay_status" class="col-sm-3 control-label">支付状态</label>
                <div class="col-sm-9">

                    <label class="radio-inline">
                        <input type="radio" name="pay_status" id="pay_status_1" value="1" checked> 已付款
                    </label>

                    <label class="radio-inline">
                        <input type="radio" name="pay_status" id="pay_status_0" value="0"> 未付款
                    </label>

                    <span class="help-block">{{{ $errors->first('pay_status') }}}</span>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" class="btn btn-primary">确认完成</button>
                    <a href="{{ URL::to('picking') }}">
                        <button type="button" class="btn btn-default">取消</button>
                    </a>
                </div>
            </div>

        </form>

    </div>


</div>
@stop