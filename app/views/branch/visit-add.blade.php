@extends('layouts')

@section('title')
网点回访 ::
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
            网点回访
        </h1>

        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i> <a href="{{ URL::to('/') }}">首页</a></li>
            <li><a href="{{ URL::to('branch') }}">网点管理</a></li>
            <li class="active">网点回访</li>
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

        <form  role="form" method="post" action="{{ URL::to('branch/visit-add') }}">

            <!-- CSRF Token -->
            <input type="hidden" name="_token" id="_token" value="{{{ Session::getToken() }}}"/>

            <div class="form-group clearfix {{{ $errors->has('comment') ? 'has-error' : '' }}}">
                <label for="comment" class="col-sm-2 control-label">回访内容</label>

                <div class="col-sm-10">

                    <textarea class="form-control" rows="5" placeholder="回访内容！" name="comment" id="comment">{{{ Input::old('comment') }}}</textarea>

                    <span class="help-block">{{{ $errors->first('comment') }}}</span>
                </div>
            </div>

            <input type="hidden" name="branch_id" value="{{{ $branch->id }}}"/>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">添加回访内容</button>
                    <hr/>
                    <a href="{{ URL::to('branch') }}">
                        <button type="button" class="btn btn-default btn-lg btn-block">取消回访</button>
                    </a>
                </div>
            </div>

        </form>


            </div>
        </div>
    </div>




</div>
@stop