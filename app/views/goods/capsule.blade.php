@extends('layouts')

@section('title')
设置瓶盖兑换费用 ::
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
            设置瓶盖兑换费用
        </h1>

        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i> <a href="{{ URL::to('/') }}">首页</a></li>
            <li><a href="{{ URL::to('goods') }}">货品管理</a></li>
            <li class="active">设置瓶盖兑换费用</li>
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

            <div class="form-group clearfix {{{ $errors->has('capsule_unit') ? 'has-error' : '' }}}">
                <label for="capsule_unit" class="col-sm-3 control-label">瓶盖回收</label>

                <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="瓶盖回收费，多少钱回收一个!" name="capsule_unit" id="capsule_unit"
                           value="{{{ Input::old('capsule_unit', $good->capsule_unit) }}}"/>

                    <span class="help-block">{{{ $errors->first('capsule_unit') }}}</span>

                    <p>
                        多个费用请用 "|" 分割，例如"0.05|0.10",表示0.05元回收一个和0.10元回收一个。
                    </p>
                </div>

            </div>



            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" class="btn btn-primary">设置</button>
                    <a href="{{ URL::to('goods') }}">
                        <button type="button" class="btn btn-default">取消</button>
                    </a>
                </div>
            </div>

        </form>

    </div>

</div>
@stop