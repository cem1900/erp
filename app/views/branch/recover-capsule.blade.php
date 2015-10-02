@extends('layouts')

@section('title')
回收瓶盖 ::
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
            回收瓶盖
        </h1>

        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i> <a href="{{ URL::to('/') }}">首页</a></li>
            <li><a href="{{ URL::to('branch') }}">网点管理</a></li>
            <li class="active">回收瓶盖</li>
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
                <label for="good" class="col-sm-3 control-label">回收货品</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="回收货品" name="good" id="good" value="{{{ Input::old('good', $recover->good->name ) }}}" readonly />

                    <span class="help-block">{{{ $errors->first('good') }}}</span>
                </div>
            </div>

            <div class="form-group clearfix {{{ $errors->has('sell') ? 'has-error' : '' }}}">
                <label for="sell" class="col-sm-3 control-label">销售数量（瓶）</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="退换货品" name="sell" id="sell" value="{{{ Input::old('sell',  $recover->sell ) }}}" readonly />


                    <span class="help-block">{{{ $errors->first('sell') }}}</span>
                </div>
            </div>

            <div class="form-group clearfix {{{ $errors->has('empty') ? 'has-error' : '' }}}">
                <label for="empty" class="col-sm-3 control-label">已收数量（个）</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="已收数量" name="empty" id="empty" value="{{{ Input::old('empty',  $recover->capsule ) }}}" readonly />



                    <span class="help-block">{{{ $errors->first('sell') }}}</span>
                </div>
            </div>

            <div class="form-group clearfix {{{ $errors->has('num') ? 'has-error' : '' }}}">
                <label for="num" class="col-sm-3 control-label">回收数量（个）</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="回收数量，单位个！" name="num" id="num" value="{{{ Input::old('num') }}}" />


                    <span class="help-block">{{{ $errors->first('num') }}}</span>
                </div>
            </div>

            <div class="form-group clearfix {{{ $errors->has('price') ? 'has-error' : '' }}}">
                <label for="price" class="col-sm-3 control-label">回收价格</label>
                <div class="col-sm-9">
                    @foreach ($capsule as $k=>$c)
                    <label class="radio-inline">
                        <input type="radio" name="price" id="mode_{{ $k + 1 }}" value="{{ $c }}"
                            @if ($k == 0)
                        checked
                        @endif
                            > {{ $c }} 元
                    </label>

                    <br />
                    @endforeach

                    <label class="radio-inline">
                        <input type="radio" name="price" id="mode_0" value="0"> 直接回收
                    </label>

                    <br />

                    <label class="radio-inline">
                        <input type="radio" name="price" id="mode_z" value="z"> 自定义
                    </label>

                    <input type="text"  name="custom_prcie" class="form-control input-sm" placeholder="请输入自定义价格、单位元！">

                    <span class="help-block">{{{ $errors->first('price') }}}</span>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" class="btn btn-primary">回收</button>
                    <a href="{{ URL::to('branch') }}">
                        <button type="button" class="btn btn-default">取消</button>
                    </a>
                </div>
            </div>

        </form>



    </div>

</div>
@stop