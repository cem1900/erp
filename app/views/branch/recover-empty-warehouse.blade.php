@extends('layouts')

@section('title')
选择仓库 ::
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
            选择仓库
        </h1>

        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i> <a href="{{ URL::to('/') }}">首页</a></li>
            <li><a href="{{ URL::to('branch') }}">网点管理</a></li>
            <li class="active">选择仓库</li>
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

        <div class="panel panel-default ">

            <div class="panel-body">

        <form  role="form" method="get" action="{{ URL::to('branch/recover-empty-good/'.$good_empty->id) }}">

            <div class="form-group clearfix {{{ $errors->has('warehouse_id') ? 'has-error' : '' }}}">
                <label for="warehouse_id" class="col-sm-2 control-label">出货仓库</label>

                <div class="col-sm-10">

                    <select name="warehouse_id" id="warehouse_id" class="form-control">
                        @foreach ($warehouse as $w)
                        <option value="{{ $w->id }}">{{ $w->name }}</option>
                        @endforeach
                    </select>

                    <span class="help-block">{{{ $errors->first('warehouse_id') }}}</span>
                </div>

            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">确认仓库出货</button>

                </div>
            </div>

        </form>


            </div>
        </div>
    </div>




</div>
@stop