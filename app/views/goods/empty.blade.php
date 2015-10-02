@extends('layouts')

@section('title')
设置空瓶兑换量 ::
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
            设置空瓶兑换量
        </h1>

        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i> <a href="{{ URL::to('/') }}">首页</a></li>
            <li><a href="{{ URL::to('goods') }}">货品管理</a></li>
            <li class="active">设置空瓶兑换量</li>
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

            <div class="form-group clearfix {{{ $errors->has('empty_unit') ? 'has-error' : '' }}}">
                <label for="empty_unit" class="col-sm-3 control-label">空瓶兑换</label>

                <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="空瓶兑换量，多少箱兑换一箱!" name="empty_unit" id="empty_unit"
                           value="{{{ Input::old('empty_unit', $good->empty_unit) }}}"/>

                    <span class="help-block">{{{ $errors->first('empty_unit') }}}</span>
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