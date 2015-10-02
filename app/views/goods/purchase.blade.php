@extends('layouts')

@section('title')
进货 ::
@parent
@stop

@section('styles_src')
<link href="{{{ asset('assets/js/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}}" rel="stylesheet">
@stop

@section('script_src')
<script src="{{{ asset('assets/js/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}}"></script>
<script src="{{{ asset('assets/js/plugins/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js') }}}"></script>
@stop

@section('script')
@parent
<script type="text/javascript">

    $('.form_date').datetimepicker({
        language:  'zh-CN',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0
    });

</script>
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            进货
        </h1>

        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i> <a href="{{ URL::to('/') }}">首页</a></li>
            <li><a href="{{ URL::to('goods') }}">货品管理</a></li>
            <li class="active">进货</li>
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

            <div class="form-group clearfix {{{ $errors->has('barcode') ? 'has-error' : '' }}}">
                <label for="barcode" class="col-sm-3 control-label">货品条码</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="货品条码" name="barcode" id="barcode" value="{{{ Input::old('barcode', $good->barcode) }}}" readonly />
                    <span class="help-block">{{{ $errors->first('barcode') }}}</span>
                </div>
            </div>

            <div class="form-group clearfix {{{ $errors->has('store') ? 'has-error' : '' }}}">
                <label for="store" class="col-sm-3 control-label">进货数量</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="进货数量，单位：箱！" name="store" id="store" value="{{{ Input::old('store') }}}" />

                    <span class="help-block">{{{ $errors->first('store') }}}</span>
                </div>
            </div>



            <div class="form-group clearfix {{{ $errors->has('production_date') ? 'has-error' : '' }}}">
                <label for="production_date" class="col-sm-3 control-label">生产日期</label>

                <div class="col-sm-9 input-group date form_date" data-date="" data-date-format="yyyy-mm-dd"
                     data-link-field="production_date" data-link-format="yyyy-mm-dd" style="padding-left: 15px; padding-right: 15px;">

                    <input type="text" class="form-control" placeholder="生产日期"
                           value="{{ substr(Input::old('production_date'), 0, 10) }}" readonly/>

                    <input type="hidden" id="production_date" name="production_date"
                           value="{{{ Input::old('production_date') }}}"/>

                    <span class="help-block">{{{ $errors->first('production_date') }}}</span>

                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>

                </div>
            </div>

            <div class="form-group clearfix {{{ $errors->has('life') ? 'has-error' : '' }}}">
                <label for="life" class="col-sm-3 control-label">保质期</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="保质期" name="life" id="life" value="{{{ Input::old('life') }}}" />

                    <span class="help-block">{{{ $errors->first('life') }}}</span>
                </div>
            </div>

            <input type="hidden" id="unit" name="unit" value="{{{ $good->unit }}}"/>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" class="btn btn-primary">进货</button>
                    <a href="{{ URL::to('goods') }}">
                        <button type="button" class="btn btn-default">取消</button>
                    </a>
                </div>
            </div>

        </form>

    </div>

</div>
@stop