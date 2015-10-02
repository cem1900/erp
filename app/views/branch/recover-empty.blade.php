@extends('layouts')

@section('title')
回收空瓶 ::
@parent
@stop

@section('script_src')
<!-- <script src="{{{ asset('assets/js/plugins/dataTables/jquery.dataTables.js') }}}"></script>
<script src="{{{ asset('assets/js/plugins/dataTables/dataTables.bootstrap.js') }}}"></script> -->
@stop

@section('script')
@parent
<script>
    // $(document).ready(function() {
    //     $('#dataTables-example').dataTable();
    // });
</script>
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            回收空瓶
        </h1>

        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i> <a href="{{ URL::to('/') }}">首页</a></li>
            <li><a href="{{ URL::to('branch') }}">网点管理</a></li>
            <li class="active">回收空瓶</li>
        </ol>

        @include('notifications')

    </div>
    <!-- /.col-lg-12 -->
</div>


<div class="row">
    <div class="col-lg-12">
        <div class="alert alert-info">
            <strong>网点：</strong>{{ $branch->name }} <br/>
            <strong>地址：</strong>{{ $branch->address }} <br/>
            <strong>手机：</strong>{{ $branch->mobile }}
        </div>


        <form class="col-sm-6" role="form" method="post">

            <!-- CSRF Token -->
            <input type="hidden" name="_token" id="_token" value="{{{ Session::getToken() }}}" />

            <div class="form-group clearfix {{{ $errors->has('good') ? 'has-error' : '' }}}">
                <label for="good" class="col-sm-3 control-label">退换货品</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="退换货品" name="good" id="good" value="{{{ Input::old('good', $recover->good->name ) }}}" readonly />

                    <span class="help-block">{{{ $errors->first('good') }}}</span>
                </div>
            </div>

            <div class="form-group clearfix {{{ $errors->has('sell') ? 'has-error' : '' }}}">
                <label for="sell" class="col-sm-3 control-label">销售数量</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="退换货品" name="sell" id="sell" value="{{{ Input::old('sell',  h_unit($recover->sell, $recover->good->unit) ) }}}" readonly />

                    <span class="help-block">{{{ $errors->first('sell') }}}</span>
                </div>
            </div>

            <div class="form-group clearfix {{{ $errors->has('empty') ? 'has-error' : '' }}}">
                <label for="empty" class="col-sm-3 control-label">已退数量</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="退换货品" name="empty" id="empty" value="{{{ Input::old('empty',  h_unit($recover->empty, $recover->good->unit) ) }}}" readonly />

                    <span class="help-block">{{{ $errors->first('sell') }}}</span>
                </div>
            </div>

            <div class="form-group clearfix {{{ $errors->has('num') ? 'has-error' : '' }}}">
                <label for="num" class="col-sm-3 control-label">退换数量</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="退换数量，单位箱！" name="num" id="num" value="{{{ Input::old('num') }}}" />

                    <span class="help-block">{{{ $errors->first('num') }}}</span>
                </div>
            </div>

            <div class="form-group clearfix {{{ $errors->has('mode') ? 'has-error' : '' }}}">
                <label for="mode" class="col-sm-3 control-label">退换模式</label>
                <div class="col-sm-9">

                    <label class="radio-inline">
                        <input type="radio" name="mode" id="mode_1" value="1" checked> 空瓶换酒 ( {{$recover->good->empty_unit}} 兑 1 )
                    </label>

                    <label class="radio-inline">
                        <input type="radio" name="mode" id="mode_2" value="2"> 空瓶换钱
                    </label>

                    <label class="radio-inline">
                        <input type="radio" name="mode" id="mode_3" value="3"> 直接退瓶
                    </label>

                    <span class="help-block">{{{ $errors->first('mode') }}}</span>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" class="btn btn-primary">退换</button>
                    <a href="{{ URL::to('branch') }}">
                        <button type="button" class="btn btn-default">取消</button>
                    </a>
                </div>
            </div>

        </form>



    </div>

</div>
@stop